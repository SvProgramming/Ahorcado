<?php 
define("__ROOT__", dirname(dirname(__FILE__)));
require_once (__ROOT__."/Core/encriptacion.php");
require_once (__ROOT__."/Modelos/login.modelo.php");
require_once (__ROOT__."/Vistas/login.vista.php");

class RegistroControlador
{
    private $modelo;
    private $vista;

    function __construct($modelo,$vista)
    {
        $this->modelo = new $modelo;
        $this->vista = new $vista;
    }

    public function cargarVista()
    {
    	$this->vista->cargarVista();
    }

    public function comprobarSession()
    {
        session_start();

        if(isset($_SESSION['usuario']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function ajax($pagina)
    {
        define('BaseDir', getcwd());
        require_once BaseDir.'/Core/Ajax/'.$pagina.'.ajax.php';
    }

    public function verificarUsuario($usuario)
    {
        $resultado = $this->modelo->verificarUsuario($usuario);

        if($resultado->num_rows == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function verificarCorreo($correo)
    {
        $resultado = $this->modelo->verificarCorreo($correo);

        if($resultado->num_rows == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function registrarUsuario($usuario,$contraRecibida,$email)
    {
        $encriptacion=new encriptacion();

        $contra=$encriptacion->encriptar($contraRecibida);

        $codigoVerificacion=random_int(10000, 100000);

        $resultado=$this->modelo->registrarUsuario($usuario,$contra,$email,$codigoVerificacion);

        if(gettype($resultado)=="string")
        {
            return 0;
        }
        else
        {
            $resultado=$this->enviarCorreo('ahorcadoPhp.SvProgramming@gmail.com','ahorcadoPhpSv98',$email,'SvProgramming','Codigo de verificacion',"Su codigo para verificar el correo es: $codigoVerificacion. Si tiene algun problema por favor contactenos a este mismo correo.");

            return $resultado;
        }
    }

    public function enviarCorreo($correoEmisor,$contra,$correoReceptor,$nombreEmisor,$asunto,$mensaje)
    {
        define(__ROOT__,dirname(dirname(dirname(__FILE__))));

        /*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
        require_once(__ROOT__.'/Core/phpmailer/src/PHPMailer.php');
        require_once(__ROOT__.'/Core/phpmailer/src/SMTP.php');
         
        //Crear una instancia de PHPMailer
        $mail = new PHPMailer();
        //Definir que vamos a usar SMTP
        $mail->IsSMTP();
        //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
        // 0 = off (producción)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug  = 0;
        //Ahora definimos gmail como servidor que aloja nuestro SMTP
        $mail->Host       = 'smtp.gmail.com';
        //El puerto será el 587 ya que usamos encriptación TLS
        $mail->Port       = 465;
        //Definmos la seguridad como TLS
        $mail->SMTPSecure = 'ssl';
        //Tenemos que usar gmail autenticados, así que esto a TRUE
        $mail->SMTPAuth   = true;
        //Definimos la cuenta que vamos a usar. Dirección completa de la misma
        $mail->Username   = $correoEmisor;
        //Introducimos nuestra contraseña de gmail
        $mail->Password   = $contra;
        //Definimos el remitente (dirección y, opcionalmente, nombre)
        $mail->SetFrom($correoEmisor, $nombreEmisor);
        //Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
        $mail->AddReplyTo($correoEmisor,'Responder a este correo cualquier duda:');
        //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
        $mail->AddAddress($correoReceptor, 'Usuario de ahorcado php');
        //Definimos el tema del email
        $mail->Subject = $asunto;
        //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
        $mail->MsgHTML($mensaje);
        //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
        $mail->AltBody = $mensaje;
        //Establecemos la codificacion
        $mail->CharSet = 'UTF-8';
        //Enviamos el correo
        if(!$mail->Send())
        {
          return "La direccion de correo es invalida";
        }
        else
        {
          return 1;
        }
    }

    public function borrarUsuario($usuario)
    {
        $resultado = $this->modelo->borrarUsuario($usuario);
    }
}

?>
