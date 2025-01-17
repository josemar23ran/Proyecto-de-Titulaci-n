<?php
    include('Conexion.php');
    $user=$_POST['usuario'];
    $pass=$_POST['password'];
    $muestra_usuario="select * from users where usuario='$user'and pass='$pass' ";
    $resultado_usuario=odbc_exec($link2,$muestra_usuario);
   // $row=odbc_fetch_array($resultado_usuario);
   $row=odbc_fetch_array($resultado_usuario);
   $valid=$row['usuario'];
   session_start();

   #echo $valid;
    if($valid=='SU'){
        $_SESSION['user'] = $valid;
        header("Location: Admin_SU.php");
    }
    elseif($valid){
        $_SESSION['user'] = $valid;
        header("Location: muestraTodo.php");
        
        
        exit;
    }
    else{
       echo"Contraseña Fallida :( ";
    }

    //echo $user_consulta."<br>".$user;


?>