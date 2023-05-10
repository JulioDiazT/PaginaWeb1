
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
 <title>Cancelar Pedido </title>
</head>
<body>
    <div class="login">
<?php
 //incluir conexión a la base de datos
 include '../../../config/conexionBD.php'; 
 $codigo = $_POST["codigo"]; 
 
 //Si voy a eliminar físicamente el registro de la tabla
 //$sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
 
 $sql = "UPDATE pedidos SET estado = 'cancelado' WHERE
codPedido= '$codigo'";
 if ($conn->query($sql) === TRUE) { 
 echo "<p>Se ha cancelado el pedido </p>"; 
 } else { 
 echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>"; 
 }
 echo "<a  href='../../vista/usuario/consulta.php'> Regresar</a>";
 $conn->close()

 ?>
 </div>
</body>
</html>