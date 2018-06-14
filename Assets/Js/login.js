var resultadoVerificarUsuario;

function verificarDatos()
{
	var usuario = document.getElementById('txtUsername');
	var contra = document.getElementById('passUsername');
	var div = document.getElementById('divMensajes');

	if(usuario.value=="")
	{
		div.classList.remove('oculto');
		div.classList.add('mensaje','mensaje-error');

		div.innerHTML = "El campo de usuario no puede quedar vacio";
		usuario.focus();
	}
	else if(contra.value=="")
	{
		div.classList.remove('oculto');
		div.classList.add('mensaje','mensaje-error');

		div.innerHTML = "El campo de contraseña no puede quedar vacio";
		contra.focus();
	}
	else
	{
		verificarUsuario(usuario.value);

		if(!resultadoVerificarUsuario)
		{
			div.classList.remove('oculto');
			div.classList.add('mensaje','mensaje-error');

			div.innerHTML = "El usuario no esta registrado";
			usuario.focus();
		}
		else
		{
			$.ajax({
			      type      : 'post',
			      async		:  false,
			      url       : 'login/ajax/login',
			      data      : {usuario : usuario.value, contra : contra.value, comprobarContra : true},
			      success   : function(respuesta)
			      {
			      	if(respuesta != '1')
			      	{
			      		div.classList.remove('oculto');
						div.classList.add('mensaje','mensaje-error');

						div.innerHTML = respuesta;
						contra.focus();
			      	}
			      	else
			      	{
						window.location.href='/AhorcadoPhp/';
			      		div.classList.remove('mensaje','mensaje-error');
						div.classList.add('oculto');
			      	}
			      }
	  			});
		}
	}
}

function verificarUsuario(usuario)
{
	$.ajax({
	      type      : 'post',
	      async		:  false,
	      url       : 'login/ajax/login',
	      data      : {usuario: usuario, verificarUsuario : true},
	      success   : function(respuesta)
	      {
	      	resultadoVerificarUsuario = respuesta;
	      }
	  });
}