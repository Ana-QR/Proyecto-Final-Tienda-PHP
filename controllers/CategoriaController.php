<?php
namespace Controllers;

use Models\Categoria;
use Helpers\Utils;
use Models\Producto;

class CategoriaController{
    public function default(){
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorias

        $categoria = new Categoria(); 
        return $categoria->getCategorias();

        require_once __DIR__ . '/../views/categoria/index.php';
    }

    public function crearCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden crear categorias

        require_once __DIR__ . '/../views/categoria/crear.php';
    }

    public function guardarCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden guardar categorias

        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            $categoria->guardar();
            if(!isset($_SESSION['errorCategoria'])){
                header('Location: '. URL_BASE . 'categoria/default');
            } else {
                header('Location: '. URL_BASE . 'categoria/crear');
            }

        }else{
            $_SESSION['categoria'] = "incorrecto";
        }

        header("Location:".URL_BASE."categoria/index");
    }

    public function verCategoria(){
        if(isset($_GET['id'])){
            $id = (int) $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria = $categoria->getCategoria();

            $producto = new Producto();
            $producto->setCategoriaId($id);
            $productos = $producto->getProductosCategoria($id);
        }
        require_once __DIR__ . '/../views/categoria/ver.php';
    }
}
?>