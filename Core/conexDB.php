<?php
@define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . "/Config/db.php");
require_once "encriptacion.php";

class funcionesDB
{
    private $db;

    public function __construct()
    {
        $cantidadArgumentos=func_num_args();
        if($cantidadArgumentos==1)
        {
           /*Si se necesitara conectar a otra base de datos se puede usar esta funcion*/
        }
        else
        {
             try {
                $this->db = BaseDatos::conexion();
                if (gettype($this->db) == "string") {
                    echo "<br><br><br>Error en la conexión: " . utf8_encode($this->db);
                    exit();
                    /**
                     * Se crea la conexión con la db
                     */
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }


    /**
     * Función de inserción de datos en la base de datos.
     *
     * @param $tabla : Tabla de destino de los datos
     * @param $campos : Campos afectados
     * @param $valores : Datos a insertar
     * @return bool|mysqli_result|string : Resultado de la inserción
     */

    public function insertar($tabla, $campos, $valores)
    {
        $sql = "INSERT INTO $tabla($campos) VALUES ($valores)";
        if ($resultado = $this->db->query($sql)) {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        } else {
            $error = $this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error al insertar el registro: " . $error;
        }
    }

    /**
     * Funcion que se encarga de actualizar un solo registro en la db
     *
     * @param $tabla : Tabla de origen de los datos
     * @param $campo : Campo afectado
     * @param $valor : Nuevo valor
     * @param $condicion : Filtro o condicion para actualizar el registro
     * @return bool|mysqli_result|string : Resultado de la consulta
     */
    public function ActualizarRegistro($tabla, $campo, $valor, $condicion)
    {
        $resultado = $this->db->query("UPDATE $tabla set $campo='$valor' where $condicion");
        if ($resultado)
        {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        }
        else
        {
            $error = $this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error en la actualizacion de campo: " . $error;
        }
    }

    /**
     * Función que se encarga de consultar todos los campos una tabla, esta consulta puede ser filtrada o no en otras
     * palabras, el parametro condicion es opcional.
     *
     * @param $tabla
     * @param $condicion
     * @return bool|mysqli_result|string
     */

    public function ConsultaGeneral($tabla, $condicion)
    {
        if($condicion != "")
        {
            $resultado = $this->db->query("select * from $tabla where $condicion");
        }
        else
        {
            $resultado = $this->db->query("select * from $tabla");
        }

        if($resultado)
        {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        }
        else
        {
            $error = $this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error en la consulta: " . $error;
        }

    }

    /**
     * Función que ejecuta una consulta personalizada.
     *
     * @param $sql
     * @return bool|mysqli_result|string
     */

    public function ConsultaPersonalizada($sql)
    {
        $resultado = $this->db->query($sql);

        if ($resultado) {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        } else {
            $error = $this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error en la consulta: " . $error;
        }
    }

    /**
     * Función
     * @param $tabla
     * @param $campos
     * @param $condicion
     * @return bool|mysqli_result
     */

    public function ConsultaDeCampos($tabla, $campos, $condicion)
    {
        if ($condicion != "")
        {
            $sql = "SELECT $campos FROM $tabla WHERE $condicion";
        }
        else
        {
            $sql = "SELECT $campos FROM $tabla";
        }
        //Hacemos la consulta
        $resultado = $this->db->query($sql);
        //Cerrando conexión
        $this->db->close();

        return $resultado;
    }

    public function EliminarRegistro($tabla,$condicion)
    {
        if($condicion!="")
        {
            $resultado=$this->db->query("DELETE from $tabla where $condicion");
        }
        else
        {
            $resultado="Error. Por seguridad no puede hacer un DELETE sin una condición.";
        }

        if($resultado)
        {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        }
        else
        {
            $error=$this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error en la consulta: ". $error;
        }

    }

    /*Multiples registros*/

    public function ActualizarRegistros($tabla, $camposValores, $condicion)
    {
        $resultado = $this->db->query("UPDATE $tabla set $camposValores where $condicion");
        if ($resultado) 
        {
            //Cerrando conexión
            $this->db->close();
            return $resultado;
        }
        else 
        {
            $error = $this->db->error;
            //Cerrando conexión
            $this->db->close();
            return "Error en la actualizacion de campo: " . $error;
        }
    }
}

?>
