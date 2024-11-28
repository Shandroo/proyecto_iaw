<?php
// Crear una conexión
include_once("lib.php");
$conn = conexion();

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Comprobar si los datos del formulario están vacíos
if (empty($_POST["usuario"]) || empty($_POST["contrasena"])) {
    echo "<h1>Debes indicar el usuario y la contraseña para poder iniciar sesión</h1>";
    echo "<a href='registrarusuario.php'>Volver</a>";
    exit();
} else {
    // Recojo los parámetros enviados
    $name = $_POST["usuario"];
    $pass = $_POST["contrasena"];

    // Escapar los datos para evitar inyecciones SQL
    $name = $conn->real_escape_string($name);
    $pass = $conn->real_escape_string($pass);

    // Verificar si el usuario ya existe
    $select = "SELECT id FROM usuarios WHERE nombre='$name'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0) {
        echo "<h1>Ha fallado, el usuario ya existe</h1>";
        echo "<a href='registrarusuario.php'>Volver</a>";
    } else {
        // No usamos cifrado de la contraseña, la almacenamos tal cual
        // Construyo la consulta para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, contraseña) VALUES ('$name', '$pass')";

        // Imprimir la consulta para depuración
        echo $sql;

        // Ejecutar la consulta y comprobar si se ejecuta correctamente
        if ($conn->query($sql) === TRUE) {
            echo "<h1>Usuario registrado con éxito</h1>";
            // Redirigir a la página de login
            header("Location: formulariologin.php");
        } else {
            echo "Error: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    }
}
?>