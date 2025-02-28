<?php

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
        if (!isset($_SESSION['admin'])) {
            header("Location:". URL_BASE);
        }else{
            return true;
        }
    }
}

?>