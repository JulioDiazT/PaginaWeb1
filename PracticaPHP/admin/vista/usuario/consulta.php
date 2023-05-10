<?php
 
 session_start();
 if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_usuario.html"); 
 }
 include '../../../config/conexionBD.php'; 

 ?>
<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">
 <meta charset="UTF-8">
 <title>Gestión de usuarios</title>
</head>
<body>
<?php

$SesionUsuario = $_SESSION['usuario'];
$sqlUsuario= "SELECT rol FROM usuario WHERE codUsuario ='$SesionUsuario'";  
$resultado = $conn->query($sqlUsuario);
$row=$resultado->fetch_assoc();
$rolUsuario = ($row['rol']);
echo  $rolUsuario;


?>
<a href="../../../config/cerrar_sesion.php"> <button button id="botonsuperior"> Cerrar Sesion </button>  </a>
<a href="index.php"> <button button id="botonsuperior"> INICIO </button>  </a>

 </thead>
 <tbody>
    <div class="login">
 <table>
    <tr>
        <th colspan="5"><h2 class="titulo">MIS PEDIDOS</h2></th>
    </tr>
    <tr> 
        <th > CODIGO PEDIDO </th>
        <th > FECHA Y HORA </th>
  
        <th > TOTAL </th>
        <th colspan="2">ACCION </th>
    </tr>
 <?php

 $sqlPedUsuario = "SELECT * FROM pedidos WHERE codUsuario= '$SesionUsuario' AND estado = 'confirmado' ORDER BY codPedido";
 $resultPedidos = mysqli_query($conn, $sqlPedUsuario);
 
 /*$largo = count($resulta);
 echo $largo;
 
    $sqlDetalles = "SELECT codProducto FROM detallespedido WHERE codPedido = '$pedidoCod'";
    $resultDetalles = mysqli_query($conn,$sqlDetalles);
    $codPro = ["codProducto"];
    $sqlItem = "SELECT nombre FROM producto WHERE codProducto ='$codPro' AND eliminado ='N'";
*/

 if (mysqli_num_rows( $resultPedidos)>0) {
 while($row = mysqli_fetch_array($resultPedidos)) {?>
<tr <?php $numProductos ?>>
   <td> <?php echo $row["codPedido"]; ?> </td>
   
   <?php 
    $pedidoCod = $row['codPedido'];
   
    
    /*
    $nom = ['nombre'];
    if (mysqli_num_rows( $resultadoItem)>0) {
    while($row = mysqli_fetch_array($resultadoItem)) {
    
    /*$codProd = var_dump($codPro);*/
   ?>
   <td> <?php echo $row["fechaHora"]; ?> </td> <?php
   ?>
    
    <td> <?php echo $row["total"]; ?> </td>  
    
        <?php
    echo"<td> <a href='eliminarPedido.php?codigo=" . $row['codPedido'] . "'> Eliminar </a> </td>";
 echo " <td> <a href='cancelarPedido.php?codigo=" . $row['codPedido'] . "'> Cancelar </a> </td>";
?>
 </tr>
 <?php
}
 }

 /*
 ?>
        <tr> 
            <td > <?php echo $row["codPedido"]; ?> </td>
            <td > <?php echo $row["fechaHora"]; ?></td>
            <td > <?php echo $values["preProducto"]; ?> </td>
            <td > <?php echo number_format ($values["cantProducto"] *  $values["preProducto"]); ?> </td>
            <td class="link" > <a  href="index.php?action=delete&codProducto=<?php echo $values ["codigo"];?>">  <img id="quitar" src="../../../config/imgs/quitar.png"></a> </td>
            <td>
        </tr>
    <?php  
     $total  = $total + ($values["cantProducto"] *  $values["preProducto"]);
    ?>
    <tr class="total">
<td  colspan="3"> TOTAL </td>
 <input  type="text" name ="total" value="<?php echo number_format($total , 2); ?>"  />
<td  class="detallescadapedido"><?php echo number_format($total , 2); ?></td>
<td></td>
</tr>
*/
?>
    </table>
</div>
 </div>
</section>
</body>
</html>