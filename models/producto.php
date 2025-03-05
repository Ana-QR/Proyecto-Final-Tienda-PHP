<?php

Namespace Models;

require_once __DIR__.'../Lib/conexion.php';

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
    public function getProductos()
    {
        try {
            $sql = "SELECT p.*, c.nombre AS categoria FROM productos p JOIN categorias c ON p.categoria_id = c.id";
            $stmt = $this->db->getPdo()->query($sql);
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($productos)) {
                return [];
            }

            return $productos;
        } catch (PDOException $error) {
            return [];
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

    // Obtener productos aleatorios por id
    public function getProductosAleatorios($id){
        try {
            $query = "SELECT * FROM productos WHERE id = :id LIMIT 1";
            
            $stmt = $this->db->getPdo()->prepare($query);
            
            // Vinculamos el parámetro :id a la variable $id
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Ejecutamos la consulta
            $stmt->execute();
            
            // Recuperamos el resultado
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificamos si se encontró el producto
            if ($producto) {
                return $producto;
            } else {
                error_log("No se encontró el producto");
                return null;
            }
        } catch (PDOException $e) {
            // Manejo de errores
            die("Error al obtener el producto: " . $e->getMessage());
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

    public function editar(){
        try{
            $stmt = $this->db->getPdo()->prepare("UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, categoria_id = :categoria_id, imagen = :imagen WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':categoria_id', $this->categoria_id);
            $stmt->bindParam(':imagen', $this->imagen);

            return $stmt->execute();
        }catch(PDOException $e){
            die("Error en la base de datos: " . $e->getMessage());
        }
    }

    public function eliminar($id){
        try {
            $stmt = $this->db->getPdo()->prepare("DELETE FROM productos WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); 
        } catch (PDOException $e) {
            error_log("Error al obtener productos por categoría: " . $e->getMessage());
            return false; 
        }
    }
}