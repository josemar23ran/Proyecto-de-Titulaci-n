<?php
include('Conexion.php');
$user=$_POST['usuario'];
$pass=$_POST['contrasena'];
$agregar="create table $user (ID int, Producto varchar(30), Marca varchar(30),Precio Decimal(10,2), Fecha date, Inventario decimal(15,2), Imagen varchar(250) )";
odbc_exec($link2,$agregar);
$U_ADD="insert into users values(0,'$user','$pass')";
odbc_exec($link2,$U_ADD);
header("Location: Admin_SU.php");
?>
