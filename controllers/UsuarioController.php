<?php

namespace Controllers;

use Models\Usuario;
use Exception;

class UsuarioController{
    public function mostrarFormularioRegistro(){
        require_once __DIR__ . 'views/usuario/registro.php';
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
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }

        header('Location: /error.php');
        exit;
    }
}
