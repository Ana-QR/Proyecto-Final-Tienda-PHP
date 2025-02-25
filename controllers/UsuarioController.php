<?php

namespace Controllers;

use Models\Usuario;
use PDOException;

class UsuarioController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Usuario();
    }

    /**
     * Muestra el formulario de registro de usuario.
     */
    public function mostrarFormularioRegistro()
    {
        require_once __DIR__ . 'views/usuario/registro.php';
    }

    public function mostrarFormularioLogin()
    {
        require_once __DIR__ . 'views/usuario/login.php';
    }

    /**
     * Registra un nuevo usuario.
     */
    public function registrarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;
            $rol = 'usuario';

            // Validar datos
            if ($nombre && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($rol);


                try {
                    if ($usuario->guardarUsuario()) {
                        $_SESSION['registro'] = 'correcto';
                    } else {
                        $_SESSION['registro'] = "incorrecto";
                    }
                } catch (PDOException $e) {
                    $_SESSION['registro'] = 'incorrecto';
                    error_log("Error a la hora de guardar el usuario: " . $e->getMessage());
                }
            } else {
                $_SESSION['registro'] = 'incorrecto';
            }
        } else {
            $_SESSION['registro'] = 'incorrecto';
        }
        header('Location: ' . URL_BASE . 'usuario/mostrarFormularioRegistro');
        exit();
    }

    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function inicioUsuario(){
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $inicio = $usuario->login();

            if ($inicio) {
                echo "Inicio de sesión correcto";

                $_SESSION['inicio'] = [
                    'id' => $inicio->getId(),
                    'nombre' => $inicio->getNombre(),
                    'apellidos' => $inicio->getApellidos(),
                    'email' => $inicio->getEmail(),
                    'rol' => $inicio->getRol()
                ];

                if ($inicio->getRol() === 'admin') {
                    $_SESSION['admin'] = true;
                }
            }

            header('Location: ' . URL_BASE);
            exit();
        } else {
            // Contraseña incorrecta o usuario no encontrado
            $_SESSION['error_login'] = 'Inicio de sesión incorrecto';
            header('Location: ' . URL_BASE . 'usuario/mostarFormularioLogin');
        }
    }
}
