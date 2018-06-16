<?php
class encriptacion
{
	private $contra;
	private $metodo;
	private $iv;

	public function __construct()
	{
		//esta es la llave privada
		$this->contra = '3sc3RLrpd17';
		//metodo de encriptacion
		$this->metodo = 'aes-256-cbc';
	}

	public function encriptar($texto)
	{
		//esta es la llave publica y unica para cada cifrado
		$llave = password_hash($this->contra, PASSWORD_BCRYPT, ['cost' => 12]);
		//el iv tiene que contener un maximo de 16 caracteres y unico a la vez
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		//se encripta usando aes 256 cbc (cipher-block chaining)
		$textoEncriptado = openssl_encrypt($texto, $this->metodo, $llave.$this->contra, OPENSSL_RAW_DATA, $iv);
		//se retorna un string encriptado en base 64 para proteger la llave publica
		return base64_encode($textoEncriptado."::".$iv."::".$llave);
	}

	public function desencriptar($textoEncriptado)
	{
		//se separa del tecto encriptado el texto en aes, el iv y la llave publica
		@list($textoEncriptadoFinal,$iv,$llave)=explode("::", base64_decode($textoEncriptado));
		//se desencripta usando el inverso de aes 256 cbc
		$textoDesencriptado = openssl_decrypt($textoEncriptadoFinal, $this->metodo, $llave.$this->contra, OPENSSL_RAW_DATA, $iv);
		//se retorna un texto totalmente legible
		return $textoDesencriptado;
	}
}

/*
$encriptacion=new encriptacion();

$a=$encriptacion->encriptar('1234');

echo $a."<br><br>";

$b=$encriptacion->desencriptar($a);

echo $b."<br><br>";*/

/*------------------------------Area de pruebas--------------------------------*/
/*
$plaintext = 'Me gustan las pupusas';
$password = '3sc3RLrpd17';
$method = 'aes-256-cbc';

$key = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

echo "Esta es la key-> $key <br><br>";


// IV must be exact 16 chars (128 bit)
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

echo "Esta es la iv-> $iv <br><br>";


// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
$encrypted1 = openssl_encrypt($plaintext, $method, $key.$password, OPENSSL_RAW_DATA, $iv);

$encrypted = base64_encode($encrypted1."::".$iv."::".$key);

echo "Este es el encriptado: $encrypted <br><br>";

// My secret message me gustan las pupusas

list($textoEncriptado,$iv,$llave)=explode("::", base64_decode($encrypted));

echo "<br><br>

	Apartado para ver si funciona <br<br><br><br>

	esta es la cadena encryptada-> $textoEncriptado<br><br>

	esta es la iv -> $iv <br><br>

	esta es la llave unica -> $llave <br><br>
	";


$decrypted = openssl_decrypt($textoEncriptado, $method, $llave.$password, OPENSSL_RAW_DATA, $iv);

echo " este es el texto desencriptadop: $decrypted";
*/
?>
