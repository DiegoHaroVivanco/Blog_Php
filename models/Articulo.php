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

    public function leer_individual($id){

        $query = 'SELECT id, titulo, imagen, texto, fecha_creacion FROM ' .$this->table .' WHERE id = ?
        LIMIT 0,1 ';
        $stmt = $this -> conn->prepare($query);

        // vinculamos el parámetro
        $stmt->bindParam(1, $id);

        $stmt->execute();
        $articulos = $stmt->fetch(PDO::FETCH_OBJ);
        return $articulos;
    }

    public function crear($titulo, $imgName, $texto){
        $query = 'INSERT INTO ' .$this->table . ' (titulo, imagen, texto)VALUES(:titulo, :imagen, :texto) ';
        
        $stnt = $this->conn->prepare($query);

        $stnt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $stnt->bindParam(":imagen", $imgName, PDO::PARAM_STR);
        $stnt->bindParam(":texto", $texto, PDO::PARAM_STR);

        // se ejecuta la query
        if($stnt->execute()){
            return true;
        }
        // si hay algún error
        printf("error $s\n", $stnt->error);
    }



}



?>