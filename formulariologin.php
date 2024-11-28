<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>formulario login</h2>

        <?php
            if (isset($_GET["msg"])) {
                ?>
                <span style="color:red"><?=$_GET["msg"]?></span>
                <?php
            }
        ?>

        <form action="login.php" class="form_cliente" method="post">
            <input type="text" name="usuario_cliente" placeholder="Usuario"><br>
            <input type="password" name="contraseña_cliente" placeholder="Contraseña"><br>
            <button type="submit">Acceder</button>
        </form>
    <?php
    
    ?>
    <h1>Registro de usuario:</h1>
    <ul>
        <li><a href="registrarusuario.php">Registro</a></li>
    </ul>
</body>
</html>