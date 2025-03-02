<?php
Namespace Helpers;
use Models\Categoria;

class Utils{

     //Método para eliminar una sesión especifica, pasada por el parametro $name
     public static function borrarSesion($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }


    public static function esAdmin() {
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
            header("Location:". URL_BASE);
            exit();
        }else{
            return true;
        }
    }

    public static function mostrarCategorias(){
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        return $categorias;
    }
}

?>