<?php
    Namespace Models;

    use Lib\Conexion;
    use PDO;
    use PDOException;


    class Producto{
        private $db;

        private $id;
        private $categoria_id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;
        private $oferta;
        private $fecha;
        private $imagen;

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

        public function getStock(){
            return $this->stock;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function getOferta(){
            return $this->oferta;
        }

        public function setOferta($oferta){
            $this->oferta = $oferta;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function getImagen(){
            return $this->imagen;
        }

        public function setImagen($imagen){
            $this->imagen = $imagen;
        }

        // Obtener todos los productos
        public function getProductos(){
            try {
                $stmt = $this->db->getPdo()->prepare("SELECT * FROM productos ORDER BY id DESC");
                $stmt->execute();
                $productos = $stmt->fetchAll();
                return $productos;
            } catch (PDOException $e) {
                error_log("Error al obtener los productos: " . $e->getMessage());
                return false;
            }
        }

        // Guardar productos
        public function guardar(){
            if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{3,}$/', $this->nombre) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ\s]{3,}$/', $this->descripcion) && preg_match('/^\d+(\.\d{1,2})?$/', $this->precio) && preg_match('/^[0-9]+$/', $this->stock)){

            try{
                $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, null, CURDATE(), :imagen)";
                $stmt = $this->db->getPDO()->prepare($sql);
                $stmt->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
                $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
                $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);
                $stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
                $stmt->bindParam(':imagen', $this->imagen, PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error al guardar el producto: " . $e->getMessage();
                return false;
            }
        } else {
            $_SESSION['errorProducto'] = 'true';
            return false;
        }
        }
    

        // Obtener productos aleatorios
        public function getProductosAleatorios($numeroProductos){
            try {
                $stmt = $this->db->getPdo()->prepare("SELECT * FROM productos ORDER BY RAND() LIMIT :numProductos");
                $stmt->bindParam(':numProductos', $numeroProductos, PDO::PARAM_INT);
                $stmt->execute();
                $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $productos;
            } catch (PDOException $e) {
                error_log("Error al obtener los productos aleatorios: " . $e->getMessage());
                return false;
            }
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
                error_log("Error al obtener los productos de la categoría: " . $e->getMessage());
                return false;
            }
        }
    }
?>