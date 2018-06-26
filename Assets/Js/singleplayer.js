function iniciar()
{
	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {iniciar : true},
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

    	$.ajax({
		      type      : 'post',
		      async		:  false,
		      url       : 'ajax/normal',
		      data      : {letra: letra, evaluarLetra : true},
		      success   : function(respuesta)
		      {
		      	document.getElementById("respuesta").innerHTML = respuesta;
		      }
	  	});
    }
}
