var views = document.getElementById('views');
var loadMoreButton = document.getElementById('load-more');

var modal = document.getElementById('modal');
var imgModal = document.getElementById('img-modal');

var last = null;

function loadMore(lastMontageId, imagePerPages) {
  if (last != null) {
    lastMontageId = last;
  }
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
      if (xhr.responseText === "KO") {
        return;
      }
      var responseJSON = JSON.parse(xhr.responseText);
      last = responseJSON[responseJSON.length - 1]['id'];
      for (var i = 0; responseJSON[i]; i++) {
        var div = document.createElement("div");

        var commentsHTML = "";
        for (var j = 0; responseJSON[i]['comments'] != null && responseJSON[i]['comments'][j] != null; j++) {
          commentsHTML += "<span class=\"comment\">" + escapeHtml(responseJSON[i]['comments'][j]['username']) + ": " + escapeHtml(responseJSON[i]['comments'][j]['comment']) + "</span>";
        }

        div.innerHTML =
        "<img onclick=\"showModal2(\'" + responseJSON[i]['img'] + "\');\" class=\"icon removable\" src=\"montage/" + responseJSON[i]['img'] + "\"></img>" +
        "<div id=\"buttons-like\">" +
          "<img onclick=\"onLike(this);\" class=\"button-like\" src=\"img/up.png\" data-image=\""+ responseJSON[i]['img'] +"\"></img>" +
          "<span class=\"nb-like\" data-src=\""+ responseJSON[i]['img'] +"\">" + responseJSON[i]['likes'] + "</span>" +
          "<img onclick=\"onDislike(this);\" class=\"button-dislike\" src=\"img/down.png\" data-image=\""+ responseJSON[i]['img'] +"\"></img>" +
          "<span class=\"nb-dislike\" data-src=\""+ responseJSON[i]['img'] +"\">" + responseJSON[i]['dislikes'] + "</span>" +
          commentsHTML +
        "</div>";
        div.className = "img";
        div.setAttribute("data-img", responseJSON[i]['img']);
        views.appendChild(div);
      }
      if (typeof(responseJSON['more']) === 'undefined') {
        loadMoreButton.style.display = "none";
      }
    }
  };
  xhr.open("POST", "./forms/getmontages.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("id=" + lastMontageId + "&nb=" + imagePerPages);
}

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }

 function showModal2(src) {
   modal.style.display = "block";
   imgModal.src = 'montage/' + src;
   imageSelected = 'montage/' + src;
 }

function onLike(srcElement) {
  var src = srcElement.getAttribute('data-image');
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD") {
      current_user_add_like(src);
    } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
      clientDislikes[src] = true;
      current_user_add_like(src);
    }
  };
  xhr.open("POST", "./forms/like.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + src + "&type=L");
}

function onDislike(srcElement) {
  var src = srcElement.getAttribute('data-image');
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "ADD") {
      current_user_add_dislike(src);
    } else if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText == "CHANGE") {
      clientLikes[src] = true;
      current_user_add_dislike(src);
    }
  };
  xhr.open("POST", "./forms/like.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + src + "&type=D");
}
