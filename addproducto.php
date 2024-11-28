<?php

// muestro los datos que me llegan, solo para comprobar
//var_dump($_REQUEST);

// 1. Validar datos con isset
if (isset($_REQUEST['nombre']) && isset ($_REQUEST['descripcion']) && isset ($_REQUEST['imagen']) && isset ($_REQUEST['precio']) ) {
    // 2. Conectamos a la BBDD
    include_once("lib.php");
    $conn= conexion();
    
// 3. Construimos "insert into....."

     $sql = " INSERT INTO productos (nombre, descripcion, imagen, precio)  VALUES (".$_REQUEST['nombre'].",(".$_REQUEST['descripcion'].",(".$_REQUEST['imagen'].",(".$_REQUEST['precio'].",)";
     
    // 4. Ejecutamos la consulta
    $result = $conn->query($sql);

}else{
echo "no se ha podido completar la consulta,datos incompletos";
    //5. Mensaje de error porque no me han llegado los parametros
}


?>