<?php
include_once("lib.php");

session_start();

if (isset($_POST['usuario_cliente']) && isset($_POST['contraseña_cliente'])) {

    $conn = conexion();
    $user = $conn->real_escape_string($_POST['usuario_cliente']);
    $pass = $conn->real_escape_string($_POST['contraseña_cliente']);


} else {
   header("Location: formulariologin.php?msg=Deben indicarse correctamente los datos de acceso");
   exit;
}

$consulta = "SELECT * from usuarios WHERE nombre= '$user' and contraseña= '$pass'";
$resultado=$conn->query($consulta);

if($resultado->num_rows > 0) { // login correcto
   $fila=$resultado->fetch_assoc();
   $idUsuario= $fila['id'];

   $resultado->close();

      //$_SESSION['login']= true;
      $_SESSION['usuario']=$user;
      $_SESSION['id_usuario']=$idUsuario;
        // Comprobamos si el usuario es 'admin'
    if ($_SESSION['usuario'] === 'admin') {
      // Agrega un mensaje para verificar si llegamos aquí
      echo "Redirigiendo al administrador..."; 
      header("Location: zonaadmin.php");
      exit; // Terminar el script tras la redirección
  } else {
      header("Location: index.php");
      exit;
  }
} else {
  header("Location: formulariologin.php?msg=Los datos indicados no son correctos");
  exit;
    
}
 
//Cierro la conexión a la base de datos.
$conn->close();

Header("Location: index.php");