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
    public function getAllCategorias(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $categorias = $this->db->getPDO()->query($sql);
        return $categorias;
    }

    public function getCategoria(){
        try{
            $stmt = $this->db->getPDO()->prepare("SELECT * FROM categorias WHERE id = :id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
            return $categoria;
        }catch(PDOException $e){
            echo "Error al obtener dicha categoria: " . $e->getMessage();
            return false;
        }
    }

    // Guardar una categoria
    public function guardar(){
        // Validar el nombre de la categoría
        if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{3,}$/', $this->nombre)) {
            try {
            $stmt = $this->db->getPDO()->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
            $stmt->bindParam(':nombre', $this->nombre);
            return $stmt->execute();
            } catch (PDOException $e) {
            error_log("Error al guardar la categoría: " . $e->getMessage());
            return false;
            }
        } else {
            $_SESSION['errorCategoria'] = 'true';
            return false;
        }
    }
}
?>