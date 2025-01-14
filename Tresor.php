<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8" />
    <title>Tresor Sicherheitssystem</title>   
    <meta name="description" content="Unterschriftenfeld in HTML mit Signature Pad" />   
    <link href="w.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript">
function Geheim () {
  var Passwort = "23081980";
  var Eingabe = window.prompt("Geben Sie den 8-Stelligen Sicherheitscode ein", "");
  if (Eingabe == Passwort) {
    document.getElementById ("hidden").style.display = "block";
    alert("Access granted!");
  } else {
			alert("Access denied!")
			location.href = "index.html";
  }
}
</script>
<body onload="Geheim()">

    <style type="text/css">
        .m-signature-pad--body canvas {
            position: relative;
            left: 0;
            top: 0;
            width: 100%;
            height: 250px;
            border: 1px solid #CCCCCC;
        }    
    </style>

</head>

<body>
<div class="w3-container">    
    <h1>Unterschrift notwendig</h1>
    
        <form class="w3-container" action="process.php" method="POST" name="DAFORM" onSubmit="submitForm();" enctype="multipart/form-data" target="_self">
        <div id="signature-pad" class="m-signature-pad">
            <div class="m-signature-pad--body">
                <canvas></canvas>
                <input type="hidden" name="signature" id="signature" value="">
            </div>
        </div>        

        <button type="submit" class="w3-btn w3-blue-grey">Absenden</button>
        <button type="button" class="w3-btn w3-black" onclick="signaturePad.clear();">Löschen</button>
        </form>
</div>

<script src="signature_pad.js"></script>
<script type="text/javascript">
var wrapper = document.getElementById("signature-pad"),
   canvas = wrapper.querySelector("canvas"),
   signaturePad;

/**
*  Behandlung der Größenänderung der Unterschriftenfelds
*/
function resizeCanvas() {
    var oldContent = signaturePad.toData();
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    signaturePad.clear();
    signaturePad.fromData(oldContent);
}


/**
*  Speichern des Inhaltes als Bild
*/
function download(filename) {
  var blob = dataURLToBlob(signaturePad.toDataURL());
  var url = window.URL.createObjectURL(blob);

  var a = document.createElement("a");
  a.style = "display: none";
  a.href = url;
  a.download = filename;

  document.body.appendChild(a);
  a.click();

  window.URL.revokeObjectURL(url);
}

/**
* DataURL in Binär umwandeln
*/
function dataURLToBlob(dataURL) {
  // Code von https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

/**
* Behanlung beim Absenden, damit der Inhalt des Canvas
* übermittelt werden kann, wird dieser als DataURL dem
* versteckten Feld zugewiesen    
*/
function submitForm() {
    //Unterschrift in verstecktes Feld übernehmen
    document.getElementById('signature').value = signaturePad.toDataURL();
}


var signaturePad = new SignaturePad(canvas);
signaturePad.minWidth = 1; //minimale Breite des Stiftes
signaturePad.maxWidth = 5; //maximale Breite des Stiftes
signaturePad.penColor = "#000000"; //Stiftfarbe
signaturePad.backgroundColor = "#FFFFFF"; //Hintergrundfarbe

window.onresize = resizeCanvas;
resizeCanvas();

</script>    
</body>
</html>