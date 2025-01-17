<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de la Tienda</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    
    <?php
    include('Conexion.php');
    session_start();
    $user_consulta = $_SESSION['user'];
    $consulta_producto = "select * from $user_consulta";
    $resultado_producto = odbc_exec($link2, $consulta_producto);
       echo"<h1> Bienvenido $user_consulta</h1>";
       ?>
       <button onclick="startListening()"style="background-color: #4CAF50; color: white; padding: 10px 20px; font-size: 16px; border-radius: 20px; cursor: pointer;">Activar Voz</button>
    <p id="output"></p>
    <script src="voice_commands.js"></script>
    <table border='1' bordercolor='#0099CC' width='100%'>
        <tr>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Inventario</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>

        <?php
        while ($row2 = odbc_fetch_array($resultado_producto)) {
            $update_producto = $row2['Producto'];
            echo "
            <tr>
            <td><img src='" . (empty($row2['Imagen']) ? 'defecto.png' : $row2['Imagen']) . "' alt='Imagen de Producto'></td>

                <td>" . $row2['Producto'] . "</td>
                <td>" . $row2['Marca'] . "</td>
                <td>$" . $row2['Precio'] . "</td>
                <td>" . $row2['Fecha'] . "</td>
                <td>" . $row2['Inventario'] . "</td>
                <td><a href='update_produc.php?actualiza=$update_producto&user_rec=$user_consulta'><img src='edit.png' width='30' height='30'></a></td>
                <td><a href='eliminar_produc.php?actualiza=$update_producto&user_rec=$user_consulta'><img src='eliminar.png' width='30' height='30'></a></td>
            </tr>";
        }
        ?>

    </table>

    <div>
        <a href='Tienda_1.php'>
            <input type='submit' value='Agregar'><br><br>
        </a>
    </div>
    <h2><a href='index.php'>Salir</a></h2>
</body>
</html>
