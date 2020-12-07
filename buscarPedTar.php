<?php
include "conexion/conexionBD.php";
$tarjeta = $_GET['tarjeta'];

$sql = "SELECT ped_fecha, ped_cliente, com_comida, com_precio, ped_total FROM pedido a, tarjeta_credito b, comida c
        WHERE b.tar_num_tarjeta='$tarjeta' and a.tar_codigo = b.tar_codigo and a.com_codigo = c.com_codigo";

$result = $conn->query($sql);

echo " <table style='width:100%'>
                <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Comida</th>
                <th>Precio unitario</th>
                <th>total</th>
                <th></th>
                <th></th>
                <th></th>
                </tr>";
print_r($sql);
print_r($result);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //echo '<input type="text" id="codTar" name="codTar" value="'. $row['tar_codigo'] .'" />';
        echo "<tr>";
        echo " <td>" . $row['ped_fecha'] . "</td>";
        echo " <td>" . $row['ped_cliente'] . "</td>";
        echo " <td>" . $row['com_comida']  . "</td>";
        echo " <td>" . $row['com_precio'] . "</td>";
        echo " <td>" . $row['ped_total']  . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";
    echo " <td colspan='7'> No existen pedidos con esa tarjeta registrada en el sistema </td>";
    echo "</tr>";
}
echo "</table>";
$conn->close();
