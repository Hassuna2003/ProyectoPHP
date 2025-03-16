<div class="container mt-4">
    <h1 class="text-center mb-4">Listado de Productos</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($data as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="assets/img/<?php echo $product['imagen']; ?>" class="card-img-top" alt="<?php echo $product['nombre']; ?>" style="max-height: 200px; object-fit: contain;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['nombre']; ?></h5>
                        <p class="card-text"><?php echo substr($product['descripcion'], 0, 100); ?>...</p>
                        <p class="card-text"><strong>Precio: <?php echo number_format($product['precio'], 2); ?> €</strong></p>
                        <div class="d-grid gap-2">
                            <a href="index.php?controller=ProductController&action=viewProduct&id=<?php echo $product['id_producto']; ?>" class="btn btn-primary">Ver detalles</a>
                            <a href="index.php?controller=CartController&action=addToCart&id=<?php echo $product['id_producto']; ?>" class="btn btn-success">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>