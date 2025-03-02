<?php
namespace Controllers;

use Models\Categoria;
use Utils;
use Models\Producto;

class CategoriaController{
    public function porDefecto(){
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorias

        $categoria = new Categoria(); 
        return $categoria->getAllCategorias();
    }

    public function crearCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden crear categorias

        require_once __DIR__ . '../views/categoria/crear.php';
    }

    public function guardarCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden guardar categorias

        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            $categoria->guardar();
            if($categoria->guardar()){
                $_SESSION['categoria'] = "correcto";
            }else{
                $_SESSION['categoria'] = "incorrecto";
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
            $categoriaData = $categoria->getAllCategorias();

            $producto = new Producto();
            $producto->setId($id);
            $productos = $producto->getCategoriaId($id);

            if($categoriaData){
                require_once __DIR__ . '../views/categoria/ver.php';
            }else{
                header("Location:".URL_BASE."categoria/index");
                exit();
            }
        }
        require_once __DIR__ . '../views/categoria/ver.php';
    }
}
?>