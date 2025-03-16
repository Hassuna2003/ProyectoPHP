# Documentación Tienda Web Headfonsitos

## Introducción

Mi proyecto "Headfonsitos" es una tienda online donde se venden auriculares de diferentes tipos. Lo he hecho usando PHP con el modelo MVC (Modelo-Vista-Controlador), como se nos ha indicado, para organizar mejor el código. He usado MySQL para la base de datos y Bootstrap para que la página se vea bonita y funcione en móviles también.

En la tienda, los usuarios pueden ver todos los auriculares, mirar los detalles de cada uno, añadirlos al carrito y comprarlos. También hay un sistema de login para distinguir entre usuarios normales y administradores (que pueden añadir o quitar productos).

## Objetivos del Proyecto

Con este proyecto quería conseguir:

1. **Usar el modelo MVC:** Separar las partes del código.

2. **Gestionar productos:** Poder ver y añadir productos de la tienda.

3. **Sistema de carrito:** Que los usuarios puedan añadir productos al carrito y comprarlos.

4. **Login de usuarios:** Hacer un sistema para que la gente pueda iniciar sesión como usuario o como admin.

5. **Que se vea bien:** Usar Bootstrap para que la página quede bien en ordenador y móvil.

6. **Operaciones con la base de datos:** Poder añadir, leer, actualizar y borrar cosas de la base de datos.

## Cómo funciona

He organizado el proyecto siguiendo el modelo MVC:

### Archivos

```
tienda_headphones/
│
├── controllers/
│   ├── CartController.php  (controla el carrito)
│   ├── ProductsController.php  (controla los productos)
│   └── UsersController.php  (controla los usuarios)
│
├── models/
│   ├── productos.php  (para los datos de productos)
│   └── usuarios.php  (para los datos de usuarios)
│
├── views/
│   ├── header.php  (la parte de arriba de la página)
│   ├── footer.php  (la parte de abajo)
│   ├── showProducts.php  (muestra todos los productos)
│   └── ... (otras vistas)
│
└── index.php  (archivo principal)
```

### Cómo usar la aplicación

1. **Página principal:** Todo empieza en `index.php`

2. **Navegación:** Los usuarios pueden:
   - Ver todos los auriculares en la página principal
   - Ver más info de cada auricular
   - Añadir cosas al carrito
   - Ver su carrito
   - Comprar
   - Iniciar o cerrar sesión

3. **Panel de admin:** Si eres administrador puedes:
   - Añadir nuevos auriculares

### Base de datos

He creado estas tablas en MySQL:
- `Productos`: Donde guardo los auriculares
- `Usuarios`: Donde guardo los datos de la gente que se registra
- `Cesta`: Para los carritos de compra
- `Cesta_Producto`: Para saber qué productos hay en cada carrito

## Contraseñas

Para probar la aplicación se pueden usar:

### Para entrar como Admin
- **Usuario:** admin
- **Contraseña:** 1234

### Para entrar como Usuario normal
- **Usuario:** usuario
- **Contraseña:** 1234

## Cosas que podría mejorar en el futuro

Si tuviera más tiempo, me gustaría añadir:

1. **Buscador de productos:** Un campo para buscar auriculares por nombre o descripción, así sería más fácil encontrar lo que quieres.

2. **Historial de pedidos:** Guardar las compras que hace cada usuario para que puedan ver lo que han comprado antes.

3. **Categorías:** Dividir los auriculares por tipos (gaming, deportivos, etc).

4. **Valoraciones:** Que la gente pueda poner estrellas y comentarios a los auriculares.

5. **Cambiar cantidades:** Poder cambiar el número de auriculares directamente desde el carrito.

## Conclusión

Con este proyecto he aprendido mucho sobre PHP, bases de datos y cómo hacer una web desde cero. He podido aplicar lo que hemos visto en clase sobre MVC y he entendido mejor cómo funcionan las tiendas online.

Aunque seguro que hay cosas que se pueden mejorar, estoy contento/a con el resultado porque la tienda funciona: se pueden ver productos, añadir al carrito y hacer pedidos, que era lo principal.

Las mejoras que he puesto arriba serían interesantes para hacer en el futuro y así completar más la tienda.
