<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";
    
    //Llamar a funcion que reciba el id de provincia y devuelva las opciones de lcoalidades correspondientes
    Generar_localidades_options($_GET["provincia"]);
     
?>
