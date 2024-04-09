<?php

    class Conexion{
        private $host="localhost";
        private $bd_name="vehiculos_usuarios_db";
        private $user="root";
        private $password="root";  
        public $conn;
        public function getConexion(){
            try{
                $this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->bd_name,$this->user,$this->password);
                

            }catch(PDOException $e){
                echo"Error de conexion: " .$e->getMessage();
            }
            return $this->conn;
        }

        
    }

    $c= new Conexion();
    $c->getConexion();
    print_r($c->conn);

?>