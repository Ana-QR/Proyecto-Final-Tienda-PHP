<?php

namespace Controllers;

use Models\Producto;

class ProductoController {

    public function index(){
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once __DIR__ . '/../views/producto/destacados.php';
    }

    // Método para listar productos por categoría
    public function getProductosPorCategoria($categoria_id) {
        $producto = new Producto();
        return $producto->getPorIdCategoria($categoria_id);
    }

    // Método para obtener un producto específico por ID
    public function ver() {
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $id = (int) $_GET['id'];
            $producto = new Producto();
            $productoData = $producto->getPorId($id);

            if ($productoData) {
                require_once __DIR__ . '/../views/producto/ver.php';
            } else {
                header("Location: " . URL_BASE . "producto/listar");
                exit();
            }
        } else {
            header("Location:".URL_BASE."producto/listar");
            exit();
        }
    }

    // Método para listar todos los productos con paginación
    public function listar($pagina = 1, $itemsPorPagina = 10) {
        $producto = new Producto();
        $offset = ($pagina - 1) * $itemsPorPagina;
        $productos = $producto->getAll($offset, $itemsPorPagina);
        require_once __DIR__ . '/../views/producto/listar.php';
    }
}
