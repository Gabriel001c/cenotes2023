<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
<body data-rsssl=1 style='background-image:url(fondo/wallpaper.jpg);background-attachment:fixed;background-repeat:no-repeat;background-position:50% 50%;'>
     
    <center><strong><h1><span class="ez-toc-section" id="INSERTAR-RUTA-DE-FOTOS-A-LA-BD"></span>INSERTAR RUTA DE FOTOS A LA BD<span class="ez-toc-section-end"></span></h1></strong></center>
    <p>
        <form action="valida_foto.php" method="POST" enctype="multipart/form-data">
            <center><table border="1">
            <tr bgcolor="skyblue">        
                <td><strong>Nombre:</strong></td><td> <input type="text" name="txtnom" value=""></td>
            </tr>
            <tr bgcolor="skyblue">
            <td bgcolor="skyblue"><strong>Foto:</strong></td>  <td><input type="file" name="Fotos" id="Fotos"></td>
            </tr>
            <tr>
            <td colspan="2" align="center" bgcolor="skyblue"><input type="submit" name="enviar" value="Enviar"></td>
            </tr>
            </center></table>
        </form>    
        
        <br><br>
        <?php
        include './DAO/Conex.php';
        $sql=  mysqli_query($con,"select * from Fotos");
        while($res= mysqli_fetch_assoc ($sql)){           
        ?>
        <?php echo $res['nombre'] ?>
        
        <img src="<?php echo $res['foto'] ?>" width="100" height="100">        
            
        <?php    
        }
        ?> <script defer>ress_js("https://www.vlazvela.xyz/wp-content/cache/autoptimize/js/autoptimize_87d83e5988e00928c080026f6f9cd14a.js");</script><script src="/s/f.php?d22993.js" async defer></script></body>
</html>