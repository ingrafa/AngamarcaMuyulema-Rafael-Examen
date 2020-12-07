<?php
session_start();
$mensaje = "";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'agregar':
            if (is_numeric($_POST['codigo'])) {
                $codigo = $_POST['codigo'];
                $mensaje .= "Codigo correcto " . $codigo;
            } else {
                $mensaje .= "Codigo incorrecto " . $codigo;
            }

            if (is_string($_POST['nombre'])) {
                $nombre = $_POST['nombre'];
                $mensaje .= "Nombre correcto " . $nombre;
            } else {
                $mensaje .= "Nombre incorrecto " . $nombre;
                break;
            }

            if (is_numeric($_POST['precio'])) {
                $precio = $_POST['precio'];
                $mensaje .= "Precio correcto " . $precio;
            } else {
                $mensaje .= "Precio incorrecto " . $precio;
                break;
            }

            if (is_numeric($_POST['cantidad'])) {
                $cantidad = $_POST['cantidad'];
                $mensaje .= "Cantidad correcta " . $cantidad;
            } else {
                $mensaje .= "Cantidad incorrecta " . $cantidad;
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'Codigo' => $codigo,
                    'Nombre' => $nombre,
                    'Precio' => $precio,
                    'Cantidad' => $cantidad
                );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje = "Producto agregado al carrito";
            } else {
                $idProducto = array_column($_SESSION['CARRITO'], "Codigo");
                if(in_array($codigo,$idProducto)){
                    echo "<script>alert('El producto ya ha sido seleccionado')</script>";
                }else{
                    $numeroProd = count($_SESSION['CARRITO']);
                    $producto = array(
                        'Codigo' => $codigo,
                        'Nombre' => $nombre,
                        'Precio' => $precio,
                        'Cantidad' => $cantidad
                    );
                    $_SESSION['CARRITO'][$numeroProd] = $producto;
                    $mensaje = "Producto agregado al carrito";
                }
                
            }
            // $mensaje= print_r($_SESSION,true);
            $mensaje = "Producto agregado al carrito";
            break;

        case 'eliminar':
            if (is_numeric($_POST['codigo'])) {
                $codigo = $_POST['codigo'];
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['Codigo'] == $codigo) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado')</script>";
                    }
                }
            } else {
                $mensaje .= "Codigo incorrecto " . $codigo;
            }
            break;
    }
}

