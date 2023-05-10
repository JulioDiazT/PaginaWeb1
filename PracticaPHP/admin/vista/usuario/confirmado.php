
<?php
 
 session_start();
 if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_usuario.html"); 
 }


include '../../../config/conexionBD.php'; 

$SesionUsuario = $_SESSION['usuario'];
 $sqlUsuario= "SELECT codUsuario FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$codUsuario = ($row['codUsuario']);
/*echo $codUsuario;*/

$sqlALTER ="UPDATE pedidos SET estado='confirmado' WHERE codUsuario='$codUsuario'";

 if ($conn->query($sqlALTER) === TRUE) { 
?>


<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">
 <meta charset="UTF-8">
 <title>Confirmar</title>
</head>
<body>
<?php
$SesionUsuario = $_SESSION['usuario'];
$sqlUsuario= "SELECT rol FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$rolUsuario = ($row['rol']);
/*echo  $rolUsuario;*/
?>
<br><?php
$sqlNombre= "SELECT nombres FROM cliente WHERE codUsuario = '$SesionUsuario'";
$resultadoNom =  $conn->query($sqlNombre);
$row=$resultadoNom->fetch_assoc();
$NombreUsuario = ($row['nombres']);
/*echo  $NombreUsuario;*/
   
?>
 </section>
 <br/>
 <section class="detallesdeorden"> 
  <div> 
    <table>
    <tr > <td colspan ="5">
          <h2 class="titulo">GRACIAS <?php echo $NombreUsuario ?></h2>
          <td>
    </tr>
    <tr > <td >
          TU PEDIDO LLEGARÁ EN:
          <td>
    </tr>
    <tr > <td >
          20 MINUTOS 
          <td>
    </tr>
        <tr> 
            <td class="button"> <a href="consulta.php"> REVISAR MIS PEDIDOS  </a> </td>

        </tr>
    <?php       
    ?>
    <tr >
        <td  class="button"> <a href="index.php"> INICIO  </a> </td>
    </tr>
    </table>
 </div>

 <br/>
</section>
</body>
</html>

<?php



}
 ?>