<?php
    namespace Models;

    use Config\Database;
    use PDO;

    class Usuario{
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }
        
        public function registrarUsuario($nombre, $email, $password){
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            try {
                $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $passwordHash);

                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (\PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        }
    }
?>