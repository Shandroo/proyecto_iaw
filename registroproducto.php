<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Comida china - Todo a 3€</h1>
    <form action="addProducto.php" method="post">
        <p>Nombre: <input type="text" name="nombre" /></p>
        <p>Descripcion: <input type="text" name="descripcion" /></p>
        <p>Imagen: <input type="text" name="imagen" /></p>
        <p>Precio: <input type="text" name="precio" /></p>
        <p><input type="submit" /></p>
    </form>
    <?php
    
    ?>
    <h1>Login o registrarse:</h1>
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="registro.php">Registro</a></li>
    </ul>
</body>
</html>