<?php
    Namespace Models;

    use Lib\Conexion;
    use PDO;


    class Producto{
        private $db;
        public function __construct(){
            $this->db = new Conexion();
        }

        // Obtener todos los productos
        public function getAll(){
            $sql = "SELECT * FROM productos ORDER BY id DESC";
            $productos = $this->db->getPDO()->query($sql);
            return $productos;
        }

        // Obtener un producto por ID
        public function getPorId($id){
            $sql = "SELECT * FROM productos WHERE id = $id";
            $producto = $this->db->getPDO()->query($sql);
            return $producto->fetch(PDO::FETCH_ASSOC);
        }

        // Obtener productos por categoría
        public function getPorCategoria($categoria_id){
            $sql = "SELECT * FROM productos WHERE categoria_id = $categoria_id";
            $productos = $this->db->getPDO()->query($sql);
            return $productos;
        }
    }
?>