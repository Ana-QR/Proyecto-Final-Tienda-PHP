<?php
namespace Controllers;

use Models\Categoria;
use Helpers\Utils;
use Models\Producto;

class CategoriaController{

    public function index()
    {
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorías

        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

        require_once __DIR__ . '/../views/categoria/indexCat.php';
    }

    public function default(){
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorias

        $categoria = new Categoria(); 
        $categoria = $categoria->getCategorias();

        require_once 'views/categoria/indexCat.php';
    }

    public function crearCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden crear categorias

        require_once __DIR__ . '/../views/categoria/crear.php';
    }

    public function guardarCategoria(){
        Utils::esAdmin(); 

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
    }

    public function verCategoria(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria = $categoria->getCategoria();

            $producto = new Producto();
            $producto->setCategoriaId($id);
            $productos = $producto->getProductosCategoria();
        }
        require_once 'views/categoria/ver.php';
    }
}
?>