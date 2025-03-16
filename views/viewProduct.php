<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="assets/img/<?php echo $data['imagen']; ?>" class="img-fluid" alt="<?php echo $data['nombre']; ?>">
        </div>
        <div class="col-md-6">
            <h1><?php echo $data['nombre']; ?></h1>
            <p class="lead"><?php echo $data['descripcion']; ?></p>
            <h3 class="my-3">Precio: <?php echo number_format($data['precio'], 2); ?> €</h3>
            <p>Stock disponible: <?php echo $data['stock']; ?> unidades</p>
            
            <div class="d-grid gap-2">
                <a href="index.php?controller=CartController&action=addToCart&id=<?php echo $data['id_producto']; ?>" class="btn btn-success btn-lg">
                    <i class="bi bi-cart-plus"></i> Añadir al carrito
                </a>
                <a href="index.php" class="btn btn-secondary">Volver a la tienda</a>
            </div>
        </div>
    </div>
</div>