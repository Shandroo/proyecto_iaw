<?php
include_once("lib.php");
session_start();
$conn = conexion(); // Conexión a la base de datos

// Simulamos un usuario logueado para pruebas
if ($_SESSION['usuario'] !== 'admin') {
    echo "Acceso denegado. Solo los administradores pueden acceder a esta sección.";
    exit;
} else {
    echo "Acceso concedido. Bienvenido, administrador.";
}

// Formulario para añadir un producto
echo "<h3>Añadir Producto</h3>";
echo "<form action='zonaadmin.php' method='post'>
        <label for='nombre'>Nombre del Producto:</label><br>
        <input type='text' id='nombre' name='nombre' required><br>
        <label for='descripcion'>Descripción:</label><br>
        <textarea id='descripcion' name='descripcion' required></textarea><br>
        <label for='precio'>Precio:</label><br>
        <input type='number' id='precio' name='precio' required><br><br>
        <input type='submit' name='añadir_producto' value='Añadir Producto'>
      </form>";

// Procesamos la acción de añadir el producto
if (isset($_POST['añadir_producto'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', '$precio')";
    if ($conn->query($sql) === TRUE) {
        echo "Producto añadido exitosamente.";
    } else {
        echo "Error al añadir el producto: " . $conn->error;
    }
}

// Mostramos productos registrados
echo "<h3>Productos Registrados</h3>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>";

$sql_productos = "SELECT id, nombre, descripcion, precio FROM productos;";
$resultado_productos = $conn->query($sql_productos);

if ($resultado_productos === false) {
    echo "Error en la consulta: " . $conn->error;
} else {
    while ($producto = $resultado_productos->fetch_assoc()) {
        echo "<tr>
                <td>{$producto['id']}</td>
                <td>{$producto['nombre']}</td>
                <td>{$producto['descripcion']}</td>
                <td>{$producto['precio']} &euro;</td>
                <td><a href='zonaadmin.php?eliminar_producto={$producto['id']}'>Eliminar</a> | 
                    <a href='zonaadmin.php?editar_producto={$producto['id']}'>Editar</a></td>
              </tr>";
    }
}
echo "</table>";

// Procesamos la acción de eliminar el producto
if (isset($_GET['eliminar_producto'])) {
    $id_producto = $_GET['eliminar_producto'];

    // Eliminamos el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = '$id_producto'";
    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

// Procesamos la acción de editar el producto
if (isset($_GET['editar_producto'])) {
    $id_producto = $_GET['editar_producto'];

    // Obtenemos los datos del producto a editar
    $sql = "SELECT id, nombre, descripcion, precio FROM productos WHERE id = '$id_producto'";
    $resultado = $conn->query($sql);
    $producto = $resultado->fetch_assoc();

    echo "<h3>Modificar Producto</h3>";
    echo "<form action='zonaadmin.php?editar_producto={$id_producto}' method='post'>
            <label for='nombre'>Nombre del Producto:</label><br>
            <input type='text' id='nombre' name='nombre' value='{$producto['nombre']}' required><br>
            <label for='descripcion'>Descripción:</label><br>
            <textarea id='descripcion' name='descripcion' required>{$producto['descripcion']}</textarea><br>
            <label for='precio'>Precio:</label><br>
            <input type='number' id='precio' name='precio' value='{$producto['precio']}' required><br><br>
            <input type='submit' name='modificar_producto' value='Modificar Producto'>
          </form>";
}

// Procesamos la acción de modificar el producto
if (isset($_POST['modificar_producto'])) {
    $id_producto = $_GET['editar_producto'];
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio = $_POST['precio'];

    // Actualizamos el producto
    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE id='$id_producto'";
    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }
}

// Mostramos los usuarios registrados
echo "<h3>Usuarios Registrados</h3>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>Acciones</th>
        </tr>";

$sql_usuarios = "SELECT id, nombre, contraseña FROM usuarios;";
$resultado_usuarios = $conn->query($sql_usuarios);

// Verificamos si la consulta ha tenido éxito
if ($resultado_usuarios === false) {
    echo "Error en la consulta: " . $conn->error;
} else {
    while ($usuario = $resultado_usuarios->fetch_assoc()) {
        echo "<tr>
                <td>{$usuario['id']}</td>
                <td>{$usuario['nombre']}</td>
                <td>{$usuario['contraseña']}</td>
                <td><a href='zonaadmin.php?eliminar_usuario={$usuario['id']}'>Eliminar</a></td>
              </tr>";
    }
}
echo "</table>";

// Procesamos la acción de eliminar el usuario
if (isset($_GET['eliminar_usuario'])) {
    $id_usuario = $_GET['eliminar_usuario'];

    // Eliminamos usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = '$id_usuario'";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }
}

// Formulario para añadir un pedido
echo "<h3>Añadir Pedido</h3>";
echo "<form action='zonaadmin.php' method='post'>
        <label for='cliente_id'>ID del Cliente:</label><br>
        <input type='number' id='cliente_id' name='cliente_id' required><br>
        <label for='producto_id'>ID del Producto:</label><br>
        <input type='number' id='producto_id' name='producto_id' required><br>
        <label for='cantidad'>Cantidad:</label><br>
        <input type='number' id='cantidad' name='cantidad' required><br><br>
        <input type='submit' name='añadir_pedido' value='Añadir Pedido'>
      </form>";

// Procesamos la acción de añadir el pedido
if (isset($_POST['añadir_pedido'])) {
    $cliente_id = $_POST['cliente_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Verificamos si el cliente existe en la tabla usuarios
    $sql_cliente = "SELECT id FROM usuarios WHERE id = '$cliente_id'";
    $resultado_cliente = $conn->query($sql_cliente);

    if ($resultado_cliente->num_rows > 0) {
        // Obtenemos el precio del producto
        $sql_producto = "SELECT precio FROM productos WHERE id = '$producto_id'";
        $resultado_producto = $conn->query($sql_producto);
        
        if ($resultado_producto->num_rows > 0) {
            $producto = $resultado_producto->fetch_assoc();
            $precio = $producto['precio'];
            $precio_total = $precio * $cantidad;

            // Insertamos el pedido en la base de datos
            $sql = "INSERT INTO pedidos (id_cliente, id_producto, cantidad, precio_total) 
                    VALUES ('$cliente_id', '$producto_id', '$cantidad', '$precio_total')";

            if ($conn->query($sql) === TRUE) {
                echo "Pedido añadido exitosamente.";
            } else {
                echo "Error al añadir el pedido: " . $conn->error;
            }
        } else {
            echo "Producto no encontrado.";
        }
    } else {
        echo "Cliente no encontrado.";
    }
}

// Mostramos pedidos registrados
echo "<h3>Pedidos Registrados</h3>";
echo "<table border='1'>
        <tr>
            <th>ID Pedido</th>
            <th>ID Cliente</th>
            <th>ID Producto</th>
            <th>Cantidad</th>
            <th>Precio Total</th>
        </tr>";

$sql_pedidos = "SELECT id_pedido, id_cliente, id_producto, cantidad, precio_total FROM pedidos;";
$resultado_pedidos = $conn->query($sql_pedidos);

// Verificamos si la consulta ha tenido éxito
if ($resultado_pedidos === false) {
    echo "Error en la consulta: " . $conn->error;
} else {
    while ($pedido = $resultado_pedidos->fetch_assoc()) {
        echo "<tr>
                <td>{$pedido['id_pedido']}</td>
                <td>{$pedido['id_cliente']}</td>
                <td>{$pedido['id_producto']}</td>
                <td>{$pedido['cantidad']}</td>
                <td>{$pedido['precio_total']} &euro;</td>
              </tr>";
    }
}
echo "</table>";
echo '<a href="logout.php">Logout</a>';

?>
