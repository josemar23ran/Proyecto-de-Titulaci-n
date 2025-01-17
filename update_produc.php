<?php
include('Conexion.php');
session_start();
$recupera_update = $_GET['actualiza'];
$recupera_user = $_SESSION['user'];
#echo $recupera_update;
$mostrar = "select * from $recupera_user where Producto='$recupera_update'";
$mostrar_1 = odbc_exec($link2, $mostrar);
$row = odbc_fetch_array($mostrar_1);
$producto_muestra = $row['Producto'];
$marca_muestra = $row['Marca'];
$precio_muestra = $row['Precio'];
$fecha_muestra = $row['Fecha'];
$inventario_muestra = $row['Inventario'];
$imagen_muestra = $row['Imagen'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="container">
<button onclick="startListening()"style="background-color: #4CAF50; color: white; padding: 10px 20px; font-size: 16px; border-radius: 20px; cursor: pointer;">Activar Voz</button>
    <p id="Result"></p>
    <script src="Voz_UP.js"></script>
<form name='Agregar_producto' action='UpdSQ.php' method='post'>
    <h2>Modificar Producto</h2>
    Producto:
    <input type='text' name='Producto' maxlength='25' value='<?php echo $producto_muestra; ?>' required placeholder='Ingrese el Nombre de su producto'><br><br>
    Marca:
    <input type='text' name='Marca' maxlength='25' value='<?php echo $marca_muestra; ?>' placeholder='Si no aplica, deje en blanco'><br><br>
    Precio:
    <input type='text' name='Precio' maxlength='6' required value='<?php echo $precio_muestra; ?>' placeholder='Por kilo o por producto'><br><br>
    Fecha:
    <input type='date' name='Fecha' value='<?php echo $fecha_muestra; ?>' required><br><br>
    Inventario:
    <input type='text' name='Inventario' maxlength='6' value='<?php echo $inventario_muestra; ?>' required placeholder='La cantidad en inventario'><br><br>
    Dirección de imagen:
    <input type='text' name='Imagen' maxlength='200' value='<?php echo $imagen_muestra; ?>'  placeholder='URL o nombre de imagen.PNG'><br><br>
    <input type='text' name='recupera_producto' value='<?php echo $producto_muestra; ?>' hidden>
    <input type='submit' value='Modificar'><br><br>
</form>
</div>
<h2><a href='muestraTodo.php'>Salir</a></h2>
</body>
</html>