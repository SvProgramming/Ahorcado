function objetoAjax() {
  var xmlhttp = false;

  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }

  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
    xmlhttp = new XMLHttpRequest();
  }

  return xmlhttp;
}

var xhttp = objetoAjax();

function foco() {
    var txtPalabra = document.getElementById('txtPalabra').focus();
}

function limpiar() {
    var limpiar1 = document.getElementById('txtPalabra');
    var limpiar2 = document.getElementById('txtPista');
    limpiar1.value = "";
    limpiar2.value = "";
}

function enviarEnter(event) {
    var codigo = event.which || event.keyCode;

    if(codigo === 13){
      enviarPalabra();
      limpiar();
      foco();
    }
}

function enviarPalabra() {
    var palabra = document.getElementById("txtPalabra").value;
    var pista = document.getElementById("txtPista").value;

    if (palabra == "" || pista == "") {
        alert('Debe completar todos los campos!');
    } else {
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("respuesta").innerHTML = this.responseText;
            }
        }

        xhttp.open("POST","aggPalabra.php", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("palabra=" + palabra + "&pista=" + pista);
    }
}
