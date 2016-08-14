var modal = document.getElementById('modal');
var montage = document.getElementsByClassName("icon");
var span = document.getElementsByClassName("close")[0];
var imgModal = document.getElementById('img-modal');
var send = document.getElementById('send-comment');
var comment = document.getElementById('comment');

var imageSelected = null;

for (var i=0; i < montage.length; i++) {
  montage[i].onclick = showModal;
}

function showModal(event) {
  modal.style.display = "block";
  imgModal.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
  imageSelected = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
}

// When the user clicks on the button, open the modal
montage.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

send.onclick = function(event) {
  var com = comment.value;
  if (com == "" || com == null) {
    return;
  }

  var tmp = imageSelected.split('/');
  var imagePath = tmp[tmp.length - 1];

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
      comment.value = "";
      modal.style.display = "none";
      var div = document.querySelectorAll("[data-img='" + imagePath + "']")[0];
      var span = document.createElement('span');
      span.innerHTML = xhr.responseText + ": " + escapeHtml(com);
      span.setAttribute("class","comment");
      div.appendChild(span);
    }
  };
  xhr.open("POST", "./forms/comment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + imagePath + "&comment=" + com);
}


function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }
