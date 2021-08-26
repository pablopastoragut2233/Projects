<?php
    session_start(); 

    if(isset($_GET["logout"])){
        session_unset();
        session_destroy();
    }
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
?>

<body>

    <?php
       include "./menu.php";
    ?>

    <main>
       <div class="container-fluid p-md-5 p-3">
            
            <h1 class="titulo-principal">Descubre nuevas posibilidades</h1>

            <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
           
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-2" data-slide-to="1"></li>
                    <li data-target="#carousel-example-2" data-slide-to="2"></li>
                </ol>
           
                <div class="carousel-inner" role="listbox">
                    
                    <div class="carousel-item active">
                        <div class="view">
                            <div class="capa-oscura">  
                                <img class="d-block w-100 img-slider" src="Imagenes/drive.jpg"
                                alt="First slide">                     
                            </div>          
                        </div>
                        <div class="carousel-caption text-right h1-md">
                            <h3 class="h3-responsive titulo-slider">Comodidad al volante</h3>
                            <p>Vehículos con control de marchas y maniobrado cómodo.</p>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                   
                        <div class="view">
                            <div class="capa-oscura">  
                                <img class="d-block w-100 img-slider" src="Imagenes/vehiculos.jpg"
                                alt="Second slide">
                            </div>
                        </div>
                        <div class="carousel-caption text-right">
                            <h3 class="h3-responsive titulo-slider">Diferentes modelos</h3>
                            <p>Encuentra tu vehículo entre una gran variedad.</p>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="view">
                            <div class="capa-oscura">  
                                <img class="d-block w-100 img-slider" src="Imagenes/cocheslider.jpg"
                                alt="Third slide">
                            </div>
                        </div>
                        <div class="carousel-caption text-right">
                            <h3 class="h3-responsive titulo-slider">Potencia y velocidad</h3>
                            <p>Siempre preparados para superar cualquier obstáculo</p>
                        </div>
                    </div>
                </div>
            
           
                <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            
            </div>

       </div>
        
        
        <div>
            <h2 class="text-center titulo-ofertas mt-5">Vehículos en oferta</h2>
            <div class="row m-1 d-flex justify-content-center">
                <?php 
                    Generar_ofertas();
                ?>
            </div>
        </div>

        <div class="nosotros p-2">
            <div class="row m-1 d-flex align-items-center">
                
                <div class="col-12 col-md-6">
                    <h2 class="titulo-ofertas">Nuestra empresa</h2>
                    <p>Empresa especializada en alquiler de vehículos, por ahora solo con funcionabilidad en la comunidad valenciana, variedad de marcas y formulario de alquiler flexible. También con opciones de configuración y generador de presupuestos. Regístrate ya en la web y accede a tu pérfil donde podrás llevar un control de tus acciones.</p>
                </div>

                <img class="col-12 col-md-6" src="Imagenes/vendedor.jpg" alt="nosotros">

            </div>

            <?php 
                if(!isset($_SESSION["id_usuario"])){
                    echo "<form action='registro.php' class='m-1 text-center'>
                            <button class='btn font-weight-bold bt-log' type='submit'>Registrarse</button>
                          </form>";
                }
            ?>
            
           
        </div>
      
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>