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
<body>
    
    <?php
       include "./menu.php";
    ?>

    <main class="container-fluid">
        <div class="d-flex justify-content-center">
            <form action="registro.php" method="post" class="capa-formulario-registro mt-4 pb-5 pr-5 pl-5 pt-3">
                <?php

                    if(isset($_POST["submit"])){//Si se ha producido un submit se comprueban las variables Post
                        if(!empty($_POST["usuario"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password2"])){
                            
                            if($_POST["password"] == $_POST["password2"]){
                                /*Si esta todo correcto se inserta el usuario en la bbdd y se genera una capa informativa*/
                                Insertar_usuario($_POST["usuario"], $_POST["email"], $_POST["password"]);
                                Generar_capa_registrado($_POST["usuario"]);
          
                            }else{//Si las contraseñas no coinciden da error
                                Generar_inputs_formulario();//Llamar a los inputs del formulario si da error
                                echo "<p class='error mt-3'>Las contraseñas no son iguales</p>";
                            }

                        }else{//Si alguna esta vacía da error
                            Generar_inputs_formulario();//Llamar a los inputs del formulario si da error
                            echo "<p class='error mt-3'>No dejes campos vacíos</p>";
                        }
                    }else{//Llamar a los inputs si no se ha producido un submit al principio
                        Generar_inputs_formulario();
                    }

                    
                ?>
            </form>
        </div>
    </main>
    
    <?php
       include "./footer.php";
    ?>

</body>
</html>