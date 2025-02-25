<?php

namespace Controllers;

use Models\Usuario;
use Lib\Conexion;
use PDO;
use PDOException;

class UsuarioController
{

    /**
     * Muestra el formulario de registro de usuario.
     */
    public function mostrarFormularioRegistro()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/views/usuario/registro.php';
    }

    public function mostrarFormularioLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/views/usuario/login.php';
    }

    /**
     * Registra un nuevo usuario.
     */
    public function registrarUsuario()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;

            // Validar datos
            if (empty($nombre) || empty($email) || empty($password)) {
                $_SESSION['error'] = "Todos los campos son obligatorios.";
                header('Location: /error.php?error=' . urlencode($_SESSION['error']));
                unset($_SESSION['error']);
                exit;
            }
        } // Close the if statement properly

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "El email no es válido.";
            header('Location: /error.php');
            unset($_SESSION['error']);
            exit;
        }

        // Hashear la contraseña antes de guardarla
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        try {
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);
            $usuario->setPassword($password_hashed);

            if ($usuario->registrarUsuario()) { // Corrección: No se pasan parámetros
                $_SESSION['success'] = "Usuario registrado correctamente.";
                header('Location: ' . URL_BASE . 'usuario/mostrarFormularioLogin');
                exit;
            } else {
                $_SESSION['error'] = "Error al registrar el usuario.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }

        header('Location: /error.php');
        exit;
    }


    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function inicioUsuario()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!defined('URL_BASE')) {
            define('URL_BASE', 'http://yourdomain.com/'); // Replace with your actual base URL
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;

            $usuario = new Usuario();
            $inicio = $usuario->login();
            if ($inicio instanceof Usuario && password_verify($password, $inicio->getPassword())) {
                // Contraseña correcta
                $_SESSION['inicio'] = [
                    'id' => $inicio->getId(),
                    'nombre' => $inicio->getNombre(),
                    'apellidos' => $inicio->getApellidos(),
                    'email' => $inicio->getEmail(),
                    'rol' => $inicio->getRol()
                ];

                header('Location: ' . URL_BASE);
                unset($_SESSION['error']);
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
