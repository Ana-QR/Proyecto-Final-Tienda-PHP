<?php

namespace ProyectoFinal\Controllers;

define('HASH_ALGORITHM', PASSWORD_BCRYPT);

class UsuarioController
{
    public function mostrarFormularioRegistro()
    {
        require_once 'views/usuario/registro.php';
    }

    public function registrarUsuario()
    {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

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

        // Encriptar la contraseña
        $passwordHash = password_hash($password, HASH_ALGORITHM);

        try {
            $conn = new \PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['success_message'] = "Usuario registrado exitosamente.";
                header('Location: /success_page.php');
                exit();
            } else {
                echo "Error al registrar el usuario.";
            }
        } catch (\PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
