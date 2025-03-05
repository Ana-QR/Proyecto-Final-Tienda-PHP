<?php
require_once 'ProductoController.php';
session_start();

use Controllers\ProductoController;

$producto = new ProductoController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'guardar':
                $producto->guardarProducto();
                break;
            case 'editar':
                $producto->editarProducto();
                break;
            case 'eliminar':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $producto->eliminarProducto($id); 
                } else {
                    echo "No se ha proporcionado el ID del producto.";
                }
            default:
                echo "Acción no reconocida";
        }
    } else {
        echo "No se ha recibido una acción";
    }
} else {
    echo "Método no permitido";
}
?>