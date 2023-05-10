<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_restaurante.html"); 
 }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">

 <meta charset="UTF-8">
 <title>Eliminar Producto</title> 
</head>
<body>
 <?php
 
 $codigo = $_GET["codigo"];
 $sql = "SELECT * FROM producto where codProducto =$codigo";
 
 include '../../../config/conexionBD.php'; 
 
 $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
 
 while($row = $result->fetch_assoc()) {
 ?>
 <form method="POST" action="../../controladores/restaurante/eliminarProducto.php">

 <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
 <label for="nombre">Nombre (*)</label>
 <input type="text" id="nombre" name="nombre" value="<?php echo $row["nombre"]; 
?>" disabled/>
 <br>
 <label for="descripcion">Descripcion (*)</label>
 <input type="text" id="descripcion" name="descripcion" value="<?php echo $row["descripcion"]; 
?>" disabled/>
 <br>
 <label for="direccion">Precio (*)</label>
 <input type="text" id="precio" name="precio" value="<?php echo $row["precio"]; 
?>" disabled/>
 
 <input class="button" type="submit" id="eliminar" name="eliminar" value="Eliminar" />
 <input class="button" type="reset" id="cancelar" name="cancelar" value="Cancelar" />
 </form> 
 <?php
 }
 } else { 
 echo "<p>Ha ocurrido un error inesperado !</p>";
 echo "<p>" . mysqli_error($conn) . "</p>";
 }
 $conn->close(); 
 ?> 
</body>
</html>
