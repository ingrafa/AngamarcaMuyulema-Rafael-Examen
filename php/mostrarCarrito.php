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


    <script src="buscar_tarjeta.js" type="text/javascript"></script>
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

    <?php


    if (!empty($_SESSION['CARRITO'])) { ?>

        <h3>Datos Cliente</h3>

        <br>
        <form onsubmit="return buscarPorTarjeta()">

        </form>


        <form id="formulario1" method="Post" action="crear_pedido.php">

            <label for="numTar">Numero de tarjeta(*)</label>
            <input type="text" id="tarjeta" name="buscar" value="" placeholder="Numero Tarjeta " required>
            <input type="button" id="buscar" name="buscar" value="Buscar tarjeta" onclick="buscarPorTarjeta()">
            <div id="informacion"><b>Datos de la tarjeta</b></div>

            <label for="fecha">Fecha(*)</label>
            <input type="date" id="fecha" name="fecha" value="" placeholder="Ingrese su fecha" required />
            <br>

            <label for="cliente">Nombres y apellidos (*)</label>
            <input type="text" id="cliente" name="cliente" value="" placeholder="Ingrese sus nombres" required />
            <br>

            <br><br>

            <h3>Lista del carrito</h3>
            <br>
            
            <table class="table table-light table-bordered">
                <tbody>
                    <tr>
                        <th width="40%">Nombre</th>
                        <th width="15%" class="text-center">Cantidad</th>
                        <th width="20%" class="text-center">Precio</th>
                        <th width="20%" class="text-center">Total</th>
                        <th width="5%">--</th>
                    </tr>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
                         <input type="hidden" id="codCom" name="codCom" value="<?php echo $producto['Codigo'] ?>" />
                        <tr>
                            <td width="40%"><?php echo $producto['Nombre'] ?> </td>
                            <td width="15%" class="text-center"><?php echo $producto['Cantidad'] ?> </td>
                            <td width="20%" class="text-center"><?php echo $producto['Precio'] ?> </td>
                            <td width="20%" class="text-center"><?php echo number_format($producto['Cantidad'] * $producto['Precio'], 2); ?> </td>
                            <td width="5%">
                                <form action="" method="post">
                                    <input type="hidden" name="codigo" value="<?php echo $producto['Codigo']; ?>">
                                    <button class="btn btn-danger" type="submit" name="btnAccion" value="eliminar">Eliminar</button>
                                </form>
                            </td>

                        </tr>
                        <?php $total = $total + ($producto['Cantidad'] * $producto['Precio']); ?>
                    <?php } ?>


                    <tr>
                        <td colspan="3" align="right">
                            <h3>Total</h3>
                        </td>
                        <td align="right">
                            <h3> <?php echo number_format($total, 2); ?> </h3>
                        </td>
                        <td align="right"></td>
                    </tr>

                </tbody>
            </table>

            <br>
            <label for="observaciones">Observaciones (*)</label>
            <input type="text" id="observaciones" name="observaciones" value="" placeholder="Ingrese su observacion aqui" required />

            <input type="hidden" id="total" name="total" value="<?php echo number_format($total, 2); ?>" />

            <br><br>
            <input type="submit" class="boton" id="crear" name="crear" value="Pedir" />
            <input type="reset" class="boton" id="cancelar" name="cancelar" value="Cancelar" />
            <br><br>
        </form>





    <?php } else { ?>

        <div class="alert alert-success">No hay productos en el carrito</div>

    <?php } ?>


    <?php
    include "template/pie.php"
    ?>