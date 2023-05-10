<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../config/css/estilos.css">
 <meta charset="UTF-8">
 <title>Ingresar</title>
 <style type="text/css" rel="stylesheet">
  
 .error{
 color: red;
 }
 </style>
</head>
<body>
 <?php
  session_start();
 //incluir conexión a la base de datos



 include '../../config/conexionBD.php';

 $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

 $sql = "SELECT * FROM usuario WHERE correo = '$usuario' and contraseña =  MD5('$contrasena')";

 $result = $conn->query($sql);
 $rows =$result->num_rows;

 if ($rows > 0) {
  $row = $result->fetch_assoc();
  
 $_SESSION['usuario'] = $row['codUsuario'];
 
 header("Location: ../../admin/vista/usuario/index.php");
 }  
$sql2 ="SELECT * FROM usuario WHERE correo = '$usuario' and contraseña <> MD5('$contrasena')";
$resultado = $conn->query($sql2);
    if($resultado->num_rows>0){
      echo "<p class='error'> Contraseña incorrecta </p>";
    }
    else{
      
      $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
      $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;
      $sql = "INSERT INTO usuario VALUES (0,'$correo', MD5('$contrasena'), '2','N', null, null)";
      
      if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM usuario WHERE correo = '$usuario' and contraseña =  MD5('$contrasena')";

        $result = $conn->query($sql);
        $rows =$result->num_rows;

        if ($rows > 0) {
        $row = $result->fetch_assoc();
  
        $_SESSION['usuario'] = $row['codUsuario'];
 
        header("Location: ../../admin/vista/usuario/index.php");
         }
      }
      
    }
 

 $conn->close();
  
 

 ?>
</body>
</html>