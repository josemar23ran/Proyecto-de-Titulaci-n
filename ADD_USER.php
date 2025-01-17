<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylos.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Agregar Tienda</h2>
        <form name='AgregarTienda' action='ad_USER_SQL.php' method='post'>
            Ingresa el usuario:
            <input type='text' name='usuario' maxlength='15' required placeholder='Ingrese el nombre de usuario'><br><br> 
            Ingresa una contraseña:  
            <input type='password' name='contrasena' maxlength='10' required placeholder='Ingrese la contraseña'><br><br>
            <input type='submit' value='Agregar'> <br><br>
        </form>
    </div>
</body>
</html>