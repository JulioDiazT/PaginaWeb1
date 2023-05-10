<?php

 session_start();
 if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_usuario.html"); 
 
 }

 include '../../../config/conexionBD.php';
 date_default_timezone_set("America/Guayaquil");
 $fecha = date('Y-m-d H:i:s', time());


 $SesionUsuario = $_SESSION['usuario'];
 $sqlUsuario= "SELECT rol FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$rolUsuario = ($row['rol']); ?> <br> <?php
/* echo $rolUsuario; ?> <br> <?php */

if($rolUsuario !=3){
    header("Location:/PRACTICAPHP/admin/vista/usuario/registroCliente.html");
}
/*
 $precio = $_GET["precio"];
 $cantidad = isset($_POST["cantidad"]) ? (trim($_POST["cantidad"])) : null;
 $totalProducto = isset($_POST["totalproducto"]) ? trim($_POST["totalproducto"]) : null;
 $codigoProducto = isset($_POST["cod"]) ? (trim($_POST["cod"])) : null;
 
 
if (isset($_POST["addToCart"])){
if (isset($_SESSION["carrito"])){
    $producto_array_codPro=array_column($_SESSION["carrito"], "codigo");
    if(!in_array($_GET["codProducto"],$producto_array_codPro)){
        
        $count = count($_SESSION["carrito"]);
        $producto_array=array(
            'codigo'=> $_GET["codProducto"],
            'nomProducto'=> $_POST["hidden_name"],
            'preProducto'=> $_POST["hidden_price"],
            'cantProducto'=> $_POST["cantidad"],);
        $_SESSION["carrito"][$count]=$producto_array; 
    }
 else
 {
    echo '<script> window.location="index.php"</script>';
 }
}
else
{
    $producto_array = array(
        
        'codigo'=> $_GET["codProducto"],
        'nomProducto'=> $_POST["hidden_name"],
        'preProducto'=> $_POST["hidden_price"],
        'cantProducto'=> $_POST["cantidad"],
    );
    $_SESSION["carrito"][0]=$producto_array;
}
}
*/


?>
<br>
<?php
$count = count($_SESSION["carrito"]);

/*echo $count;*/

$subtotal = $_POST["total"];
 echo $subtotal; 
$iva = "1.12"; ?> <br> <?php
/*echo $iva;*/
$totalPedido=$subtotal*$iva; ?> <br> <?php
/*echo $total;*/


$SesionUsuario = $_SESSION['usuario'];
$sqlUsuario= "SELECT codUsuario FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$codUsuario = ($row['codUsuario']);   ?> <br> <?php
/* echo $codUsuario; */

$sqlPedido = "INSERT INTO pedidos VALUES (0, '$fecha', '$subtotal','$iva','$totalPedido','$codUsuario','no confirmado')";
if ($conn->query($sqlPedido) === TRUE) {  
}

$SesionUsuario= $_SESSION['usuario'];
$sqlUsuario= "SELECT codPedido FROM pedidos WHERE codUsuario =' $SesionUsuario' AND fechaHora ='$fecha'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$codigoPedido = ($row['codPedido']);

/* echo $codigoPedido; */ 

/*
for( $x = 0; $x==$count;$x++){

    echo $count;
*/
?> <br> <?php
    $producto_array =  $_SESSION["carrito"];
    $count2= count($producto_array);
    /*echo $count2;/*
    var_dump ($producto_array);/*
    echo $producto_array;
*/
/*
    for($b=0;$b<$count2;$b++){

        $codigo= $producto_array[1]['codPedido'];
        $nombre= $producto_array[2];
        $precio= $producto_array[3];
        $cantidad = $producto_array[4];

        echo $codigo;
        echo $nombre;
    }
*/
 ?> <br> <?php
     for($a=0, $size =count($producto_array);$a<$size;++$a){
        $producto_array_codPro = ($producto_array[$a]);
       /* var_dump ($producto_array_codPro);*/
        $codigProducto= $producto_array_codPro ['codigo'];
        $precio= $producto_array_codPro ['preProducto'];
        $cantidad= $producto_array_codPro ['cantProducto'];
        $codigo = filter_var($codigProducto);
        /*echo $codigo;?>
        <br><?php
        echo $precio; ?>
        <br><?php
        echo $cantidad;?>
        <br><?php*/
        $subtotal = $precio * $cantidad;/*
        echo $subtotal;*/
    $sqldetalles = "INSERT INTO detallespedido VALUES (0,' $codigo','$precio', '$cantidad','$subtotal','$codigoPedido')";
        if ($conn->query($sqldetalles) === TRUE) {
 }
     }
    
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
    <tr > <td colspan="2">
          <h2 class="titulo">HOLA <?php echo $NombreUsuario ?></h2>
          <td>
    </tr>
    <tr > <td colspan="2">
          <h4 >TU DETALLE DE ORDEN ES:</h4>
          <td>
    </tr>
    <?php
   
   $total = 0;
    if(!empty ($_SESSION["carrito"])){
        foreach($_SESSION["carrito"] as $keys =>$values)
    {
        ?>
   <form method="GET" action="confirmarPedido.php" >
   
        <tr> 
            <td class="detallescadapedido"> <?php echo $values["cantProducto"]; ?> </td>
            <td > <?php echo $values["nomProducto"]; ?> </td>
        </tr>
    <?php       
    
    }}
    ?>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr class="total">
<td  colspan="3"> TOTAL A PAGAR  </td>
<td  class="detallescadapedido"><?php echo number_format($totalPedido , 2);?></td>

<td></td>
</tr>
    </table>
    <br>
    <a class="button" href="confirmado.php"> CONFIRMAR</a>
   
</form>
   
  
 </div>

 <br/>
</section>
</body>
</html>

