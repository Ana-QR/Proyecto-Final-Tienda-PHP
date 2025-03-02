<?php
namespace Controllers;

use Models\Producto;
use Helpers\Utils;

class ProductoController
{
    public function index(){
        // Crear objeto del modelo Producto
        $producto = new Producto();
        $productos = $producto->getProductosAleatorios(6);



        require_once 'views/producto/destacados.php';
    }

    public function gestion(){
        // Comprobar si el usuario es administrador
        Utils::esAdmin();

        // Crear objeto del modelo Producto
        $producto = new Producto();
        $productos = $producto->getProductos();

        // Llamada a la vista de gestión de productos
        require_once 'views/producto/gestion.php';
    }

    public function crearProducto(){
        // Comprobar si el usuario es administrador
        Utils::esAdmin();

        // Llamada a la vista de creación de productos
        require_once 'views/producto/crear.php';
    }

    public function guardarProducto(){
        // Comprobar si el usuario es administrador
        Utils::esAdmin();

        // Comprobar si se ha enviado el formulario
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

                // Guardar la imagen
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
                    header('Location:'. URL_BASE .'producto/gestion');
                } else {
                    header('Location:'. URL_BASE .'producto/crear');
                }
            } else {
                $_SESSION['errorProducto'] = 'true';
                header('Location:'. URL_BASE .'producto/crear');
            }
        }
    }
}   