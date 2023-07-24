<?php
 include 'conexion/Databasephp';
$nom=$_REQUEST["txtnom"];
$Fotos=$_FILES["Fotos"]["name"];
$ruta=$_FILES["Fotos"]["tmp_name"];
$destino="Fotos/".$Fotos;
copy($ruta,$destino);
mysqli_query($con,"insert into Fotos (nombre,Fotos) values('$nom','$destino')");
header("Location: indexadm.php");
?>