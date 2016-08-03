var video = document.querySelector("#webcam");
var canvas = document.getElementById("canvas");
var button = document.getElementById("pickImage");

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, handleVideo, videoError);

    button.onclick = function() {
      var image = new Image();
      image.addEventListener("load", function() {
          canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
      }, false);
      image.src = document.querySelector('input[name="img"]:checked').value; // Set source path

			canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
      canvas.style.display = "block";
			var img = canvas.toDataURL("image/png");
		};
}

function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
}

function videoError(e) {
    // do something
}

function onCheckBoxChecked(checkbox) {
  if (navigator.getUserMedia) {
      button.style.display = "block";
  }
}
