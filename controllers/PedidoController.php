<?php
namespace Controllers;

require_once __DIR__ . '/../models/Producto.php';

use \Models\Producto;

class PedidoController {
    public function gestion(){
        $productoModel = new Producto();
        $productos = $productoModel->getProductos();

        // Si no hay productos, $productos es un array vacío
        if ($productos === null) {
            $productos = []; 
        }

        return $productos;

        require_once __DIR__ . '/../views/producto/gestion.php';
    }
}
?>