var fileInput = document.getElementById("take-picture");
var canvas = document.getElementById("canvas");
var miniatures = document.getElementById("miniatures");
var pickFile = document.getElementById("pickFile");

fileInput.onchange = function (event) {
  var file = this.files[0];
  var image = new Image();
  var img = new Image();
  var data64Img = null;

  canvas.style.display = "block";

  image.addEventListener("load", function(e) {
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

  image.src = window.URL.createObjectURL(this.files[0]);
  pickFile.style.display = "block";
}

function sendMontage(imgData64, filterImg) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText != null && xhr.responseText != "") {
      var newImg = document.createElement("IMG");
      newImg.className = "icon removable";
      newImg.src = "montage/" + xhr.responseText;
      newImg.onclick = function(event) {
        var pathToImg = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
        var srcTab = pathToImg.split('/');
        var src = srcTab[srcTab.length - 1];

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) && xhr.responseText == "OK") {
            miniatures.removeChild(event.srcElement || event.target);
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
