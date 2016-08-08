var modal = document.getElementById('modal');
var montage = document.getElementsByClassName("img");
var span = document.getElementsByClassName("close")[0];
var imgModal = document.getElementById('img-modal');


for (var i=0; i < montage.length; i++) {
  montage[i].onclick = function(event) {
    modal.style.display = "block";
    imgModal.src = event.srcElement.src;;
  }
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
