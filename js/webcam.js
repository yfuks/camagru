var video = document.querySelector("#webcam");
var canvas = document.getElementById("canvas");
var button = document.getElementById("pickImage");
var miniatures = document.getElementById("miniatures");

var cadre = document.getElementById("cadre");
var cigarette = document.getElementById("cigarette");
var hat = document.getElementById("hat");

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, handleVideo, videoError);

    button.onclick = function() {
      var image = new Image();


      image.addEventListener("load", function() {
          if (file === "cadre.png") {
            canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 0, 0, 640, 480);
          } else if (file === "cigarette.png") {
            canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 100, 200, 240, 180);
          } else {
            canvas.getContext("2d").drawImage(image, 0, 0, 1024, 768, 180, 0, 240, 180);
          }
      }, false);

      image.src = document.querySelector('input[name="img"]:checked').value; // Set source path
      var split = image.src.split("/");
      var file = split[split.length - 1];

			canvas.getContext("2d").drawImage(video, 0, 0, 640, 480, 0, 0, 640, 480);
			var img = canvas.toDataURL("image/png");

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
    		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
          var newImg = document.createElement("IMG");
          newImg.className = "icon";
          newImg.src = "montage/" + xhr.responseText;
          newImg.dataset.removable = true;
          miniatures.appendChild(newImg);
    		}
  	  };
      xhr.open("POST", "/forms/montage.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("img=" + "../img/" + file + "&f=" + img);
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
      if (checkbox.id === "cadre.png") {
        cadre.style.display = "block";
        cigarette.style.display = "none";
        hat.style.display = "none";
      } else if (checkbox.id === "cigarette.png") {
        cadre.style.display = "none";
        cigarette.style.display = "block";
        hat.style.display = "none";
      } else {
        cadre.style.display = "none";
        cigarette.style.display = "none";
        hat.style.display = "block";
      }
  }
}
