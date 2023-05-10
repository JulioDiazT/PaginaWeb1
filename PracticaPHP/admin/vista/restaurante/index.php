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
 <title>Gestión de usuarios</title>
</head>
<body>
<div class="link">
<a href='../../../config/cerrar_sesionRest.php' id ="botonsuperior"> Cerrar Sesion </a>
</div>

<div class="menu">
          <h2 class="tituloProductos">LISTA PRODUCTOS</h2>
        </div>
<table style="width:100%">

 <tr>
 <th class="campo" >Nombre</th>
 <th class="campo"> Descripcion</th>
 <th class="campo">Precio</th>
 <th class="campo"> Opciones </th>

 </tr>

 <?php

 include '../../../config/conexionBD.php'; 

 $sql = "SELECT * FROM producto WHERE eliminado ='N'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 echo " <td>" . $row['nombre'] . "</td>"; 
 echo " <td>" . $row['descripcion'] . "</td>"; 
 echo " <td>" . $row['precio'] . "</td>"; 
 echo " <td> <a href='eliminarProducto.php?codigo=" . $row['codProducto'] . "'> Eliminar </a> </td>";
 echo " <td> <a href='modificarProducto.php?codigo=" . $row['codProducto'] . "'> Modificar </a> </td>";
 echo "</tr>";
 }
 } else {
 echo "<tr>";
 echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
 echo "</tr>";
 }
 $conn->close(); 
 ?>
 <th colspan =3 ><a href="agregarProducto.html" class ="AddProducto"> Agregar Producto</a> </th> </tr>

 </table> 
</body>
</html>