<?php

Namespace Models;
use Lib\conexion;

use PDO;
use PDOException;

class Producto {

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = new Conexion();
    }

    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setOferta($oferta) {
        $this->oferta = $oferta;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    // Obtener todos los productos
    public function getProductos() {
        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM productos ORDER BY id DESC");
            $stmt->execute();
            $productos = $stmt->fetchAll();
            return $productos;
        } catch (PDOException $e) {
            error_log("Error al obtener productos: " . $e->getMessage());
            return false;
        }
    }

    // Guardar un producto
    public function guardar(){
        if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{3,}$/', $this->nombre) &&
           preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{3,}$/', $this->descripcion) &&
           preg_match('/^\d+(\.\d{1,2})?$/', $this->precio) && // Permite valores decimales
           preg_match('/^[0-9]+$/', $this->stock)){
            try {
                $stmt = $this->db->getPdo()->prepare("INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, null, CURDATE(), :imagen)");
                $stmt->bindParam(':categoria_id', $this->categoria_id);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':precio', $this->precio);
                $stmt->bindParam(':stock', $this->stock);
                $stmt->bindParam(':imagen', $this->imagen);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Error al guardar producto: " . $e->getMessage());
                return false;
            }
        } else {
            $_SESSION['errorProducto'] = 'true';
            return false;
        }
    }

    // Obtener productos aleatorios
    public function getProductosAleatorios($numProductos){
        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM productos ORDER BY RAND() LIMIT :numProductos");
            $stmt->bindParam(':numProductos', $numProductos, PDO::PARAM_INT);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $productos;
        } catch (PDOException $e) {
            error_log("Error al obtener productos aleatorios: " . $e->getMessage());
            return false;
        }
    }

    // Obtener productos por categoría
    public function getProductosCategoria(){
        try {
            $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE c.id = {$this->getCategoriaId()} "
                . " ORDER BY id DESC;";
            
            $stmt = $this->db->getPdo()->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll();
            return $productos;

        } catch (PDOException $e) {
            error_log("Error al obtener productos por categoría: " . $e->getMessage());
            return false;
        }
    }
}