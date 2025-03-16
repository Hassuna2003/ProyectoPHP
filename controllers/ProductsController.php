<?php
/**
 *  Controlador de Productos. Implementará todas las acciones que se puedan llevar a cabo desde las vistas
 * que afecten a productos de la tienda.
 */
include_once ("views/View.php");
class ProductController {

    /**
     * Método que obtiene todos los productos de la BBDD y los muestra a través de la vista showProducts.
     */
    public function getAllProducts (){
        require_once ("models/productos.php");
        $pDAO=new ProductoDAO();
        $products=$pDAO->getAllProducts();
        $pDAO=null;
        View::show("showProducts", $products);
    }
    
    /**
     * Método que obtiene un producto específico por su ID y lo muestra
     */
    public function viewProduct() {
        if (isset($_REQUEST['id'])) {
            require_once ("models/productos.php");
            $pDAO = new ProductoDAO();
            $product = $pDAO->getProductById($_REQUEST['id']);
            
            if ($product) {
                View::show("viewProduct", $product);
            } else {
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    }

    /**
     * Método que añade un producto a la BBDD recogiendo los datos que llegan a través de $_POST. Previo
     * a la inserción realiza la validación de los datos.
     */
    public function aniadirProduct (){
        // Verificar si el usuario es admin
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit;
        }
        
        $errores=array();
        
        /* Si se ha pulsado en el botón insertar se validan los datos y en caso de error, éstos se almacenan
        en el array $errores*/
        if (isset($_POST['insertar'])) {
            // Validación de los campos obligatorios
            if (!isset($_POST['nombre']) || strlen($_POST['nombre']) == 0) 
                $errores['nombre'] = "El nombre no puede estar vacío.";
            if (!isset($_POST['descripcion']) || strlen($_POST['descripcion']) < 10) 
                $errores['descripcion'] = "La descripción debe tener al menos 10 caracteres";
            if (!isset($_POST['precio']) || strlen($_POST['precio']) == 0) 
                $errores['precio'] = "El precio no puede estar vacío.";
        
            /**
             * Si no hay errores, intentamos insertar el producto.
             * Se instancia un ProductoDAO, se inserta el producto y si es exitoso, muestra los productos.
             */
            if (empty($errores)) {
                include("models/productos.php");
                $pDAO = new ProductoDAO();
        
                if ($pDAO->insertProduct($_POST['nombre'], $_POST['descripcion'], $_POST['precio'])) {
                    $this->getAllProducts();
                } else {
                    $errores['general'] = "Problemas al insertar";
                    View::show("addProduct", $errores);
                }
            } else {
                View::show("addProduct", $errores);
            }
        }
        
        // Si no se pulsó el botón insertar, se muestra la vista con el formulario.
        else {
            View::show("addProduct", null);
        }
    }

}
?>