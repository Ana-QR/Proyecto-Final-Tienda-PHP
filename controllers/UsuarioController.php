<?php

namespace Controllers;

require_once 'models/Usuario.php';

use Models\Usuario;
use Helpers\Utils;

class UsuarioController
{
    public function index()
    {
        Utils::esAdmin(); // Solo los administradores pueden acceder a la gestión de usuarios
        $usuario = new Usuario();
        $usuarios = $usuario->getAll();
        require_once __DIR__ . '/../views/usuario/gestion.php';
    }

    public function registro()
    {
        require_once __DIR__ . '/../views/usuario/registro.php';
    }

    public function login()
    {
        require_once __DIR__ . '/../views/usuario/login.php';
    }

    public function gestion()
    {
        Utils::esAdmin();
        $usuario = new Usuario();
        $usuarios = $usuario->getAll();
        require_once __DIR__ . '/../views/usuario/gestion.php';
    }

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Comprobamos si la sesión está iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Recogemos los datos del formulario
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellidos']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $errors = [];

            // Validamos los datos
            if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre) || strlen($nombre) < 2) {
                $errors['nombre'] = "El nombre debe contener solo letras y al menos 2 caracteres.";
            }

            // Validamos los apellidos
            if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellidos) || strlen($apellidos) < 2) {
                $errors['apellidos'] = "Los apellidos deben contener solo letras y al menos 2 caracteres.";
            }

            // Validamos el email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Introduce un email válido.";
            }

            // Validamos la contraseña
            if (strlen($password) < 6 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
                $errors['password'] = "La contraseña debe tener al menos 6 caracteres, una mayúscula y un número.";
            }

            // Si hay errores, los guardamos en la sesión y redirigimos al formulario
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . URL_BASE . "usuario/registro");
                exit();
            }

            // Guardamos el usuario
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT));

            $guardar = $usuario->guardarUsuario();

            if ($guardar) {
                $_SESSION['registro'] = "correcto";
                $_SESSION['success_message'] = "Registro completado con éxito. ¡Bienvenido!";
            } else {
                $_SESSION['registro'] = "incorrecto";
                $_SESSION['error_message'] = "Hubo un problema al registrarse. Inténtalo de nuevo.";
            }
        } else {
            $_SESSION['register'] = "incorrecto";
        }

        header("Location: " . URL_BASE . "usuario/registro");
        exit();
    }

    public function guardarAdmin()
    {
        Utils::esAdmin();

        // Comprobamos si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

            if ($nombre && $apellidos && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($rol);

                $guardar = $usuario->guardarAdmin();

                if ($guardar) {
                    $_SESSION['registro'] = "correcto";
                } else {
                    $_SESSION['registro'] = "incorrecto";
                }
            } else {
                $_SESSION['registro'] = "incorrecto";
            }
        } else {
            $_SESSION['registro'] = "incorrecto";
        }

        header("Location:" . URL_BASE . "usuario/gestion");
    }

    public function crear()
    {
        Utils::esAdmin();
        require_once __DIR__ . '/../views/usuario/crear.php';
    }

    public function editar()
    {
        // Comprobamos si la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Comprobamos si existe la sesión de usuario
        if (isset($_SESSION['identity'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['identity']->id;
            //Si no se pasa ID por GET, se coge el de la sesión
            $usuario = new Usuario();
            $usuario->setId($id);
            $usu = $usuario->getPorId($id);

            // Comprobamos si el usuario es el mismo que el de la sesión o si es admin
            if ($_SESSION['identity']->id == $usu->id || isset($_SESSION['admin'])) {
                $usuario = $usu; // Pasamos el usuario a la vista
                require_once __DIR__ . '/../views/usuario/editar.php';
            } else {
                header("Location:" . URL_BASE);
            }
        } else {
            header("Location:" . URL_BASE);
        }
    }

    public function actualizar()
    {
    
        if (isset($_SESSION['identity']) && isset($_POST['id'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);

            if (isset($_SESSION['admin'])) {
                $usuario->setRol($rol);
            }

            $update = $usuario->actualizar();

            if ($update && $_SESSION['identity']->id == $id) {
                $_SESSION['identity']->nombre = $nombre;
                $_SESSION['identity']->apellidos = $apellidos;
                $_SESSION['identity']->email = $email;
                $_SESSION['edit'] = "correcto";
            } else {
                $_SESSION['edit'] = "incorrecto";
            }
        }
        header("Location:" . URL_BASE . "usuario/gestion");
    }

    public function eliminar()
    {
        Utils::esAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);
            $delete = $usuario->borrar();

            if ($delete) {
                $_SESSION['delete'] = 'correcto';
            } else {
                $_SESSION['delete'] = 'incorrecto';
            }
        } else {
            $_SESSION['delete'] = 'incorrecto';
        }

        header("Location:" . URL_BASE . "usuario/gestion");
    }

    public function actualizarAdmin()
    {
        Utils::esAdmin();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $nombre = trim($_POST['nombre']);
            $apellidos = trim($_POST['apellidos']);
            $email = trim($_POST['email']);
            $password = isset($_POST['password']) && !empty($_POST['password']) 
                ? password_hash($_POST['password'], PASSWORD_BCRYPT) 
                : null;

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);

            // Solo los administradores pueden cambiar el rol
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                $rol = $_POST['rol'];
                $usuario->setRol($rol);
            }

            // Solo se actualiza la contraseña si se ha introducido una nueva
            if ($password) {
                $usuario->setPassword($password);
            }

            $update = $usuario->actualizar();
            $_SESSION['edit'] = $update ? "complete" : "failed";
        }

        header("Location:" . URL_BASE . "usuario/gestion");
    }
}
