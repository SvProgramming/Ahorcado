function iniciar()
{
	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {iniciarJuego : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;
		      }
	  	});
}

function foco()
{
    var txtLetra = document.getElementById('txtLetra').focus();
}

function juegoFinalizado()
{
	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {juegoFinalizado : true},
		      success   : function(respuesta)
		      {
		      	if(respuesta=="1")
		      	{
		      		detenerReloj();

		      		var div=document.getElementById('divEscribirLetras');
		      		var div2=document.getElementById('divRespuesta');

		      		div.innerHTML="";
		      		div2.classList.add('oculto');
		      	}
		      }
	  	});
}

function limpiar()
{
    var limpiar = document.getElementById('txtLetra');
    limpiar.value = "";
}

function enviarEnter(event)
{
    var codigo = event.which || event.keyCode;

    if(codigo === 13)
    {
      enviarLetra();
      limpiar();
    }
}


var detener=false;

function detenerReloj()
{
	detener=true;
}

function enviarLetra()
{
    var letra = document.getElementById("txtLetra").value;

    if(letra == "")
    {
    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {noIngresoNada : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;
		      }
	  	});
        foco();
    }
    else
    {
    	iniciarReloj();

    	document.getElementById('btnEnviarLetra').innerHTML="Aceptar";

    	var tiempo = document.getElementById('reloj').value;

    	var botonNuevaPalabra = document.getElementById('cambiarLetra').classList.add('oculto');

    	var divLetrasUsadas = document.getElementById('letrasUsadas').classList.remove('oculto');

    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {letra: letra, tiempo: tiempo, evaluarLetra : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;

		      	actualizarLetrasUsadas();

		      	juegoFinalizado();
		      }
	  	});
    }
}

var minutos=0;
var segundos=0;
var iniciado=false;

function iniciarReloj()
{
	if(!iniciado)
	{
		var reloj=document.getElementById('reloj');

		reloj.value="0:00";

		iniciado=true;

		setTimeout("aumentarReloj()",1000);
	}
}

function aumentarReloj()
{
	if(!detener)
	{
		var reloj=document.getElementById('reloj');

		if(segundos==59)
		{
			minutos++;
			segundos=0;

			reloj.value=minutos+":0"+segundos;
		}
		else
		{
			segundos++;

			if(segundos<=9)
			{
				reloj.value=minutos+":0"+segundos;
			}
			else
			{
				reloj.value=minutos+":"+segundos;
			}
		}

		setTimeout("aumentarReloj()",1000);
	}
}

function actualizarLetrasUsadas()
{
	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {actualizarLetrasUsadas : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("letrasUsadas").innerHTML='<h3>Letras usadas:</h3>'+respuesta;
		      }
	  	});
}

/*Funciones para agregar palabra*/


function focoPalabra()
{
    var txtPalabra = document.getElementById('txtPalabra').focus();
}

function limpiarPalabra()
{
    var limpiar1 = document.getElementById('txtPalabra');
    var limpiar2 = document.getElementById('txtPista');
    limpiar1.value = "";
    limpiar2.value = "";
}

function enviarEnterPalabra(event)
{
    var codigo = event.which || event.keyCode;

    if(codigo === 13)
    {
      enviarPalabra();
      limpiar();
      foco();
    }
}

function enviarPalabra()
{
    var palabra = document.getElementById("txtPalabra").value;
    var pista = document.getElementById("txtPista").value;

    var divRespuesta = document.getElementById('respuesta');

    if (palabra == "" || pista == "")
    {
        divRespuesta.innerHTML='Debe completar todos los campos.';
    }
    else
    {
    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/agregarPalabra',
		      data      : {palabra : palabra, pista : pista, agregarPalabra : true},
		      success   : function(respuesta)
		      {
		      	divRespuesta.innerHTML = respuesta;
		      }
	  	});
    }
}

/*Funciones para contra reloj*/


function enviarLetra(modoJuego)
{
    var letra = document.getElementById("txtLetra").value;

    if(letra == "")
    {
    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {noIngresoNada : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;
		      }
	  	});
        foco();
    }
    else
    {
    	if(modoJuego==1)
    	{
    		iniciarReloj();
    	}
    	else
    	{
    		iniciarContraReloj();
    	}

    	document.getElementById('btnEnviarLetra').innerHTML="Aceptar";

    	var tiempo = document.getElementById('reloj').value;

    	var botonNuevaPalabra = document.getElementById('cambiarLetra').classList.add('oculto');

    	var divLetrasUsadas = document.getElementById('letrasUsadas').classList.remove('oculto');

    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {letra: letra, tiempo: tiempo, modoJuego : modoJuego, evaluarLetra : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;

		      	actualizarLetrasUsadas();

		      	juegoFinalizado();
		      }
	  	});
    }
}

function iniciarContraReloj()
{
	if(!iniciado)
	{
		var reloj=document.getElementById('reloj');

		reloj.value="1:00";

		iniciado=true;

		minutos=1;

		setTimeout("disminuirReloj()",1000);
	}
}

function disminuirReloj()
{
	if(!detener)
	{
		var reloj=document.getElementById('reloj');

		if(segundos==0)
		{
			minutos--;
			segundos=59;

			reloj.value=minutos+":"+segundos;
		}
		else if(minutos == 0 && segundos == 1)
		{
			detenerReloj();
			reloj.value="0:00";
			finalizarJuego();
		}
		else
		{
			segundos--;

			if(segundos<=9)
			{
				reloj.value=minutos+":0"+segundos;
			}
			else
			{
				reloj.value=minutos+":"+segundos;
			}
		}

		if(segundos==10 && minutos==0)
		{
			reloj.classList.add('reloj-peligro');
		}

		setTimeout("disminuirReloj()",1000);
	}
}

function finalizarJuego()
{
	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {finalizarJuegoContraReloj : true},
		      success   : function(respuesta)
		      {
		      	var divRespuesta=document.getElementById('respuesta');
		      	var div=document.getElementById('divEscribirLetras');
	      		var div2=document.getElementById('divRespuesta');

	      		divRespuesta.innerHTML=respuesta;

	      		div.innerHTML="";
	      		div2.classList.add('oculto');
		      }
	  	});
}