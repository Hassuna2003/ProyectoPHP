<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Headfonsitos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Headfonsitos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=ProductController&action=getAllProducts">Productos</a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin') {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?controller=ProductController&action=aniadirProduct">Añadir Producto</a>
                          </li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?controller=CartController&action=viewCart">
                                <i class="bi bi-cart"></i> Carrito
                            </a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> ' . $_SESSION['usuario'] . '
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="index.php?controller=UserController&action=logout">Cerrar sesión</a></li>
                            </ul>
                          </li>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="index.php?controller=UserController&action=loginForm">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                            </a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>