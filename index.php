<?php
include_once ("views/header.php");
include ("controllers/ProductsController.php");
include ("controllers/CartController.php");
include ("controllers/UsersController.php");

// Punto de entrada a la aplicación
if (isset($_REQUEST['action']) && isset($_REQUEST['controller']) ){
    $act = $_REQUEST['action'];
    $cont = $_REQUEST['controller'];
    
    $controller = new $cont();
    $controller->$act();
} else {
    // Página principal - Mostrar todos los productos
    echo '<div class="container mt-3">
    <h1 class="text-center mb-4">Tienda de Headfonsitos</h1>
    <p class="text-center lead">Los mejores auriculares del mercado a tu alcance</p>';
    
    // Banner
    echo '<div class="p-5 mb-4 bg-dark text-white rounded">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Calidad de sonido premium</h1>
          <p class="col-md-8 fs-4">Descubre nuestra selección de auriculares premium para una experiencia de sonido inigualable.</p>
          <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-primary btn-lg">Ver todos los productos</a>
        </div>
      </div>';
    
    // Cargar todos los productos
    include ("models/productos.php");
    $pDAO = new ProductoDAO();
    $products = $pDAO->getAllProducts();
    
    echo '<h2 class="text-center mb-4">Todos los productos</h2>';
    echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
    
    // Recorrer y mostrar todos los productos
    foreach ($products as $product) {
        echo '<div class="col">
            <div class="card h-100">
                <img src="assets/img/' . $product['imagen'] . '" class="card-img-top" alt="' . $product['nombre'] . '" style="height: 200px; object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title">' . $product['nombre'] . '</h5>
                    <p class="card-text">' . substr($product['descripcion'], 0, 100) . '...</p>
                    <p class="card-text"><strong>Precio: €' . $product['precio'] . '</strong></p>
                    <a href="index.php?controller=ProductController&action=viewProduct&id=' . $product['id_producto'] . '" class="btn btn-primary">Ver detalles</a>
                    <a href="index.php?controller=CartController&action=addToCart&id=' . $product['id_producto'] . '" class="btn btn-success">Añadir al carrito</a>
                </div>
            </div>
        </div>';
    }
    
    echo '</div>'; // Cerrar fila
    echo '</div>'; // Cerrar contenedor
}

require_once ("views/footer.php");
?>