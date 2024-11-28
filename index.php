<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Comida China</title>
</head>
<body>
    <h1>Comida China </h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th></th>
        </tr>

        <?php
        session_start();
        echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
        unset($_SESSION['msg']);

        include_once("lib.php");
        $conn = conexion();
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $imagen = "imagenes/" . $row['imagen'];
            if (!file_exists($imagen)) {
                $imagen = "imagenes/no-imagen.jpg";
            }
        ?>
        <tr>
            <td><a href="verproducto.php?id=<?=$row['id']?>"><?=$row['nombre']?></a></td>
            <td><?=$row['descripcion']?></td>
            <td><img src="<?=$imagen?>" alt="Imagen del producto"></td>
            <td><?=$row['precio']?> &euro;</td>
            <td>
                <form method="POST" action="carrito.php">
                    <input type="hidden" name="id_producto" value="<?=$row['id'];?>">
                    <button type="submit">Añadir al carrito</button>
                </form>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <div class="login-container">
        <?php
        if (isset($_SESSION['usuario'])) {
            echo '<a class="logout-link" href="logout.php">Logout</a>';
        } else {
            echo '
            <h2>Login o Registrarse:</h2>
            <ul>
                <li><a href="formulariologin.php">Login</a></li>
                <li><a href="registrarusuario.php">Registro</a></li>
            </ul>';
        }
        ?>
    </div>

    <!-- CSS ubicado al final del archivo -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #d35400;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f39c12;
            color: white;
        }
        td {
            background-color: #fff;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        form button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }
        form button:hover {
            background-color: #27ae60;
        }
        a {
            color: #2980b9;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            margin: 5px 0;
        }
        .login-container {
            text-align: center;
            margin-top: 30px;
        }
        .logout-link {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-link:hover {
            background-color: #c0392b;
        }
    </style>
</body>
</html>