<?php
include('Conexion.php');
session_start();
$recupera_produc=$_POST['recupera_producto'];
$user=$_SESSION['user'];
$UP_producto=$_POST['Producto'];
$UP_marca=$_POST['Marca'];
$UP_fecha=$_POST['Fecha'];
$fecha_objeto = date_create_from_format('d/m/Y', $UP_fecha);

if ($fecha_objeto !== false) {
    // Formatear la fecha en el nuevo formato mm/dd/aaaa
    $UP_fecha = date_format($fecha_objeto, 'm/d/Y');
    }

$UP_inventario=$_POST['Inventario'];
$UP_precio=$_POST['Precio'];
$UP_imagen=$_POST['Imagen'];
$actualiza_datos="update $user set Producto='$UP_producto',Marca='$UP_marca',Precio='$UP_precio',
                                       Fecha='$UP_fecha',Inventario='$UP_inventario',Imagen='$UP_imagen' 
                                       where Producto='$recupera_produc'"; #Cambiar porducto por ID cuando funcione
odbc_exec($link2,$actualiza_datos);
header("Location: muestraTodo.php");