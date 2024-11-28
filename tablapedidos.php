<?php
include_once("lib.php");
$conn= conexion();

session_start();

$consulta="select * from pedidos";

$guardar= $conn->query($consulta);

?>
 <div class="table-container">
        <table class="tablaproductosadmin">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>ID CLIENTE</th>
                    <th>ID PRODUCTO</th>
                    <th>PRECIO TOTAL</th>
                    <th>FECHA CREACIÓN</th>
                </tr>
                <?php
                    while($fila = $guardar->fetch_assoc()){
                ?> 
                <tr>
                    <td><?php echo $fila['id_pedido'];?></td>
                    <td><?php echo $fila['id_cliente'];?></td>
                    <td><?php echo $fila['id_producto'];?></td>
                    <td><?php echo $fila['precio_total'];?></td>
                    <td><?php echo $fila['fecha_crecion'];?> €</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>   
    <?php
$conn->close()
    ?>