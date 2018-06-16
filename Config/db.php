<?php
@define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__."/core/encriptacion.php");

@$hostA=fopen(__ROOT__."/config/host.txt", "r");
@$host=fgets($hostA);
@$userA=fopen(__ROOT__."/config/user.txt", "r");
@$user=fgets($userA);
@$passA=fopen(__ROOT__."/config/pass.txt", "r");
@$pass=fgets($passA);
@$databaseA=fopen(__ROOT__."/config/database.txt", "r");
@$database=fgets($databaseA);

define('HOST',$host);
define('USER',$user);
define('PASS',$pass);
define('DATABASE',$database);

@fclose($hostA);
@fclose($userA);
@fclose($passA);
@fclose($databaseA);

class BaseDatos
{
	private $db;

	public static function conexion()
	{
		require_once(__ROOT__."/Core/encriptacion.php");
		$encriptacion=new encriptacion();

		$db = new mysqli($encriptacion->desencriptar(HOST),$encriptacion->desencriptar(USER),$encriptacion->desencriptar(PASS),$encriptacion->desencriptar(DATABASE));

		if (!$db->set_charset("utf8"))
		{
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $db->error);
			exit();
		}

		if($db->connect_error)
		{
			return "La conexión ha fallado: ". $db->connect_error;
		}
		else {
			return $db;
		}
	}
}
?>
