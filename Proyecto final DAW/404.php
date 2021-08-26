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
    <title>404 page</title>
</head>

<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";
?>

<body>

    <?php
       include "./menu.php";
    ?>

    <main class="text-center container-fluid mb-5">
        <div class="d-flex justify-content-center">
            <label class='number4'>4</label>
            <img src="Imagenes/steering-wheel.png" class="align-self-center" id='volante404' alt="volante">
            <label class='number4'>4</label>
        </div>

        <div>
            <p id='texto404'>Vaya parece que has sufrido un accidente . . . </p>
        </div>

        <div>
            <img src="Imagenes/mcqueen.png" id='img404' alt="cars">
        </div>
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>