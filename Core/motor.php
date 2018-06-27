<?php 
class motor{
        
        private $palabra;
        private $posLetra;

        function __construct($palabra)
        {
            $this->palabra = $palabra;

            for($i=0; $i < strlen($palabra); $i++)
            {
                if(substr($palabra, $i, 1) === " ")
                {
                    $this->posLetra[$i] = " ";
                }
            }
        }

        public function verificarLetra($letra)
        {
            $letrasCorr = 0; //cantidad de letras correctas en la palabra

            for($i=0; $i < strlen($this->palabra); $i++)
            {
                if($letra == substr($this->palabra, $i, 1))
                {
                    $this->posLetra[$i] = $letra;
                    $letrasCorr++;
                }
                else
                {
                    $this->posLetra[$i] = 0;
                }
            }

            if($letrasCorr > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function mensaje()
        {
            echo "<script>alert('hola mundo');</script>";
        }

        public function getPos()
        {
            return $this->posLetra;
        }
    }
?>