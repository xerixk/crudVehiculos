<?php

require_once "Conexion.php";

class Usuario{
    private $conn;
    public $id;
    public $nombre;
    public $dni;
    public $vehiculo_id;

    public function __construct(){
        $db= new Conexion();
        $this->conn =$db->getConexion();

    }

    public function listar(){
        $sql="SELECT * FROM usuarios";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function crear($nombre,$dni,$vehiculo_id){
       if($this->leerDNI($dni)){
        echo "Ya existe un usuario con dni = $dni";
        return false;
       }else{
            $sql="INSERT INTO usuarios (nombre,dni,vehiculo_id) VALUES ('$nombre','$dni',$vehiculo_id)";
            $stmn=$this ->conn->prepare($sql);
        if( $stmn->execute()){
            echo "creado correctamente";
            return true;
        }else{
            echo "error al crear";
            return false;
        }
       }
    }
    public function leer($id){
        $sql="SELECT * FROM usuarios where id=$id";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function leerDNI($dni){
        $sql="SELECT * FROM usuarios where dni='$dni'";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    
    public function eliminar($id){
        if($this->leer($id)){
            $sql = "DELETE FROM usuarios where id = $id";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute()){
                echo "Eliminado correctamente";
                return true;
            }else{
                echo "No Eliminado";
                return false;
            }
        }else{
            echo "No existe un usuario con id = $id";
            return false;
        }
    }
    public function actualizar($nombre,$dni,$vehiculo_id,$id){

        if($this->leer($id)){
        $sql="UPDATE usuarios set nombre='$nombre',dni='$dni',vehiculo_id=$vehiculo_id where id=$id";
        $stmn=$this ->conn->prepare($sql);
        if( $stmn->execute()){
            echo "Actualizado Correctamente";
         return true;
        }else{
            echo "Error al actualizar";
         return false;
        }
        }else{
            echo "No existe un usuario con id = $id";
            return false;
        }
    }
    public function usuVehiculos($vehiculo_id){
        
            $sql= "SELECT u.* FROM usuarios u INNER JOIN vehiculos v ON u.vehiculo_id = v.id WHERE v.id = $vehiculo_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        
    }

}


$dni="1234468F";
$nombre="Rober";
$vehiculo_id=2;

$u= new Usuario();
var_dump($u->usuVehiculos(1));
?>