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
 <title>Eliminar Producto</title> 
</head>
<body>
    <div class="login">
 <?php
 
 $codigo = $_GET["codigo"];
 $sql = "SELECT * FROM pedidos where codPedido =$codigo";
 
 include '../../../config/conexionBD.php'; 
 
 $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
 
 while($row = $result->fetch_assoc()) {
 ?>
 <form  method="POST" action="../../controladores/usuario/eliminarPedido.php">

 <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
 <label for="nombre">Codigo Pedido (*)</label>
 <input type="text" id="codigo" name="codigo" value="<?php echo $row["codPedido"]; 
?>" disabled/>
 <br>
 <label for="descripcion">Fecha (*)</label>
 <input type="text" id="fecha" name="fecha" value="<?php echo $row["fechaHora"]; 
?>" disabled/>
 <br>
 <label for="direccion">Total (*)</label>
 <input type="text" id="total" name="total" value="<?php echo $row["total"]; 
?>" disabled/>
 
 <input class="button" type="submit" id="eliminar" name="eliminar" value="Eliminar" />
  <button class="button" > <a href="consulta.php"   > CANCELAR </a>  </button>
 </form> 
 <?php
 }
 } else { 
 echo "<p>Ha ocurrido un error inesperado !</p>";
 echo "<p>" . mysqli_error($conn) . "</p>";
 }
 $conn->close(); 
 ?> 
 </div>
</body>
</html>