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

		      		div.classList.add('oculto');
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
        alert('Debe ingresar una letra');
        foco();
    }
    else
    {
    	iniciarReloj();

    	var tiempo = document.getElementById('reloj').value;

    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {letra: letra, tiempo: tiempo, evaluarLetra : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;

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