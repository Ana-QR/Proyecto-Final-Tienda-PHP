<?php

namespace Controllers;

use Models\Usuario;
use Lib\Conexion;
use PDO;
use PDOException;

class UsuarioController{
    private $pdo;

    public function __construct(){
        $this->pdo = new Conexion();
    }

    public function mostrarFormularioRegistro(){
        require_once __DIR__ . 'views/usuario/registro.php';
    }
    
    public function mostrarFormularioLogin(){
        require_once __DIR__ . 'views/usuario/login.php';
    }

    public function registrarUsuario(){
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
        }

        // Validar datos
        if (empty($nombre) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            header('Location: /error.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "El email no es válido.";
            header('Location: /error.php');
            exit;
        }

        try {
            $usuario = new Usuario();
            if ($usuario->registrarUsuario($nombre, $email, $password)) {
                $_SESSION['success'] = "Usuario registrado correctamente.";
                header('Location: views/layout/header.php');
                exit;
            } else {
                $_SESSION['error'] = "Error al registrar el usuario.";
                header('Location: /error.php');
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }

        header('Location: /error.php');
        exit;
    }

    
    public function inicioUsuario(){
        if(isset($_POST)){
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $inicio = $usuario->login();

            if($inicio){
                echo 'Inicio de sesión correcto';
                $_SESSION['inicio'] = [
                    'id' => $inicio->getId(),
                    'nombre' => $inicio->getNombre(),
                    'apellidos' => $inicio->getApellidos(),
                    'email' => $inicio->getEmail(),
                    'rol' => $inicio->getRol()
                ];

                if($inicio->getRol() == 'admin'){
                    $_SESSION['admin'] = true;
                }

                header('Location: '. URL_BASE);
                exit();
            }else{
                echo 'Inicio de sesión incorrecto';
                $_SESSION['error'] = 'Inicio de sesión incorrecto';
                header('Location: '. URL_BASE . 'usuario/mostrarFormularioLogin');
                exit();
            }
        }
    }
        
}
