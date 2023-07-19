<?php
class Articulo{

    private $conn;
    private $table = 'articulos';

    // Propiedades
    public $id;
    public $titulo;
    public$imagen;
    public$texto;
    public $fecha_creacion;


    public function __construct($db){
        $this->conn = $db;



    }

    //Obtener los artículos
    public function leer(){
        $query = 'SELECT id, titulo, imagen, texto,fecha_creacion FROM ' .$this->table;
    
        $stmt = $this -> conn->prepare($query);

        $stmt->execute();
        $articulos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $articulos;
    }



}



?>