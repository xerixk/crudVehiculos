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
       
        
        $sql="INSERT INTO usuarios (nombre,dni,vehiculo_id) VALUES ('$nombre','$dni',$vehiculo_id)";
        $stmn=$this ->conn->prepare($sql);
       if( $stmn->execute()){
        return true;
       }else{
        return false;
       }

       
    }
    public function leer($id){
        $sql="SELECT * FROM usuarios where id=$id";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function eliminar($id){
        $sql="DELETE * FROM usuarios where id=$id";
        $stmn=$this ->conn->prepare($sql);
        if( $stmn->execute()){
            echo "eliminado Correctamente";
         return true;
        }else{
            echo "Error al eliminar";
         return false;
        }
    }
    public function actualizar($nombre,$dni,$vehiculo_id,$id){

        
        $sql="UPDATE usuarios set nombre='$nombre',dni='$dni',vehiculo_id=$vehiculo_id where id=$id";
        $stmn=$this ->conn->prepare($sql);
        if( $stmn->execute()){
            echo "Actualizado Correctamente";
         return true;
        }else{
            echo "Error al actualizar";
         return false;
        }
    }
}


$dni="1234467F";
$nombre="Erickkk";
$vehiculo_id=3;

$u= new Usuario();
var_dump($u->actualizar($dni,$nombre,$vehiculo_id,6));
?>