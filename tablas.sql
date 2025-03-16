-- Create database (if not exists already)
CREATE DATABASE IF NOT EXISTS tienda_headphones;
USE tienda_headphones;

-- Tabla productos
CREATE TABLE IF NOT EXISTS Productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255) DEFAULT 'hp1.jpg',
    stock INT DEFAULT 10
);

-- Tabla usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de cesta de compra
CREATE TABLE IF NOT EXISTS Cesta (
    id_cesta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activa', 'finalizada') DEFAULT 'activa',
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- Detalles de la tabla del carro de compra
CREATE TABLE IF NOT EXISTS Cesta_Producto (
    id_cesta_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_cesta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_cesta) REFERENCES Cesta(id_cesta),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

-- Insertar productos (headphones)

INSERT INTO Productos (nombre, descripcion, precio, imagen) VALUES 
('HeadPhone Pro X', 'Auriculares profesionales con cancelación de ruido activa. Disfruta de un sonido nítido y potente en cualquier entorno. Ideales para producción musical y gaming.', 249.99, 'hp1.jpg'),
('HeadPhone Wireless', 'Auriculares inalámbricos con Bluetooth 5.0. Hasta 30 horas de batería y carga rápida. Control táctil y compatible con asistentes de voz.', 129.99, 'hp2.jpg'),
('HeadPhone Urban', 'Diseño urbano con acabados premium. Sonido equilibrado con graves potentes. Plegables y ligeros, perfectos para llevar a cualquier parte.', 89.99, 'hp3.jpg'),
('HeadPhone Studio', 'Auriculares de estudio con sonido de alta fidelidad. Respuesta plana ideal para mezclas y masterización. Incluye cable desmontable y adaptador de 6.35mm.', 199.99, 'hp4.jpg'),
('HeadPhone Sport', 'Auriculares deportivos resistentes al agua y sudor. Diseño ergonómico que no se caerá durante el ejercicio. Incluye diferentes tamaños de almohadillas.', 79.99, 'hp5.jpg'),
('HeadPhone Kids', 'Especialmente diseñados para niños con limitador de volumen para proteger sus oídos. Materiales seguros y resistentes. Disponible en varios colores.', 49.99, 'hp6.jpg');

-- Insertar los usuarios (el normal y el administrador)
INSERT INTO Usuarios (nombre, password, rol) VALUES
('admin', '1234', 'admin'),
('usuario', '1234', 'usuario');