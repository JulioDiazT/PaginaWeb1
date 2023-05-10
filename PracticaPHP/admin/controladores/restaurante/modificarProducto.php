<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){ 
 header("Location: /SistemaDeGestion/public/vista/login.html"); 
 }
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">

 <title>Modificar datos de persona </title>
</head>
<body>
<?php 
 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php'; 
 $codigo = $_POST["codigo"];

 $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
 $descripcion = isset($_POST["descripcion"]) ? mb_strtoupper(trim($_POST["descripcion"]), 'UTF-8') : null;
 $precio = isset($_POST["precio"]) ? trim($_POST["precio"]): null; 
 
 date_default_timezone_set("America/Guayaquil");
 $fecha = date('Y-m-d H:i:s', time());
 $sql = "UPDATE producto " .
 "SET nombre = ' $nombre', " .
 "descripcion = '$descripcion', " .
 "precio = '$precio', " . 
 
 "fechamodificacion = '$fecha' " .
 "WHERE codProducto = $codigo";
 if ($conn->query($sql) === TRUE) {
 echo "Se ha actualizado los datos del producto correctamemte!!!<br>"; 
 } else { 
 echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>"; 
 }
 echo "<a href='../../vista/restaurante/index.php'>Regresar</a>";
 $conn->close();
?>
</body>
</html>