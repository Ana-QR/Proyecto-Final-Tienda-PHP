<?php

namespace Models;

use Lib\Conexion;
use PDOException;
use PDO;
use Utils\Utils;

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
        $this->nombre = ucwords(strtolower($nombre));
    }

    // Listar todas las categorias
    public function getCategorias(){
        $conexion = new Conexion();
        $pdo = $conexion->getPdo();

        $stmt = $pdo->query("SELECT * FROM categorias");
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $conexion->close();

        return $categorias;
    }

    public function getCategoria(){
        try{
            $stmt = $this->db->getPDO()->prepare("SELECT * FROM categorias WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $categoria = $stmt->fetch();
            return $categoria;
        }catch(PDOException $e){
            echo "Error al obtener dicha categoria: " . $e->getMessage();
            return false;
        }
    }

    // Guardar(crear) una categoria
    public function guardar($nombre){
    try{
        $this->db = new Conexion();
        $stmt = $this->db->getPdo()->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

        $resultado = $stmt->execute();

        $this->db->close();
    
        return $resultado;
    }catch(PDOException $error){
        die("Error al insertar una categoría: " . $error->getMessage());
    }
    }
}
?>