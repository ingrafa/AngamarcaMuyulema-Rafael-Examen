<?php
//incluir conexión a la base de datos
include "conexion/conexionBD.php";
$tarjeta = $_GET['tarjeta'];
//echo "Hola " . $cedula;

$sql = "SELECT * FROM tarjeta_credito WHERE tar_num_tarjeta='$tarjeta'";
//cambiar la consulta para puede buscar por ocurrencias de letras
$result = $conn->query($sql);

echo " <table style='width:100%'>
            <tr>
            <th>Codigo</th>
            <th>Num Tarjeta</th>
            <th>Nombre</th>
            <th>Fecha Caducidad</th>
            <th></th>
            <th></th>
            <th></th>
            </tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<input type="hidden" id="codTar" name="codTar" value="'. $row['tar_codigo'] .'" />';
        echo "<tr>";
        echo " <td>" . $row['tar_codigo'] . "</td>";
        echo " <td>" . $row['tar_num_tarjeta'] . "</td>";
        echo " <td>" . $row['tar_nombre'] . "</td>";
        echo " <td>" . $row['tar_fecha_cad']  . "</td>";
        echo "</tr>";
       

    }
} else {
    echo "<tr>";
    echo " <td colspan='7'> No existen tarjetas registradas en el sistema </td>";
    echo "</tr>";
}
echo "</table>";
$conn->close();

?>