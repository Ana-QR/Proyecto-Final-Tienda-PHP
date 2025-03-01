<?php

namespace Models;

use Lib\Conexion;
use PDO;
use PDOException;

class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = new Conexion();
    }

    // Getters y Setters
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->getPDO()->quote($nombre);
    }

    // Listar todas las categorias
    public function getAll(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $categorias = $this->db->getPDO()->query($sql);
        return $categorias;
    }

    // Guardar una categoria
    public function guardar(){
        $sql = "INSERT INTO categorias VALUES('{$this->getNombre()}')";
        $guardar = $this->db->getPDO()->query($sql);
        return $guardar;
    }
}
?>