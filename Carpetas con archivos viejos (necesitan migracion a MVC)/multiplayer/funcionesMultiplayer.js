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
    var txtLetra = document.getElementById('txtLetra').focus();
}

function limpiar() {
    var limpiar = document.getElementById('txtLetra');
    limpiar.value = "";
}

function enviarEnter(event) {
    var codigo = event.which || event.keyCode;

    if(codigo === 13){
      enviarLetra();
      limpiar();
    }
}

function iniciar() {
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("respuesta").innerHTML = this.responseText;
        }
    }

    xhttp.open("POST","evaluarPalabra.php", true);
    xhttp.send();
}

function enviarLetra() {
    var letra = document.getElementById("txtLetra").value;

    if (letra == "") {
        alert('Debe ingresar una letra!');
        foco();
    } else {
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("respuesta").innerHTML = this.responseText;
            }
        }

        xhttp.open("POST","evaluarPalabra.php", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("letra=" + letra);
    }
}
