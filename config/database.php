<?php
    namespace Config;

    use PDO;
    use PDOException;

    class Database{
        private static $host = 'localhost';
        private static $dbname = 'proyecto_final_tienda';
        private static $user = "root";
        private static $pass = "";
        private static $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => PDO::FETCH_ASSOC
        ];

        public static function connect(){
            try {
                $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$pass, self::$options);
                return $conn;
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        }
    }
?>