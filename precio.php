<?php
include('Conexion.php');
session_start();
$consulta = $_GET['consulta'];
$user = $_SESSION['user'];
$Query = "select * from $user where Producto = '$consulta'";
$aux = odbc_exec($link2, $Query);

echo '<html>
<head>
    <style>
        body {
            font-family: "Arial", sans-serif;
            text-align: center;
            background-color: #000; 
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #4CAF50; 
        }
        p {
            color: #2196F3; 
        }
    </style>
</head>
<body>
    <div class="container">';

if ($row2 = odbc_fetch_array($aux)) {
    echo '<p>El Precio de:</p>';
    echo '<h2>' . $row2['Producto'] . '</h2>';
    echo '<p>Es de:</p>';
    echo '<h2>$' . $row2['Precio'] . '</h2>';
} else {
    echo '<p>No he entendido lo que dijiste, o el producto no existe en la base.<br>¡Vuelve a intentarlo por favor!</p>';
}

echo '</div>
</body>
</html>';
?>