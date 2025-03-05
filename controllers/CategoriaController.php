<?php
namespace Controllers;

// Requiere los archivos necesarios para el funcionamiento del controlador
require_once __DIR__ . '/../models/categoria.php'; 
require_once __DIR__ . '/../vendor/autoload.php';

use Models\Categoria;
use Helpers\Utils;
use Models\Producto;

class CategoriaController{

    // Método para mostrar la página principal de categorías
    public function index()
    {
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorías

        $categoria = new Categoria();
        $categorias = $categoria->getCategorias(); // Obtiene todas las categorías

        require_once __DIR__ . '/../views/categoria/indexCat.php'; // Carga la vista de categorías
    }

    // Método por defecto para mostrar las categorías
    public function default(){
        Utils::esAdmin(); // Verifica si es administrador antes de mostrar las categorías

        $categoria = new Categoria(); 
        $categorias = $categoria->getCategorias(); // Obtiene todas las categorías

        require_once 'views/categoria/indexCat.php'; // Carga la vista de categorías
    }

    // Método para crear una nueva categoría
    public function crearCategoria(){
        Utils::esAdmin(); // Solo los administradores pueden crear categorías

        $modeloCategoria = new Categoria();
        $resultado = $modeloCategoria->guardar($_POST['nombre']); // Guarda la nueva categoría

        if($resultado){
            // Si la categoría se creó correctamente, muestra un mensaje de éxito
            $_SESSION['mensaje'] = [
                'tipo' => 'success',
                'contenido' => 'Categoria creada correctamente'
            ];

            header('Location: ../views/categoria/crear.php'); // Redirige a la página de creación
            exit();
        }else{
            // Si hubo un error al crear la categoría, muestra un mensaje de error
            $_SESSION['mensaje'] = [
                'tipo' => 'error',
                'contenido' => 'Error al crear la categoria'
            ];

            header('Location: ../views/categoria/formCategoria.php'); // Redirige al formulario de creación
            exit();
        }
    }

    // Método para guardar una categoría
    public function guardarCategoria(){
        Utils::esAdmin(); // Verifica si es administrador

        if(isset($_POST) && isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']); // Establece el nombre de la categoría

            $categoria->guardar($_POST['nombre']); // Guarda la categoría
            if(!isset($_SESSION['errorCategoria'])){
                header('Location: '. URL_BASE . 'categoria/default'); // Redirige a la página por defecto
            } else {
                header('Location: '. URL_BASE . 'categoria/crear'); // Redirige a la página de creación
            }

        }else{
            $_SESSION['categoria'] = "incorrecto"; // Establece un mensaje de error si los datos no son correctos
        }
    }

    // Método para ver una categoría específica
    public function verCategoria(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($_GET['id']); // Establece el ID de la categoría
            $categoria = $categoria->getCategoria(); // Obtiene la categoría

            $producto = new Producto();
            $producto->setCategoriaId($id); // Establece el ID de la categoría en el producto
            $productos = $producto->getProductosCategoria(); // Obtiene los productos de la categoría
        }
        require_once 'views/categoria/ver.php'; // Carga la vista de la categoría
    }
}
?>