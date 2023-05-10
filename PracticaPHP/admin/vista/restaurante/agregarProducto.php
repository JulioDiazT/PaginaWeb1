<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_restaurante.html"); 
 }

 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php';
 ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">

 <meta charset="UTF-8">
 <title>Eliminar Producto</title> 
</head>
<body>
    <div class="login">
<?php
$image = isset($_POST["image"]) ? mb_strtoupper($_POST["image"]) : null;
 $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
 $descripcion = isset($_POST["descripcion"]) ? mb_strtoupper(trim($_POST["descripcion"]), 'UTF-8') : null;
 $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : null;


 $sql = "INSERT INTO producto VALUES (0,'$nombre','$descripcion', $precio,'N',null, null)";

 if ($conn->query($sql) === TRUE) {
 echo "<p>Se ha añadido un producto al inventario!!!</p>";
 } else {
 if($conn->errno == 1062){
 echo "<p class='error'>La persona con la cedula $nombre ya esta registrada en el sistema </p>";
 }else{
 echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
 }
 }

 //cerrar la base de datos
 $conn->close();
 echo "<a href='index.php'> Regresar </a>";

 ?>
 </div>
</body>
</html>