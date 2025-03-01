<?php

namespace Controllers;

use Models\Producto;

class ProductoController {

    // Método para listar productos por categoría
    public function getProductosPorCategoria($categoria_id) {
        $producto = new Producto();
        return $producto->getPorCategoria($categoria_id);
    }

    // Método para obtener un producto específico por ID
    public function ver() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $productoData = $producto->getPorId($id);

            if ($productoData) {
                require_once __DIR__ . '/../views/producto/ver.php';
            } else {
                echo "<p>Producto no encontrado</p>";
            }
        } else {
            echo "<p>ID de producto no especificado</p>";
        }
    }

    // Método para listar todos los productos
    public function listar() {
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once __DIR__ . '/../views/producto/listar.php';
    }
}
