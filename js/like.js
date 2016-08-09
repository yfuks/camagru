var likes = document.getElementsByClassName("button-like");
var dislikes = document.getElementsByClassName("button-dislike");

for (var i=0; i < likes.length; i++) {
  likes[i].onclick = function(event) {
    console.log('like', event.srcElement.getAttribute('data-image'));
  }
}

for (var i=0; i < dislikes.length; i++) {
  dislikes[i].onclick = function(event) {
    console.log('dislike', event.srcElement.getAttribute('data-image'));
  }
}
