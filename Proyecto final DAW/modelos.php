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

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>

<script  type="text/javascript">
    
    $(document).ready(function() {
        /*Variable global para controlar el tipo de modelo*/
        var tipo_global = <?php if(isset($_GET["tipo"])){ echo $_GET["tipo"]; } ?>;

        /*Al iniciar modelos.php se ejecuta esta instrucción solo una vez por inicio*/
        $("#contenido").load('coches.php?tipo=<?php if(isset($_GET["tipo"])){ echo $_GET["tipo"]; } ?>');
        Update_nombre_tipo();

        $("#marcas").val("Todas");//Modificar el filtro a Todas al cargar modelos.php de nuevo.

        ////////////////////////////////////Lo de arriba se ejecuta una vez////////////////////////////////////////////////////////////////

        /*Si se cambia el tipo en el menu se le pasa la marca también para que haga efecto en ese tipo de modelo*/
        $('.opcion').on('click', function() {
            $("#contenido").load('coches.php?tipo='+$(this).attr("name")+'&marca='+$('#marcas').val());
            tipo_global = $(this).attr("name");
            Update_nombre_tipo();
            return false;
        });

        /*Si se cambia el filtro se llama de nuevo a coches.php pasandole el tipo y la marca*/
        $("#marcas").change(function() {
            $("#contenido").load('coches.php?tipo='+tipo_global+'&marca='+$('#marcas').val());
        });

        function Update_nombre_tipo(){//Modificar el nombre que aparece del tipo de modelos
            var capa_texto = document.getElementById("tipomotor");

            if(tipo_global == 1){
                capa_texto.innerHTML = "Gasolina";
            }else if(tipo_global == 2){
                capa_texto.innerHTML = "Diésel";
            }else if(tipo_global == 3){
                capa_texto.innerHTML = "Híbridos";
            }else{
                capa_texto.innerHTML = "Eléctricos";
            }    
        };

    });

    
</script>

<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";
?>

<body>
    <!--modelos.php debe tener un menu diferente a los demás porque se le han añadido name a las opciones del tipo de motor para usarlas en jquery, y ahcer un load de coches.php-->
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
        <h2 class="titulo mr-4">GetAut<img src="Imagenes/steering-wheel.png" class="img-volante" alt="volante"></h2>
        <button class="navbar-toggler" style="background-color: #ED0808" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="enlaceMenu nav-item active">
                    <a class="nav-link text-light enlace-index" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="enlaceMenu nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Modelos
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                        <a class="opcion enlaceMenu dropdown-item bg-dark text-light" name=1 href="" >Gasolina</a>
                        <a class="opcion enlaceMenu dropdown-item bg-dark text-light" name=2 href="" >Diésel</a>
                        <a class="opcion enlaceMenu dropdown-item bg-dark text-light" name=3 href="" >Híbridos</a>
                        <a class="opcion enlaceMenu dropdown-item bg-dark text-light" name=4 href="" >Eléctricos</a>
                    </div>
                </li>
                
                <?php //Si existe una session se crea la opcion del menu Mi cuenta
                    if(isset($_SESSION["id_usuario"])){
                        echo "<li class='nav-item dropdown'>
                            <a class='enlaceMenu nav-link dropdown-toggle text-light' id='navbarDropdownMenuLink2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href='#'>Mi cuenta</a>
                            <div class='dropdown-menu bg-dark' aria-labelledby='navbarDropdownMenuLink2'>
                                <a class='enlaceMenu dropdown-item bg-dark text-light' href='alquileres.php'>Alquileres</a>
                                <a class='enlaceMenu dropdown-item bg-dark text-danger' href='index.php?logout'>Log out</a>
                            </div>
                        </li>";
                    }     
                ?>
                
            </ul>

            <?php //Si no existe una session se crean los botones login y sign in
                if(!isset($_SESSION["id_usuario"])){
                    echo "<form action='login.php'>
                        <button class='btn mr-3 font-weight-bold bt-log' type='submit'>Login</button>
                    </form>

                    <form action='registro.php'>
                        <button class='btn mr-3 font-weight-bold bt-log' type='submit'>Sign in</button>
                    </form>";
                }else{
                    //Crear una capa con el nombre del usuario y un icono
                    echo "<div class='d-flex capa-user-session'>
                            <img src='Imagenes/man-user.png' class='icono-user-session' alt='icono-user'>

                            <h5 class=' mt-2'>Usuario: <span class='text-white font-italic'>$_SESSION[nombre_usuario]</span></h5>                        
                         </div>"; 
                          
                }
            ?>
            
        </div>
    </nav>
    
    <div class="d-flex flex-column">
        <h2 class="mt-3 mr-3 text-center titulo-modelos-tipografia">Modelos <label id="tipomotor"></label></h2>
        <div class="d-flex justify-content-center mr-2">
            <h4 class="mt-3 mr-1 align-self-center">Filtrar por marca:</h4>
            <select id="marcas" class="mt-2 align-self-center">
                <option value="Todas">Todas</option>
                <?php
                   Generar_opciones_marcas();
                ?>
            </select>
        </div>
    </div>

    <div id="contenido">
    </div>

    <?php
       include "./footer.php";
    ?>

</body>
</html>