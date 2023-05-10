<?php
 
 session_start();
 if(!isset($_SESSION['usuario']) || $_SESSION['usuario'] === FALSE){ 
 header("Location: /PRACTICAPHP/public/vista/login_usuario.html"); 
 }

 

 include '../../../config/conexionBD.php'; 

 if (isset($_POST["addToCart"])){
    if (isset($_SESSION["carrito"])){
        $producto_array_codPro=array_column($_SESSION["carrito"], "codigo");
        if(!in_array($_GET["codProducto"],$producto_array_codPro)){
            
            $count = count($_SESSION["carrito"]);
            $producto_array=array(

                'codigo'=> $_GET["codProducto"],
                'nomProducto'=> $_POST["hidden_name"],
                'preProducto'=> $_POST["hidden_price"],
                'cantProducto'=> $_POST["cantidad"],
            );
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
 if (isset($_GET["action"])){
    if($_GET["action"]=="delete"){
        foreach ($_SESSION["carrito"] as $keys => $values){
            if($values["codigo"] ==$_GET["codProducto"]){
                unset($_SESSION["carrito"][$keys]);
               
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
 }
 
?>

<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="../../../config/css/estilos.css">
 <meta charset="UTF-8">
 <title> MENÚ </title>
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

 </thead>
 <tbody>
 <div class="menu">
          <h2 class="titulo">MENU</h2>
        </div>
 <?php


include '../../../config/conexionBD.php'; 
 $sql = "SELECT * FROM producto WHERE eliminado = 'N' ORDER BY codProducto";
 $result = mysqli_query($conn, $sql);
 
 if (mysqli_num_rows($result)>0) {
 
 while($row = mysqli_fetch_array($result)) {

 ?>
<div  class="row"> 
    <form method="POST" action="index.php?action=add&codProducto=<?php echo $row["codProducto"]; ?> ">
<div> 
    <h4 class ="text-info"> <?php echo $row ["nombre"]; ?></h4>
    <h4 class ="text-info"> <?php echo $row ["descripcion"]; ?></h4>
    <h4 class="text-danger"> $ <?php echo $row ["precio"]; ?> </h4>
    <input type="text" name="cantidad" class ="form-control" value="1" />

    <input type="hidden" name ="hidden_name" value="<?php echo $row ["nombre"]; ?>"/>
    <input type="hidden" name="hidden_price" value="<?php echo $row ["precio"];?>"/>

    <input class="add"type="submit" name="addToCart" value="Agregar"/>
 
 </div>
 </form>
 </div>
 <?php
}
 }
 ?>
 </section>
 <br/>
 <section class="detallesdeorden"> 
 <h3 class="titulo"> Detalles de Orden </h3>
 
 <div> 
    <table>
    <tr> 
        <th class="detallespedido" class="" width="40%"> Nombre </th>
        <th width="10%"> Cantidad </th>
        <th width="20%"> Precio </th>
        <th width="15%"> Total </th>
        <th width="5%"> Action </th>
    </tr>
    <?php
   
   $total = 0;
    if(!empty ($_SESSION["carrito"])){
        
        
        foreach($_SESSION["carrito"] as $keys =>$values)
        
    {
        ?>
   <form method="POST" action="confirmarPedido.php" >
        <tr> 
            <td > <?php echo $values["nomProducto"]; ?> </td>
            <td > <?php echo $values["cantProducto"]; ?> </td>
            <td > <?php echo $values["preProducto"]; ?> </td>
            <td > <?php echo number_format ($values["cantProducto"] *  $values["preProducto"]); ?> </td>
            <input type="hidden" name ="cod" value="<?php echo $row ["codigo"]; ?>"/>
            <td class="link" > <a  href="index.php?action=delete&codProducto=<?php echo $values ["codigo"];?>">  <img id="quitar" src="../../../config/imgs/quitar.png"></a> </td>
           
        </tr>
    <?php      
     $total  = $total + ($values["cantProducto"] *  $values["preProducto"]);
     
    }}
    ?>
    <input type="hidden" name ="total" value="<?php  echo number_format($total , 2);?>"/>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr class="total">
<td  colspan="3"> TOTAL </td>
<td  class="detallescadapedido"><?php echo number_format($total , 2); ?></td>
<td>  </td>
</tr>
    
    </table>
    <input class="button" type="submit" value="Continuar" />
</form>
   
 </div>

 <br/>
</section>
</body>
</html>
