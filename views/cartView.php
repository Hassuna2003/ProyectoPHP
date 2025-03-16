<div class="container mt-4">
    <h1 class="text-center mb-4">Carrito de Compra</h1>
    
    <?php if (empty($data)): ?>
        <div class="alert alert-info">
            Tu carrito está vacío.
        </div>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-primary">Seguir comprando</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($data as $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td><img src="assets/img/<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>" width="50"></td>
                            <td><?php echo number_format($item['precio'], 2); ?> €</td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td><?php echo number_format($subtotal, 2); ?> €</td>
                            <td>
                                <a href="index.php?controller=CartController&action=removeFromCart&id=<?php echo $item['id_producto']; ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2"><strong><?php echo number_format($total, 2); ?> €</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-3">
            <a href="index.php" class="btn btn-primary">Seguir comprando</a>
            <a href="index.php?controller=CartController&action=finalizarCompra" class="btn btn-success">Finalizar compra</a>
        </div>
    <?php endif; ?>
</div>