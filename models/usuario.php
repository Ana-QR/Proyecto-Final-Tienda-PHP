<?php

namespace Models;

use Lib\Conexion;
use PDO;
use PDOException;
use Helpers\Utils;

class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;

    private $db;

    private $imagen;

    public function __construct()
    {
        $this->db = new Conexion();
    }

    // Getters y Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    // Métodos
    // Método para registrar un usuario
    public function guardarUsuario()
    {
        $conexion = new Conexion();
        $pdo = $conexion->getPdo();

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, 'user')");
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            $conexion->close();
        }
    }

    public function guardarAdmin()
    {
        try {
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
            $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)";
            $guardar = $this->db->getPdo()->prepare($sql);
            $guardar->bindValue(':nombre', $this->nombre);
            $guardar->bindValue(':apellidos', $this->apellidos);
            $guardar->bindValue(':email', $this->email);
            $guardar->bindValue(':password', $hashedPassword);
            $guardar->bindValue(':rol', 'admin');
            return $guardar->execute();
        } catch (PDOException $e) {
            error_log("Error al guardar el admin: " . $e->getMessage());
            return false;
        }
    }

    public function crear()
    {
        Utils::esAdmin();
        require_once  'views/usuario/crear.php';
    }

    public function getUsuario(){
        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function listarUsuarios(){
        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener los usuarios: " . $e->getMessage());
            return false;
        }
    }

    // Método para login de usuarios
    public function login()
    {
        $result = false;
        $email = $this->email;
        $password = $this->password;

        try {
            // Miramos si el usuario existe en la BBDD
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);

            if ($usuario) {
                // Verificar si la contraseña es correcta
                $verify = password_verify($password, $usuario->password);

                if ($verify) {
                    $result = $usuario;
                }
            }
        } catch (PDOException $e) {
            error_log("Error al iniciar sesión: " . $e->getMessage());
        }

        return $result;
    }
}
