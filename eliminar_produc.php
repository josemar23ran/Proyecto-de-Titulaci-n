<?php
include('Conexion.php');
#echo"SI llegue aqui";
session_start();
$recupera_update=$_GET['actualiza'];
#echo $recupera_update;
#echo"SI llegue aqui";
$user=$_SESSION['user'];
#echo $user;
$delete_producto="delete from $user where Producto = '$recupera_update'"; #Cambiar aID
odbc_exec($link2,$delete_producto);
header("Location: muestraTodo.php");
?>