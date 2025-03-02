<?php
    Namespace Models;

    use Lib\Conexion;
    use PDO;


    class Producto{
        private $db;

        private $id;
        private $categoria_id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;

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

        public function getCategoriaId(){
            return $this->categoria_id;
        }

        public function setCategoriaId($categoria_id){
            $this->categoria_id = $categoria_id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $this->db->getPDO()->quote($nombre);
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $this->db->getPDO()->quote($descripcion);
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function setPrecio($precio){
            $this->precio = $precio;
        }

        // Obtener todos los productos
        public function getAll(){
            $sql = "SELECT * FROM productos ORDER BY id DESC";
            $productos = $this->db->getPDO()->query($sql);
            return $productos->fetchAll(PDO::FETCH_ASSOC);
        }

        // Obtener un producto por ID
        public function getPorId($id){
            $sql = "SELECT * FROM productos WHERE id = :id";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Obtener productos por categoria
        public function getPorIdCategoria($categoria_id){
            $sql = "SELECT * FROM productos WHERE categoria_id = :categoria_id";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>