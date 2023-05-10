<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Crear Restaurante</title>
 <style type="text/css" rel="stylesheet">
 .error{
 color: red;
 }
 </style>
</head>
<body>
 <?php
 //incluir conexión a la base de datos
 include '../../config/conexionBD.php';
 

 $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
 $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

 $sql = "INSERT INTO restaurante VALUES (0,'$nombre','$correo', MD5('$contrasena'),'1')";

 if ($conn->query($sql) === TRUE) {
    include 'login_restaurante.php';
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
 echo "<a href='../vista/login_restaurante.html'> Iniciar Sesión </a>";

 ?>
</body>
</html>

