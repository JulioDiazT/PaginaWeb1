<?php

 session_start();

 include '../../config/conexionBD.php';

 $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;

 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

 $sql = "SELECT * FROM restaurante WHERE correo = '$usuario' and contraseña =  MD5('$contrasena')";

 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 $_SESSION['isLogged'] = TRUE;
 header("Location: ../../admin/vista/restaurante/index.php");
 } else {
 header("Location: ../vista/login_restaurante.html");
 }

 $conn->close();
 
?>
