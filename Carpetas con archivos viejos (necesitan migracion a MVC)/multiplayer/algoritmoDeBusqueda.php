<?php

class BusquedaContrincante
{
	private $usuario;
	private $host;
	private $hostUser;
	private $hostContra;
	private $hostDB;

	public function __construct($usuar)
	{
		$this->usuario=$usuar;
		$contDB = file("../engine/datosDB/dbName.txt");
		$contUser = file("../engine/datosDB/username.txt");
		$contUrl = file("../engine/datosDB/url.txt");
		$contPass = file("../engine/datosDB/pass.txt");

		$this->host = $contUrl[0];
		$this->hostUser = $contUser[0];

		if ($contPass[0] == 0) {
			$this->hostContra = "";
		} else {
			$this->hostContra = $contPass[0];
		}

		$this->hostDB = $contDB[0];
	}

	public function RegistrarEnDB() //funcion que guarda usuarios buscando partidas actualmente en la DB
	{
		$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);

		if($conex->connect_error)//comprobando conexion
		{
			echo "Error en la conexion 1: ". $conex->connect_error;
		}

		//comprobando si ya esta el usuario
		if(!$consultaRepeticion = $conex->query("select usuario from UsuariosBuscandoPartida where Usuario=\"$this->usuario\""))
		{
			echo "Error en la consulta select: " . $conex->error;
			exit();
		}



		if($consultaRepeticion->num_rows > 0)
		{
			echo "Error: no puede realizar la peticion 2 veces";
			exit();
		}

		//añadiendo usuario a la tabla de busqueda
		if($conex->query("insert into UsuariosBuscandoPartida(Usuario) values (\"$this->usuario\")") != true)
		{
			echo "Problema en el insert: " . $conex->error;
			exit();
		}

		//cerrando conexion y pasando a la funcion de emparejamiento
		$conex->close();
		$this->JuntarJugadores();
	}


	private function JuntarJugadores()
	{
		do{

			$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);

			if($conex->connect_error)//comprobando conexion
			{
				echo "Error en la conexion 2: ". $conex->connect_error;
				exit();
			}

			if(!$consultacant=$conex->query("select count(usuario) as 'cantidad' from UsuariosBuscandoPartida"))
			{
				echo "Error en el select: " . $conex->error;
				exit();
			}

			$cantidadUsuarios=$consultacant->fetch_array(MYSQLI_ASSOC);

			$consultacant->free();



			$numeroA=rand(0,($cantidadUsuarios['cantidad']-1));

			$conex->close();


			$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);

			if($conex->connect_error)//comprobando conexion
			{
				echo "Error en la conexion 3: ". $conex->connect_error;
				exit();
			}


			if(!$consultaUsers=$conex->query("select usuario as 'usuarios' from UsuariosBuscandoPartida"))
			{
				echo "Error en el select: ". $conex->error;
				exit();
			}

			$numeroCols=$consultaUsers->num_rows;



			if($numeroCols>1)
			{

				$i=0;

				while($arrayUsersActivos=$consultaUsers->fetch_array(MYSQLI_ASSOC))
				{
					$UsuariosActivos[$i]=$arrayUsersActivos['usuarios'];
					$i++;
				}


				$conex->close();

				$versus1=$UsuariosActivos[$numeroA];


				

				do{

					$numeroA2=rand(0,($cantidadUsuarios['cantidad']-1));

				}while($numeroA==$numeroA2);




				$versus2=$UsuariosActivos[$numeroA2];

				echo $versus1 . " vs " . $versus2;



				$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);

				if($conex->connect_error)
				{
					echo "Error en la conexion 3: ". $conex->connect_error;
					exit();
				}

				if(!$conex->query("delete from UsuariosBuscandoPartida where
				Usuario=\"$versus1\" or Usuario=\"$versus2\""))
				{
					echo "Problemas con el delete: ". $conex->error;
				}

				$conex->close();

			}


			}while($numeroCols<=1);



	}
}

$hola=new BusquedaContrincante("ref98");

$hola->RegistrarEnDB();



?>
