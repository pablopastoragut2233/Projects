<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./CSS/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <title>Index</title>
</head>

<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";
   
    //Si existe la variable GET precio significa que ha alquilado el vehiculo y se inserta el alquiler en la bbdd con los datos GET.
    if(isset($_GET["precio"])){
        Insertar_alquiler($_GET["provincia"], $_GET["localidad"], $_GET["recogida"], $_GET["entrega"],$_GET["precio"],$_SESSION["id_usuario"],$_GET["modelo"]);
        //Recargar página para que al volver a cargar no se añada de nuevo
        header("Location: alquileres.php");
    }
    
    //Si existe la variable alquiler significa que se quiere eliminar del historial un alquiler ya finalizado.
    if(isset($_GET["alquiler"])){
       Eliminar_alquiler($_GET["alquiler"]);
    }

?>
<body>
    
    <?php
       include "./menu.php";
    ?>

    <main class="container-fluid contenedor-historial">
        <h2 class='titulo-modelos-tipografia text-center mt-3'>Historial de alquileres</h2>
        <?php Generar_alquileres(); ?>
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>