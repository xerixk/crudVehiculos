<?php

require_once "Conexion.php";

class Usuario{
    private $conn;
    public $id;
    public $marca;
    public $color;
    public $kilometros;

    public function __construct(){
        $db= new Conexion();
        $this->conn =$db->getConexion();

    }

    public function listar(){
        $sql="SELECT * FROM vehiculos";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function leer($id){
        $sql="SELECT * FROM vehiculos where id=$id";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function leerMatricula($matricula){
        $sql="SELECT * FROM vehiculos where matricula='$matricula'";
        $stmn=$this ->conn->prepare($sql);
        $stmn->execute();
        $datos= $stmn->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function crear($matricula,$marca,$color,$kilometros){
        if($this->leerMatricula($matricula)){
         echo "Ya existe un vehiculo con matricula = $matricula";
         return false;
        }else{
             $sql="INSERT INTO vehiculos (matricula,marca,color, kilometros) VALUES ('$matricula','$marca','$color',$kilometros)";
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
     public function eliminar($id){
        if($this->leer($id)){
            $sql = "DELETE FROM vehiculos where id = $id";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute()){
                echo "Eliminado correctamente";
                return true;
            }else{
                echo "No Eliminado";
                return false;
            }
        }else{
            echo "No existe un vehiculo con id = $id";
            return false;
        }
    }
    public function actualizar($matricula,$marca,$color,$kilometros,$id){

        if($this->leer($id)){
        $sql="UPDATE vehiculos set matricula='$matricula',marca='$marca',color='$color',kilometros=$kilometros where id=$id";
        $stmn=$this ->conn->prepare($sql);
        if( $stmn->execute()){
            echo "Actualizado Correctamente";
         return true;
        }else{
            echo "Error al actualizar";
         return false;
        }
        }else{
            echo "No existe un vehiculo con id = $id";
            return false;
        }
    }
}
$matricula='6789XYZ';
$marca ='YAMAHA R1';
$color='AMARILLO';
$kilometros=12000;



$u= new Usuario();
var_dump($u->actualizar($matricula,$marca,$color,$kilometros,12));

?>