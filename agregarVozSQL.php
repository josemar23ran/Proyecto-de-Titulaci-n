<?php
// Verificar si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha recibido datos en el cuerpo de la solicitud
    $postData = file_get_contents("php://input");
    
    if ($postData !== false) {
        // Decodificar la cadena JSON recibida
        $data = json_decode($postData, true);

        // Verificar si se pudo decodificar la cadena JSON correctamente
        if ($data !== null) {
            // Acceder a los valores del objeto en PHP
            $producto = $data['producto'];
            $marca = $data['marca'];
            $precio = $data['precio'];
            $inventario = $data['inventario'];
            header("Location: editorSQLVoz.php?producto=$producto&marca=$marca&precio=$precio&inventario=$inventario");
            exit();
            // Imprimir los valores para verificar
            //echo "Producto: " . $producto . "\n";
            //echo "Marca: " . $marca . "\n";
            //echo "Precio: " . $precio . "\n";
            //echo "Inventario: " . $inventario . "\n";

            // Devolver una respuesta al cliente (puede ser un mensaje de éxito o cualquier otra cosa)
            //echo "Datos recibidos correctamente en el servidor.";

            // Redirigir después de procesar los datos
            exit();
        } else {
            echo "Error al decodificar los datos JSON.";
        }
    } else {
        echo "No se recibieron datos en el cuerpo de la solicitud.";
    }
} else {
    echo "Solicitud no válida. Método esperado: POST";
}
?>