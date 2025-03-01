<?php
namespace Controllers;

require_once 'models/Categoria.php';
require_once 'helpers/Utils.php';

use Models\Categoria;
use Utils;

class CategoriaController{
    public function listarCategorias(){
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorias

        $categoria = new Categoria(); 
        return $categoria->getAll();
    }

    public function crear(){
        Utils::esAdmin(); // Solo los administradores pueden crear categorias

        require_once __DIR__ . '../views/categoria/crear.php';
    }

    public function guardar(){
        Utils::esAdmin(); // Solo los administradores pueden guardar categorias

        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

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
}
?>