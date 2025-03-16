<?php
include_once ("views/View.php");

class CartController {
    public function addToCart() {
        session_start();
        
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=UserController&action=loginForm&redirect=cart");
            exit;
        }
        
        // Obtener el ID del producto
        $id_producto = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        
        // Verificar si el producto existe
        require_once ("models/productos.php");
        $pDAO = new ProductoDAO();
        $producto = $pDAO->getProductById($id_producto);
        
        if (!$producto) {
            header("Location: index.php");
            exit;
        }
        
        // Inicializar el carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
        
        // Verificar si el producto ya está en el carrito
        $encontrado = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id_producto'] == $id_producto) {
                $item['cantidad']++;
                $encontrado = true;
                break;
            }
        }
        
        // Si no está en el carrito, agregarlo
        if (!$encontrado) {
            $_SESSION['carrito'][] = array(
                'id_producto' => $id_producto,
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1,
                'imagen' => $producto['imagen']
            );
        }
        
        header("Location: index.php?controller=CartController&action=viewCart");
    }
    
    public function viewCart() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario ha iniciado sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=UserController&action=loginForm&redirect=cart");
            exit;
        }
        
        // Si el carrito no existe, inicializarlo
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
        
        View::show("cartView", $_SESSION['carrito']);
    }
    
    public function finalizarCompra() {
        
        
        // Vaciar el carrito
        $_SESSION['carrito'] = array();
        
        // Mostrar mensaje
        echo '<div class="container mt-4">
            <div class="alert alert-success">
                <h3 class="text-center">Pedido realizado</h3>
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary">Volver a la tienda</a>
            </div>
        </div>';
    }
    public function removeFromCart() {
        session_start();
        
        $id_producto = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        
        if (isset($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $key => $item) {
                if ($item['id_producto'] == $id_producto) {
                    unset($_SESSION['carrito'][$key]);
                    break;
                }
            }
            
            // Reindexar el array
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
        
        header("Location: index.php?controller=CartController&action=viewCart");
    }
}
?>