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

    //Si ya existe una sesión redireccionará a index.php
    if(isset($_SESSION["id_usuario"])){
        header('Location: index.php');
    }
?>

<?php
    if(isset($_POST["submit"])){
        if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
            Comprobar_usuario($_POST["usuario"], $_POST["password"]);
        }
    }
?>

<body>

    <?php
       include "./menu.php";
    ?>

    <main class="container-fluid">
        <div class="d-flex justify-content-center mb-5">
            <form action="login.php" method="post" class="capa-formulario-registro d-flex flex-md-row flex-column mt-4 pb-5 pr-5 pl-5 pt-3 mb-5">

            <div class="mr-md-5 mb-md-0 mb-3 d-flex justify-content-center">
                <img src="Imagenes/man-user.png" id='icono-user' class="align-self-center" alt="man-user">
            </div>

            <div>
                <h2 class='titulo-registro mb-4'>Login</h2>
                <p>Accede a tu cuenta de usuario</p>

                <h5 class='mt-5'>Nombre de usuario:</h5>
                <input type='text' class='input-registro' name='usuario' placeholder='Username'>

                <h5>Contraseña:</h5>
                <input type='password' class='input-registro' name='password' placeholder='password'>

                <div class='text-center'>
                    <input type='submit' class='btn boton-submit-registro' name='submit' value='Acceder'>
                </div>

                <?php
                if(isset($_POST["submit"])){//Generar los mensajes de errores
                    if(empty($_POST["usuario"]) || empty($_POST["password"])){
                        echo "<p class='error mt-3'>No dejes campos vacíos</p>";
                    }else{
                        if(!isset($_SESSION["nombre_usuario"])){
                            echo "<p class='error mt-3'>Contraseña o nombre incorrectos</p>";
                        }
                    }
                }
                ?>
            </div>

            </form>
        </div>
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>