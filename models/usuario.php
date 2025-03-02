<?php

Namespace Models;
use Lib\conexion;
use PDO;
use PDOException;

class Usuario {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;

    private $db;

    public function __construct() {
        $this->db = new Conexion();
    }

    public function guardarUsuario(){
        try {
            // Hashear la contraseña antes de insertarla en la base de datos
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);

            $stmt = $this->db->getPdo()->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)");
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellidos);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':rol', $this->rol);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al guardar el usuario: " . $e->getMessage());
            return false;
        }
    }

    public function login(){

        $email = $this->email;
        $password = $this->password;

        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $usuarioLoggeado = new Usuario();
                $usuarioLoggeado->setId($usuario['id']);
                $usuarioLoggeado->setNombre($usuario['nombre']);
                $usuarioLoggeado->setApellidos($usuario['apellidos']);
                $usuarioLoggeado->setEmail($usuario['email']);
                $usuarioLoggeado->setPassword($usuario['password']);
                $usuarioLoggeado->setRol($usuario['rol']);
                return $usuarioLoggeado; // Devuelve el usuario 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al iniciar sesión: " . $e->getMessage());
            return false;
        }
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

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    
}