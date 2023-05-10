<!DOCTYPE html>
<html>
<head> 
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="../../config/css/estilos.css">
 <title>Gestión de usuarios</title>
</head>
<body>
<header >
        
        <a href="ingresar.html"> <button id="botonsuperior"> Ingresar </button>   </a> 
</header>
<section id="menu" class="seccionmenu">
      <div class="container" data-aos="fade-up">
      <div class="menu">
          <h2 class="titulo">MENU</h2>
        </div>
 <?php

 include '../../config/conexionBD.php'; 
 $sql = "SELECT * FROM producto WHERE eliminado = 'N' ORDER BY codProducto";
 $result = mysqli_query($conn, $sql);
 
 if (mysqli_num_rows($result)>0) {
 
 while($row = mysqli_fetch_array($result)) {

 ?>
<div> 
    <form >
 <div class="row"> 
   <div class="producto.menu" >
   <img src="<?php $row ["image"]; ?>"/>
       <h4 class="menu-content"> <?php echo $row ["nombre"]; ?></h4>
    <div  class="menu-ingredients"> 
    <h4 class ="text-info"> <?php echo $row ["descripcion"]; ?></h4>
    </div>
    <h4 class="text-danger"> $ <?php echo $row ["precio"]; ?> </h4>
    <input type="text" name="cantidad" class ="form-control" value="1" />
    <input type="hidden" name ="hidden_name" value="<?php echo $row ["nombre"]; ?>"/>
    <input type="hidden" name="hidden_price" value="<?php echo $row ["precio"];?>"/>
    <a href="login_usuario.html">  <img id="carrito"src="../../config/imgs/carrito.png"> </a>
 </div>
 </div>
 </form>
 </div>
 <?php
}
 } else {
    echo "<tr>";
    echo " <td colspan='7'> No existen productos registradas en el sistema </td>";
    echo "</tr>";
    }
   
 $conn->close(); 
 ?>
</section>

</body>
</html>

