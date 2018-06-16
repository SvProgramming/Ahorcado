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

function registrar() {
    var username = document.getElementById('txtUsername').value;
    var password = document.getElementById('passUsername').value;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("resp").innerHTML = this.responseText;
                if (this.responseText === "1") {
                    alert("Usuario Creado con Exito!");
                    window.location.href = "../index.php";
                } else {
                    document.getElementById("resp").innerHTML = this.responseText;
                }
        }
    }

    xhttp.open("POST","register.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("user=" + username + "&pass=" + password);
}

function foco() {
    document.getElementById('txtUsername').focus();
}

function enviarEnter(event) {
    var codigo = event.which || event.keyCode;

    if(codigo === 13){
      registrar();
      limpiar();
    }
}

function limpiar() {
    document.getElementById('txtUsername').value = "";
    document.getElementById('passUsername').value = "";
    foco();
}
