<?php
 
 session_start();
 if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_usuario.html"); 

 }
 ?>
 <!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">
 <meta charset="UTF-8">
 <title>Gestión de usuarios</title>
</head>
<body>
    <div class="loggin">
    <?php
 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php';
 $SesionUsuario = $_SESSION['usuario'];
 $sqlUsuario= "SELECT codUsuario FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$codUsuario = ($row['codUsuario']);   ?> <br> <?php

 $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
 $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
 $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
 $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
 $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;
 
 $sql = "INSERT INTO cliente VALUES ( '$codUsuario' , '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono' ,'3','N', null, null)";
 $sqlUpdate = "UPDATE usuario SET rol='3' WHERE codUsuario='$codUsuario'";
 if ($conn->query($sql) === TRUE && $conn->query($sqlUpdate) === TRUE ) {
    
     echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
 } else {
 if($conn->errno == 1062){
 echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
 }else{
 echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
 }
 }


 //cerrar la base de datos
 $conn->close();
 echo "<a href='confirmarPedido.php'>Continuar</a>";

 ?>
 </div>
 </body>
 </html>