
<?php 
include('Conexion.php');
session_start();
$USER=$_SESSION['user'];
$ADD_producto=$_POST['Producto'];
$ADD_precio=$_POST['Precio'];
$ADD_fecha=$_POST['Fecha'];
$fecha_objeto = date_create_from_format('d/m/Y', $ADD_fecha);
echo $ADD_producto;
if ($fecha_objeto !== false) {
    // Formatear la fecha en el nuevo formato mm/dd/aaaa
    $ADD_fecha = date_format($fecha_objeto, 'm/d/Y');
    }

$ADD_inventario=$_POST['Inventario'];
$ADD_imagen=$_POST['Imagen'];
$ADD_marca=$_POST['Marca'];
$agregar="insert into $USER values(1,'$ADD_producto','$ADD_marca','$ADD_precio','$ADD_fecha','$ADD_inventario','$ADD_imagen')";
odbc_exec($link2,$agregar);
header("Location: muestraTodo.php");
exit;
?>
