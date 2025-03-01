<?php

namespace Controllers;

require_once 'models/Usuario.php';
require_once 'helpers/Utils.php';

use Models\Usuario;
use PDOException;
use Utils;

class UsuarioController{
    private $pdo;

    public function index(){
        Utils::esAdmin();
        $usuario = new Usuario();
        $usuarios = $usuario->getAll();
        require_once __DIR__ . '../views/usuario/gestion.php';
    }

    public function __construct()
    {
        $this->pdo = new Usuario();
    }

    /**
     * Muestra el formulario de registro de usuario.
     */
    public function registro()
    {
        session_start();
        
        require_once __DIR__ .'../views/usuario/registro.php';
    }

    public function login()
    {
        session_start();
            if(isset($_SESSION['usuario'])){
                //si ya esta logueado lo manda al inicio
                header("Location:".URL_BASE."index");
                exit();
            }
        require_once __DIR__ .'../views/usuario/login.php';
    }

    public function gestion(){
        Utils::esAdmin();

        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once __DIR__ .'../views/usuario/gestion.php';
    }

    /**
     * Registra un nuevo usuario.
     */
    public function registrarUsuario()
    {
        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;
            $rol = 'usuario';

            // Validar datos
            if ($nombre && $apellidos && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($rol);
                $guardar = $usuario->guardarUsuario();

                try {
                    if ($guardar) {
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
        header('Location: ' . URL_BASE . 'usuario/login');
    }

    public function editar(){
        Utils::esAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuar = $usuario->getUsuarioPorId($id);
            require_once './views/usuario/editar.php';
        } else {
            header("Location:". URL_BASE . "usuario/gestion");
        }
    }

    // public function actualizar(){
    //     Utils::esAdmin();
    //     if(isset($_POST['id'])){
    //         $id = $_POST['id'];
    //         $nombre = $_POST['nombre'];
    //         $apellidos = $_POST['apellidos'];
    //         $email = $_POST['email'];
    //         $rol = $_POST['rol'];

    //         $usuario = new Usuario();
    //         $usuario->setId($id);
    //         $usuario->setNombre($nombre);
    //         $usuario->setApellidos($apellidos);
    //         $usuario->setEmail($email);
    //         $usuario->setRol($rol);
    //         $actualizar = $usuario->actualizar();
    //         $_SESSION['editar'] = $actualizar ? "correcto" : "incorrecto";
    //     } else {
    //         $_SESSION['editar'] = "incorrecto";
    //         header("Location:". URL_BASE . "usuario/gestion");
    //     }

    // }


    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function loginUsuario(){
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $inicio = $usuario->login();

            if ($inicio && is_object($inicio)) {
                echo "Inicio de sesión correcto";

                $_SESSION['inicio'] = [$inicio];

                if ($inicio->getRol() === 'admin') {
                    $_SESSION['admin'] = true;
                }
            }

            //Verificar si el checkbox "Recuerdame" está marcado
            if (isset($_POST['remember']) && $_POST['remember'] == 'on'){
                //Crear una cookie para recordar al usuario, con duracion de 7 dias
                setcookie('remember', $inicio->getId(), time() + (7 * 24 * 60 * 60), '/'); //Caduca en 7 dias
            }

            //Redirigir a la pagina principal
            header('Location: ' . URL_BASE);
        }
    }

    public function logout(){
        if(isset($_SESSION['usuario'])){
            unset($_SESSION['usuario']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".URL_BASE);
    }
}
