<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){ 
 header("Location: /SistemaDeGestion/public/vista/login.html"); 
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

 $sql = "UPDATE producto SET eliminado = 'S' WHERE codProducto = $codigo";
 if ($conn->query($sql) === TRUE) { 
 echo "<p>Se ha eliminado los datos correctamemte!!!</p>"; 
 } else { 
 echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>"; 
 }
 echo "<a  href='../../vista/restaurante/index.php'> Regresar</a>";
 $conn->close()

 ?>
</body>
</html>