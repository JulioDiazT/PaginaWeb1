
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
 <title>Eliminar Producto </title>
</head>
<body>
<?php
 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php'; 
 $codigo = $_POST["codigo"]; 
 
 //Si voy a eliminar físicamente el registro de la tabla
 //$sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
 date_default_timezone_set("America/Guayaquil");
 $fecha = date('Y-m-d H:i:s', time());
 $sql = "UPDATE pedidos SET estado = 'eliminado' WHERE
codPedido= '$codigo'";
 if ($conn->query($sql) === TRUE) { 
 echo "<p>Se ha eliminado los datos correctamemte!!!</p>"; 
 } else { 
 echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>"; 
 }
 echo "<a  href='../../vista/usuario/consulta.php'> Regresar</a>";
 $conn->close()

 ?>
</body>
</html>