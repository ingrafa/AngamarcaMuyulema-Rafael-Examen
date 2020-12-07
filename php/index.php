<?php
include "conexion/conexionBD.php";
include "carrito.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            background: #CC95C0;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, rgba(122, 162, 210, 0.61), rgba(219, 212, 180, 0.61), rgba(204, 148, 192, 0.61));
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, rgba(122, 162, 210, 0.61), rgba(219, 212, 180, 0.61), rgba(204, 148, 192, 0.61));
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        h1 {
            text-align: center;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El pollo cantor</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


    <script src="js/buscar_ped_comida.js" type="text/javascript"></script>
    <script src="js/buscar_ped_tarjeta.js" type="text/javascript"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php">UPS El pollo cantor Examen</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mostrarCarrito.php">Carrito(<?php
                                                                            echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);
                                                                            ?>)</a>
                </li>
            </ul>
        </div>
    </nav>

    <br><br>
    <div class="container">

        <br>
        <?php if ($mensaje != "") { ?>
            <div class="alert alert-success">

                <?php echo $mensaje; ?>
                <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
            </div>
        <?php } ?>

        <form onsubmit="return buscarPedComida()">
            <input type="text" id="comida" name="buscar1" value="" placeholder="Nombre comida ">
            <input type="button" id="buscar" name="buscar" value="Buscar " onclick="buscarPedComida()">
        </form>
        <div id="informacion1"><b>Datos de los pedidos por comida</b></div>
        <br>

        <form onsubmit="return buscarPedTarjeta()">
            <input type="text" id="tarjeta" name="buscar" value="" placeholder="Numero Tarjeta ">
            <input type="button" id="buscar" name="buscar" value="Buscar " onclick="buscarPedTarjeta()">
        </form>
        <div id="informacion"><b>Datos de los pedidos por tarjeta</b></div>
        <br>



        <div class="row">
            <?php
            $sql = "SELECT * FROM comida";
            $resultado = $conn->query($sql);
            $cont = 1;
            if ($resultado->num_rows > 0) {
                //echo $resultado->num_rows;
                while ($row = $resultado->fetch_assoc()) {
                    //var_dump($row);
                    echo '<div class="col-3">';
                    echo '<div class="card">';
                    echo    '<img title="' . $row['com_comida'] . '" class="card-img-top" src="' . $row['com_imagen'] . '" alt="' . $row['com_comida'] . '">';
                    echo    '<div class="card-body">';
                    echo    '<h5 class="card-title">$' . $row['com_precio'] . '</h5>';
                    echo    '<p class="card-text">' . $row['com_comida'] . '</p>';

                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="codigo" id="codigo" value="' . $row['com_codigo'] . '">';
                    echo '<input type="hidden" name="nombre" id="nombre" value="' . $row['com_comida'] . '">';
                    echo '<input type="hidden" name="precio" id="precio" value="' . $row['com_precio'] . '">';
                    echo '<input type="hidden" name="cantidad" id="cantidad" value="' . $cont . '">';

                    echo  '<button class="btn btn-primary" name="btnAccion" value="agregar" type="submit">Agregar al carrito</button>';
                    echo '</form>';


                    echo    '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <?php
        include "template/pie.php"
        ?>