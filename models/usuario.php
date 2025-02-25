<?php
namespace Models;

    use Lib\Conexion;
    
    use PDO;
    use PDOException;

    class Usuario{
        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $password;
        private $rol;
    
        private $db;
    
        public function __construct() {
            $this->db = (new Conexion())->getPdo(); // Asegurar que db es un objeto PDO
        }   
        

        // Getters y Setters
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getApellidos(){
            return $this->apellidos;
        }

        public function setApellidos($apellidos){
            $this->apellidos = $apellidos;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
        }

        public function getRol(){
            return $this->rol;
        }

        public function setRol($rol){
            $this->rol = $rol;
        }

        // Métodos
        // Método para registrar un usuario
        public function guardarUsuario(){
            try {
                $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES (:nombre, :apellidos, :email, :password, :rol)");
                $stmt->bindValue(':nombre', $this->nombre);
                $stmt->bindValue(':apellidos', $this->apellidos);
                $stmt->bindValue(':email', $this->email);
                $stmt->bindValue(':password', $this->password);
                $stmt->bindValue(':rol', $this->rol);
                return $stmt->execute();
            } catch (PDOException $e) {
                // Registrar el mensaje de error para propósitos de depuración
                error_log("Error al guardar el usuario: " . $e->getMessage());
                // Puedes agregar manejo de errores adicional aquí, como notificar al usuario o reintentar la operación
                return false;
            }
        }

        // Método para iniciar sesión
        public function login(){
            $email = $this->email;
            $password = $this->password;

            try {
                $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
                $stmt->bindValue(':email', $email);
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
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                error_log("Error al iniciar sesión: " . $e->getMessage());
                return false;
            }
        }
    }
?>