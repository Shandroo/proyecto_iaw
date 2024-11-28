<?php
session_start();
include_once("lib.php");

// Me conecto a la BBDD
$conn = conexion();
// Si no existe el carrito, lo inicializamos
if (!isset($_SESSION['carro'])) {
    $_SESSION['carro'] = [];
}

// Añadimos producto al carrito
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Si ya existe en el carrito, incrementamos la cantidad
    if (isset($_SESSION['carro'][$id_producto])) {
        $_SESSION['carro'][$id_producto]['cantidad']++;
    } else {
        // Obtenemos información del producto desde la base de datos
        $sql = "SELECT nombre, precio FROM productos WHERE id = '$id_producto'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();
            $_SESSION['carro'][$id_producto] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        } else {
            echo "Producto no encontrado.";
        }
    }
}

// Eliminamos producto individual del carrito
if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];
    unset($_SESSION['carro'][$id_producto]);
}

// vaciamos carrito
if (isset($_GET['vaciar'])) {
    unset($_SESSION['carro']);
}

// Mostramos carrito
echo "<h1>Mi Carrito</h1>";
if (!empty($_SESSION['carro'])) {
    echo "<table border='1'>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>";

    $importe_total = 0;
    foreach ($_SESSION['carro'] as $id => $producto) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        $importe_total += $subtotal;
        echo "<tr>
                <td>{$producto['nombre']}</td>
                <td>{$producto['precio']} &euro;</td>
                <td>{$producto['cantidad']}</td>
                <td>{$subtotal} &euro;</td>
                <td>
                    <a href='?eliminar=$id'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "<tr>
            <td colspan='3'><strong>Importe Total</strong></td>
            <td colspan='2'><strong>{$importe_total} &euro;</strong></td>
          </tr>";
    echo "</table>";
    echo "<br><a href='?vaciar=1'>Vaciar Carrito</a> | <a href='?comprar=1'>Realizar Compra</a>";
} else {
    echo "El carrito está vacío.";
}

// Procesamos la compra
if (isset($_GET['comprar']) && !empty($_SESSION['carro'])) {
    $cliente_id = $_SESSION['id_usuario'];
    foreach ($_SESSION['carro'] as $id_producto => $producto) {
        $cantidad = $producto['cantidad'];
        $precio_total = $producto['precio'] * $cantidad;

        // Insertamos pedido en la base de datos
        $sql = "INSERT INTO pedidos (id_cliente, id_producto, cantidad, precio_total) 
                VALUES ('$cliente_id', '$id_producto', '$cantidad', '$precio_total')";
        
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "Pedido realizado con éxito.";
        } else {
            echo "Error al realizar el pedido: " . $conn->error;
        }
    }
    unset($_SESSION['carro']); // Vaciamos el carrito después de la compra
}
?>