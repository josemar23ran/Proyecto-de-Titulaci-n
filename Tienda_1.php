<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="container">
<button onclick="startListening()"style="background-color: #4CAF50; color: white; padding: 10px 20px; font-size: 16px; border-radius: 20px; cursor: pointer;">Activar Voz</button>
    <p id="Result"></p>
    <script src="Voz_Add.js"></script>
    <form name='Agregar_producto' action='addSQL.php' method='post'>
        <h2>Agregar Producto</h2>
        Producto:   
        <input type='text' name='Producto' maxlength='25' required placeholder='Ingrese el Nombre de su producto'><br><br>
        Marca:    
        <input type='text' name='Marca' maxlength='25' placeholder='Si no aplica, deje en blanco'><br><br>  
        Precio: 
        <input type='text' name='Precio' maxlength='6' required placeholder='Por kilo o por producto'><br><br>
        Fecha:
        <input type='date' name='Fecha' required><br><br>
        Inventario:
        <input type='text' name='Inventario' maxlength='6' required placeholder='La cantidad en inventario'><br><br>
        Dirección de imagen:
        <input type='text' name='Imagen' maxlength='200'  placeholder='URL o nombre de imagen.PNG'><br><br>
        <input type='submit' value='Agregar'><br><br>
    </form>
</div>
<h2><a href='muestraTodo.php'>Salir</a></h2>

</body>
</html>