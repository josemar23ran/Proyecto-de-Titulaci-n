<?php
function Init_sess($user_1)
{
    $_SESSION['user'] = $user_1;
    header("Location: muestraTodo.php");
}

include('Conexion.php');
session_start();

$cons_tien = "select * from users";
$res_tien = odbc_exec($link2, $cons_tien);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Opciones</title>
    <link rel="stylesheet" href="menu-styles.css">
</head>
<body>
<div class="container">
<?php
echo "
<h2>¿Qué deseas realizar?</h2>";
echo "

<table border='1' bordercolor='#0099CC' width='100%'>
<tr>
<td>
Ingresar a:
</td>
</tr>";

while ($row2 = odbc_fetch_array($res_tien)) {
    if ($row2['ID'] != 1) {
        echo "
        <tr>
            <td>
                <form method='post'>
                    <input type='submit' class='btn' name=" . $row2['usuario'] . " value=" . $row2['usuario'] . ">
                </form>
                <br><br>
            </td>
        </tr>
        ";
    }

    if (isset($_POST[$row2['usuario']])) {
        Init_sess($row2['usuario']);
    }
}

echo "</table>
<br><br>
<a href='ADD_USER'>Agregar una Tienda nueva</a>";
?>
</div>
</body>
</html>
