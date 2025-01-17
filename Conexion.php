<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
   ini_set('display_errors',0);
   ini_set('display_startup_errors', 0);
   error_reporting(0);
   function Conectarse()
   {
       $dsn = "Driver={SQL Server};
       Server=nombre_del_servidor ;Database=Base_de_datos;";    #Nombre del Servidor y de la base de Datos
       $link = odbc_pconnect($dsn, 'user', 'password');  #Nombre de usuario y la contraseña de sql server MS
       if (!$link) {
           echo "Error conectando a la base de datos. ";
           exit();
       } else {
          # echo "Conectado correctamente. :) ";   #Descomentar para verificar la conexion 
       }
       return $link;
   }
    $link2 = Conectarse();
?>
</body>
</html>

