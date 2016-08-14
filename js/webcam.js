var video = document.querySelector("#webcam");
var canvas = document.getElementById("canvas");
var button = document.getElementById("pickImage");
var miniatures = document.getElementById("miniatures");
var inputFile = document.getElementById("take-picture");
var pickFile = document.getElementById("pickFile");
var notAvailable = document.getElementById("camera-not-available");

var cadre = document.getElementById("cadre");
var cigarette = document.getElementById("cigarette");
var hat = document.getElementById("hat");

var cameraAvailable = false;

var promisifiedOldGUM = function(constraints) {

  var getUserMedia = (navigator.getUserMedia ||
      navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia ||
      navigator.msGetUserMedia ||
      navigator.oGetUserMedia);

  if(!getUserMedia) {
    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
  }

  return new Promise(function(resolve, reject) {
    getUserMedia.call(navigator, constraints, resolve, reject);
  });
}

if(navigator.mediaDevices === undefined) {
  navigator.mediaDevices = {};
}

if(navigator.mediaDevices.getUserMedia === undefined) {
  navigator.mediaDevices.getUserMedia = promisifiedOldGUM;
}

var constraints = {video: true};

navigator.mediaDevices.getUserMedia(constraints)
.then(handleVideo)
.catch(videoError);

function handleVideo(stream) {
    video.src = window.URL.createObjectURL(stream);
    cameraAvailable = true;
    video.style.display = "block";
    notAvailable.style.display = "none";
    button.onclick = function() {
      var image = new Image();
      canvas.style.display = "none";
      pickFile.style.display = "none";

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
          newImg.className = "icon removable";
          newImg.src = "montage/" + xhr.responseText;
          newImg.onclick = function(event) {
            var pathToImg = event.srcElement.src;
            var srcTab = pathToImg.split('/');
            var src = srcTab[srcTab.length - 1];

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
              if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
                miniatures.removeChild(event.srcElement);
              }
            };
            xhr.open("POST", "./forms/removemontage.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("src=" + src);
          }
          miniatures.appendChild(newImg);
    		}
  	  };
      xhr.open("POST", "./forms/montage.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("img=" + "../img/" + file + "&f=" + img);
		};
}

function videoError(e) {
    cameraAvailable = false;
    video.style.display = "none";
    notAvailable.style.display = "block";
}

function onCheckBoxChecked(checkbox) {
  if (cameraAvailable) {
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
  inputFile.style.display = "block";
  if (inputFile.files.length) {
    var image = new Image();
    var img = new Image();
    image.addEventListener("load", function() {
        canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
        canvas.getContext("2d").drawImage(image, 0, 0, image.width, image.height, 0, 0, 640, 480);
        var data64Img = canvas.toDataURL(image.type);
        window.URL.revokeObjectURL(file);

        img.src = document.querySelector('input[name="img"]:checked').value; // Set source path
        var split = img.src.split("/");
        var file = split[split.length - 1];

        if (file === "cadre.png") {
          canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 0, 0, 640, 480);
        } else if (file === "cigarette.png") {
          canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 100, 200, 240, 180);
        } else {
          canvas.getContext("2d").drawImage(img, 0, 0, 1024, 768, 180, 0, 240, 180);
        }

        pickFile.onclick = function () {
          sendMontage(data64Img, file);
        }
    }, false);
    image.src = window.URL.createObjectURL(inputFile.files[0]);
  }
}


function sendMontage(imgData64, filterImg) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
      var newImg = document.createElement("IMG");
      newImg.className = "icon removable";
      newImg.src = "montage/" + xhr.responseText;
      newImg.onclick = function(event) {
        var pathToImg = event.srcElement.src;
        var srcTab = pathToImg.split('/');
        var src = srcTab[srcTab.length - 1];

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
            miniatures.removeChild(event.srcElement);
          }
        };
        xhr.open("POST", "./forms/removemontage.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("src=" + src);
      }
      miniatures.appendChild(newImg);
    }
  };
  xhr.open("POST", "./forms/montage.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("img=" + "../img/" + filterImg + "&f=" + imgData64);
}
