<?php
include "conexion/conexionBD.php";
include "carrito.php";
include "template/cabecera.php";
?>

<?php

$fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]): null;
$cliente = isset($_POST["cliente"]) ? mb_strtoupper(trim($_POST["cliente"]), 'UTF-8') : null;
$total = isset($_POST["total"]) ? trim($_POST["total"]): null; 
$observaciones = isset($_POST["observaciones"]) ? mb_strtoupper(trim($_POST["observaciones"]), 'UTF-8') : null;
$codTar = isset($_POST["codTar"]) ? trim($_POST["codTar"]): null;
$codCom = isset($_POST["codCom"]) ? trim($_POST["codCom"]): null;


$sql = "INSERT INTO pedido VALUES (0, '$fecha', '$cliente', '$total', '$observaciones','$codTar','$codCom')";

if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-success">Se ha realizado tu pedido correctamente</div>';
    //print_r($sql);
    
} else {
    if ($conn->errno == 1062) {
        echo '<div class="alert alert-success">No se ha podidio realizar tu pedido correctamente</div>';
        //print_r($sql);
    } else {
        echo '<div class="alert alert-success">No se ha podidio realizar tu pedido correctamente</div>';;
        //print_r($sql);
    }
}

//cerrar la base de datos
$conn->close();
echo "<a href='mostrarCarrito.php'>Regresar</a>";
session_destroy();

?>

<?php
include "template/pie.php"

?>