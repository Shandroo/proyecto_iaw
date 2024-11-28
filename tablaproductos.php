<?php 

include_once("lib.php");
$conn= conexion();

session_start();

$consulta ="select * from productos";

$resultados = $conn->query($consulta);
?>
<div class="administracionbbdd">
    <div class="menu-vertical">
        <ul>
            <li><a href="tablaproductos.php">Productos</a></li>
            <li><a href="tablapedidos.php">Pedidos</a></li>
            <li><a href="cerrarsesionadmin.php">Cerrar sesión</a></li>  
        </ul>    
        <div class="table-container">
        <table class="tablaproductos">
            <tbody>
                <tr style="background-color: #00D561;">
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO</th>
                    <th>IMAGEN</th>
                    <th>ULTIMA_MODIFICACION</th>
                    <th colspan="2" style="text-align: center;">ACCIONES</th>
                </tr>
                <?php
                    while($fila = $resultados->fetch_assoc()){
                ?> 
                <tr>
                    <td><?php echo $fila['id_producto'];?></td>
                    <td><?php echo $fila['nombre'];?></td>
                    <td><?php echo $fila['descripcion'];?></td>
                    <td><?php echo $fila['precio'];?>$</td>
                    <td><?php echo $fila['imagen'];?>$</td>
                    <td><?php echo $fila['ultima_modificacion'];?></td>
                </tr>
                <?php } ?>