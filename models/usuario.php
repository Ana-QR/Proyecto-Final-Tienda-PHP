<?php

namespace Models;

use Lib\Conexion;
use PDO;
use PDOException;
use Exception;
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
        try {
            //Comprobar que la conexion esta activada
            if (!$this->db->getPdo()) {
                throw new Exception("Error en la conexión a la base de datos", 1);
            }

            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);

            $rol = $this->rol ? $this->rol : 'usuario'; //crear usuarios que sean admin

            $stmt = $this->db->getPdo()->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)");
            $stmt->bindValue(':nombre', $this->nombre);
            $stmt->bindValue(':apellidos', $this->apellidos);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':rol', $rol);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Registrar el mensaje de error para propósitos de depuración
            error_log("Error al guardar el usuario: " . $e->getMessage());
            // Puedes agregar manejo de errores adicional aquí, como notificar al usuario o reintentar la operación
            return false;
        }
    }

    public function guardarAdmin(){
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

    public function crear(){
        Utils::esAdmin();
        require_once __DIR__ . '/../views/usuario/crear.php';
    }

    public function actualizar(){
        try {
            $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email";
            
            if (!empty($this->password)) {
                $sql .= ", password = :password";
            }
    
            // Solo actualizar el rol si el usuario es admin
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                $sql .= ", rol = :rol";
            }
    
            $sql .= " WHERE id = :id";
    
            $stmt = $this->db->getPdo()->prepare($sql);
            $stmt->bindValue(':nombre', $this->nombre);
            $stmt->bindValue(':apellidos', $this->apellidos);
            $stmt->bindValue(':email', $this->email);
            if (!empty($this->password)) {
                $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
                $stmt->bindValue(':password', $hashedPassword);
            }
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                $stmt->bindValue(':rol', $this->rol);
            }
            $stmt->bindValue(':id', $this->id);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function borrar(){
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->db->getPdo()->prepare($sql);
            $stmt->bindValue(':id', $this->id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al borrar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Metodo para obtener todos los usuarios cuando eres admin
    public function getAll()
    {
        $sql = "SELECT * FROM usuarios";
        $usuarios = $this->db->getPdo()->query($sql);
        return $usuarios;
    }

    public function getPorId($id)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->db->getPdo()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("Error al obtener usuario por ID: " . $e->getMessage());
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
