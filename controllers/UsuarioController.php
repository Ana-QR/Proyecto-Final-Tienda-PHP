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
        require_once __DIR__ . '/views/usuario/registro.php';
    }
    
    public function mostrarFormularioLogin(){
        require_once __DIR__ . '/views/usuario/login.php';
    }

    public function registrarUsuario(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;
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

        // Hashear la contraseña antes de guardarla
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        try {
            $usuario = new Usuario();
            if ($usuario->registrarUsuario($nombre, $email, $password_hashed)) {
                $_SESSION['success'] = "Usuario registrado correctamente.";
                header('Location: ' . URL_BASE . 'usuario/mostrarFormularioLogin');
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    
            $usuario = new Usuario();
            $usuario->setEmail($email);
    
            $inicio = $usuario->login();
    
            if ($inicio && password_verify($password, $inicio->getPassword())) {
                // Contraseña correcta
                $_SESSION['inicio'] = [
                    'id' => $inicio->getId(),
                    'nombre' => $inicio->getNombre(),
                    'apellidos' => $inicio->getApellidos(),
                    'email' => $inicio->getEmail(),
                    'rol' => $inicio->getRol()
                ];
    
                if ($inicio->getRol() == 'admin') {
                    $_SESSION['admin'] = true;
                }
    
                header('Location: ' . URL_BASE);
                exit();
            } else {
                // Contraseña incorrecta o usuario no encontrado
                $_SESSION['error'] = 'Inicio de sesión incorrecto';
                header('Location: ' . URL_BASE . 'usuario/mostrarFormularioLogin');
                exit();
            }
        }
    }
        
}
