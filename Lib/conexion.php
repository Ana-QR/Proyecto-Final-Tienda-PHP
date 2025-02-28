<?php

Namespace Lib;
use PDO;
use PDOException;

class Conexion{
    private $pdo;

    public function __construct(){
        try{
            $this->pdo = new PDO('mysql:host=localhost; dbname=proyecto_final_tienda;charset=utf8mb4', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Error al conectar con la base de datos: ' . $e->getMessage();
        }
    }

    public function getPdo(){
        return $this->pdo;
    }
}

?>