var resultadoVerificarUsuario;
var resultadoVerificarCorreo;

function verificarDatos()
{
	var usuario = document.getElementById('txtUsername');
	var contra = document.getElementById('passUsername');
	var repetirContra = document.getElementById('repetirContra');
	var email = document.getElementById('email');
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
	else if(repetirContra.value=="")
	{
		div.classList.remove('oculto');
		div.classList.add('mensaje','mensaje-error');

		div.innerHTML = "Repita su contraseña";
		repetirContra.focus();
	}
	else if(contra.value != repetirContra.value)
	{
		div.classList.remove('oculto');
		div.classList.add('mensaje','mensaje-error');

		div.innerHTML = "Las contraseñas no coinciden";
		contra.value="";
		contra.focus();
	}
	else if(email.value=="")
	{
		div.classList.remove('oculto');
		div.classList.add('mensaje','mensaje-error');

		div.innerHTML = "El campo de email no puede quedar vacio";
		email.focus();
	}
	else
	{
		verificarUsuario(usuario.value);

		if(resultadoVerificarUsuario)
		{
			div.classList.remove('oculto');
			div.classList.add('mensaje','mensaje-error');

			div.innerHTML = "El usuario ya esta registrado";
			usuario.focus();
		}
		else
		{
			verificarCorreo(email.value);

			if(resultadoVerificarCorreo)
			{
				div.classList.remove('oculto');
				div.classList.add('mensaje','mensaje-error');

				div.innerHTML = "El correo ya esta siendo usado por otro usuario. Si cree que es un error contacte a los administradores";
				email.focus();
			}
			else
			{
				document.getElementById('fondoCargando').classList.remove('oculto');
				document.getElementById('fondoCargando').classList.add('fondoCargando');

				document.getElementById('cargando').classList.remove('oculto');
				document.getElementById('cargando').classList.add('cargando');

				$.ajax({
				      type      : 'post',
				      async		:  true,
				      url       : 'registro/ajax/registro',
				      data      : {usuario : usuario.value, contra : contra.value, email : email.value, registrar : true},
				      success   : function(respuesta)
				      {
						document.getElementById('fondoCargando').classList.remove('fondoCargando');
				      	document.getElementById('fondoCargando').classList.add('oculto');

						document.getElementById('cargando').classList.remove('cargando');
						document.getElementById('cargando').classList.add('oculto');

				      	if(respuesta != '1')
				      	{
				      		div.classList.remove('oculto');
							div.classList.add('mensaje','mensaje-error');

							div.innerHTML = respuesta;
							email.value="";
							email.focus();
				      	}
				      	else
				      	{
							window.location.href='registro/completo';
				      		div.classList.remove('mensaje','mensaje-error');
							div.classList.add('oculto');
				      	}
				      }
		  			});
			}
		}
	}
}

function verificarUsuario(usuario)
{
	$.ajax({
	      type      : 'post',
	      async		:  false,
	      url       : 'registro/ajax/registro',
	      data      : {usuario: usuario, verificarUsuario : true},
	      success   : function(respuesta)
	      {
	      	resultadoVerificarUsuario = respuesta;
	      }
	  });
}

function verificarCorreo(correo)
{
	$.ajax({
	      type      : 'post',
	      async		:  false,
	      url       : 'registro/ajax/registro',
	      data      : {correo : correo, verificarCorreo : true},
	      success   : function(respuesta)
	      {
	      	resultadoVerificarCorreo = respuesta;
	      }
	  });
}

function enviarEnter(event)
{
    var codigo = event.which || event.keyCode;

    if(codigo === 13)
    {
      verificarDatos();
    }
}
