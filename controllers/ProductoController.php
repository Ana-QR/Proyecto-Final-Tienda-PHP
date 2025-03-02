<?php

namespace Controllers;

use Models\Producto;
use Helpers\Utils;

class ProductoController {

    public function index(){
        $producto = new Producto();
        $productos = $producto->getProductosAleatorios(6);
        require_once __DIR__ . '/../views/producto/destacados.php';
    }

    public function gestion(){
        Utils::esAdmin();

        $producto = new Producto();
        $productos = $producto->getProductos();

        require_once __DIR__ . '/../views/producto/gestion.php';
    }

    public function crear(){
        Utils::esAdmin();

        require_once __DIR__ . '/../views/producto/crear.php';
    }

    public function guardar(){
        Utils::esAdmin();

        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if($nombre && $descripcion && $precio && $stock && $categoria){

                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);

                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                        if(!is_dir('assets/img')){
                            mkdir('assets/img', 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], 'assets/img/'.$filename);
                        $producto->setImagen($filename);
                    }
                }

                $producto->guardar();

                if(!isset($_SESSION['errorProducto'])){
                    header('Location: '. URL_BASE . 'producto/gestion');
                } else {
                    header('Location: '. URL_BASE . 'producto/crear');
                }
            } else {
                $_SESSION['errorProducto'] = "true";
                header('Location: '. URL_BASE . 'producto/crear');
            }

        }
    }
}
?>