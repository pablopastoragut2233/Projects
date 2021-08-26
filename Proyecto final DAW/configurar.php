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

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.3/firebase.js"></script>
    
    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyBmC6uhW8cu08H6Q0a7W5ZeLw0qjifSTC0",
            authDomain: "coches-colores.firebaseapp.com",
            databaseURL: "https://coches-colores.firebaseio.com",
            projectId: "coches-colores",
            storageBucket: "coches-colores.appspot.com",
            messagingSenderId: "997402093671",
            appId: "1:997402093671:web:013e171f5fed54390accc2"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>

</head>

<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";

    $sql = "SELECT model.nombre_modelo, model.colores, model.caballos FROM modelos model WHERE model.id = $_GET[modelo]";

    try{
        $conexion = Conection::con("proyectodaw");
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $modelo = $stmt->fetchAll();

        foreach($modelo as $row){       
            $nombre_modelo = $row["nombre_modelo"];
            $colores = $row["colores"];
            $caballos = $row["caballos"];
        }

        $stmt = null;
        $conexion = null;
        
    }catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
    }

      
?>

<script>

    //Variables globales
    var contenido_recargado = "";

    var color = "";
    var color_precio = "";

    var caballos = "";
    var caballos_precio = "";

    var financiacion = "";
    var financiacion_porcentaje = "";

    //Variable para controlar el color negro predeterminado solo una vez
    var predeterminado = false;

    funcionesjquery();//Lamar a las funciones jquery al iniciar el php para que se puedan utilizar
    
    function funcionesjquery(){

        $(document).ready(function() {

            if(predeterminado == false){//Solo lo llamará una vez
                Color_predeterminado_negro();
            }
                
            //COLORES!!!
            $('.colores').click(function(){
                $(this).parent().find('.colores').removeClass('selected');//Quitar la clase a todas las capas al principio
                $(this).addClass('selected');//Añadir la capa de seleccionado a la capa
                
                var precio = $(this).attr('data-value');//Precio del color
                var col =  $(this).css("backgroundColor");//RGB del color
               
                color_precio = precio;
                
                hexc(col);//Convertir el codigo RGB en codigo de color
                Cambiar_color_modelo();
            
            });

            //CABALLOS!!!
            $('.caballos').click(function(){
                $(this).parent().find('.caballos').removeClass('selected-cv');
                $(this).addClass('selected-cv');

                caballos_precio = $(this).attr('data-value');

                cab = $(this).text();//Con espacios
                caballos = encodeURIComponent(cab.trim());//Sustituir los espacios por %20 para pasarlo por URL

                
            });

            //FINANCACION
            $('.financiacion').click(function(){
                $(this).parent().find('.financiacion').removeClass('selected-financiacion');
                $(this).addClass('selected-financiacion');

                financiacion_porcentaje = $(this).attr('data-value');
                financiacion = $(this).find('.porcentaje-finan').attr('data-value');
                
            });

            //Mostrar más accesorios
            $('#button-mostrar-mas').click(function(){
                $('#capa-button-mostrar-mas').css("display","none");
                $(".accesorio-hidden").delay(300).fadeIn();
            });   


            //Mostrar menos accesorios, el boton menos es de la clase accesorio hidden para que al principio se oculte
            $('#button-mostrar-menos').click(function(){
                $(".accesorio-hidden").delay(300).fadeOut();
                $("#capa-button-mostrar-mas").delay(300).fadeIn();
                $('#capa-button-mostrar-menos').css("display","none");
               
            });   

        });

    }

    function hexc(colorval) {
        var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        delete(parts[0]);
        for (var i = 1; i <= 3; ++i) {
            parts[i] = parseInt(parts[i]).toString(16);
            if (parts[i].length == 1) parts[i] = '0' + parts[i];
        }
       
        color = '%23' + parts.join('');  //Poner %23 que equivale a # porque sino da error al pasarlo por url.
       
    }

    function Enviar_resultado(){
       
        if(caballos_precio == "" || financiacion_porcentaje == ''){//Si no se han seleccionado los campos obligatorios
            alert("Faltan datos por elegir");
        }else{
            
            //COMPROBAR ACESSORIOS
            //Usar un bucle en php para repetir las variables de accesorio, $i corresponde al numero del nombre de la variable. Ejemplo accesorio1 es accesorio$i
            <?php 
                for($i = 1; $i <= 8; $i++){//8 es la cantidad de accesorios
                    echo "var checkbox$i = document.getElementById('checked$i').checked;
                        var accesorio"; echo $i; echo "_precio = '';
                        var accesorio$i = '';

                    if(checkbox$i){
                        accesorio"; echo $i; echo "_precio = $('#checked$i').attr('data-value');
                    
                        accesorio$i = encodeURIComponent($('#label$i').text().trim());//Sustituir los espacios por %20 para pasarlo por URL

                    }";
                }
            ?>
           
            contenido_recargado = $("#cuerpo-conf").html();//Guardar el contenido de configuración para poder recargarla cuando se vuelva desde resultado.php
           
            $("#cuerpo-conf").load('resultado.php?color='+color+'&color_precio='+color_precio+'&caballos='+caballos+'&caballos_precio='+caballos_precio+'&accesorio1='+accesorio1+'&accesorio1_precio='+accesorio1_precio+'&accesorio2='+accesorio2+'&accesorio2_precio='+accesorio2_precio+'&accesorio3='+accesorio3+'&accesorio3_precio='+accesorio3_precio+'&accesorio4='+accesorio4+'&accesorio4_precio='+accesorio4_precio+'&accesorio5='+accesorio5+'&accesorio5_precio='+accesorio5_precio+'&accesorio6='+accesorio6+'&accesorio6_precio='+accesorio6_precio+'&accesorio7='+accesorio7+'&accesorio7_precio='+accesorio7_precio+'&accesorio8='+accesorio8+'&accesorio8_precio='+accesorio8_precio+'&financiacion='+financiacion+'&financiacion_porcentaje='+financiacion_porcentaje+'&modelo='+<?php echo $_GET["modelo"]; ?>);
        
            
        }
        
    }

    function imprimir(item){//Los botones desaparecen para que no aparezcan en el pdf
        item.style.display = "none";
        $("#boton-atras").css("display","none");
        $(".pie_pagina").css("display","none");
        window.print();
        item.style.display = "block";
        $(".pie_pagina").css("display","block");
        $("#boton-atras").css("display","block");
    }

    function Recargar_datos(){//Esta función recarga el contenido de configuración anterior con los datos seleccionados y llama de nuevo a las funciones de jquery para que puedan funcionar otra vez
       //alert("recargar_datos");
       document.getElementById("cuerpo-conf").innerHTML = contenido_recargado;
       funcionesjquery();
       
    }

    function Cambiar_color_modelo(){//Conectarse a Firebase y recojer la imagen con el color del modelo correspondiente

        var referencia = firebase.database().ref(); 
        var refModelo = referencia.child(<?php echo $_GET["modelo"]; ?>);
        var color_modelo = color.replace("%23","");//Remplazar el %23 por nada para que solo se quede el codigo de color que será la clave en el Firebase.
        //alert(color_modelo);
        var refColor = refModelo.child(color_modelo);
        refColor.on('value', snap=> 
            
            document.getElementById("img-modelo-configurar").src = snap.val()
            
        ); 

    }

    //Poner el negro como color predeterminado al cargar el documento.
    function Color_predeterminado_negro(){
        var colors = document.getElementsByClassName("colores");
        
        for(var i = 0; i < colors.length; i++){
            if(colors[i].style.backgroundColor == "black"){

                colors[i].classList.add("selected");//Hacer que la capa de color negro este seleccionada visualmente.

                color_precio = colors[i].getAttribute("data-value");//Conseguir el precio del color negro de ese modelo.

                hexc("rgb(0,0,0)");//Pasarle el color rgb correspodiente al negro y darle valor a color.

                Cambiar_color_modelo();
            }
        } 
        
        predeterminado = true;
    }

</script>

<body>
    
    <?php
       include "./menu.php";
    ?>

    <main id='cuerpo-conf'>
        <h2 class='titulo-modelos-tipografia text-center mt-3'>Configurar <?php echo $nombre_modelo; ?></h2>
        <div class='text-center'>
            <img src='' class='img-configurar' id='img-modelo-configurar' alt="">
        </div>

        <div class="opciones-configurar p-1">

                <div class='row'>
                
                    <div class='col-md-6'>
                        <div class='opcion-configurar'>
                            <h4 class='titulo-opcion-conf p-1'>Selecciona el color:</h4>
                                            
                                <div>
                                    <?php echo $colores; ?>
                                </div>                 
                           
                        </div>
                    </div>

                    <div class='col-md-6 mt-md-0 mt-3'>
                        <div class='opcion-configurar'>
                            <h4 class='titulo-opcion-conf p-1'>Selecciona los caballos:</h4>                

                            <div>
                                <?php echo $caballos; ?>
                            </div>

                        </div>
                    </div>

                    <div class='col-md-12 mt-3'>
                        <div class='opcion-configurar'>
                            <h4 class='titulo-opcion-conf p-1'>Selecciona los accesorios (opcional):</h4>                

                            <div class='row m-1'>
                                
                                <div class='col-xl-6'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/bacas.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked1" data-value="260.95">
                                            <label class="custom-control-label m-2 checkbox" for="checked1" id='label1'>Baca para equipaje</label>
                                        </div>

                                    </div>
                                </div>   
                                
                                <div class='col-xl-6'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/llantas.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked2" data-value="885.55">
                                            <label class="custom-control-label m-2 checkbox" for="checked2" id='label2'>Llantas de aleación</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-12 text-center mb-2' id='capa-button-mostrar-mas'>
                                    <button class='btn button-mas-menos' id='button-mostrar-mas'>Mostrar más <img src="Imagenes/down-arrow.png" id='icon-down' alt="icon-down"></button>                          
                                </div>

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/bola.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked3" data-value="320.60">
                                            <label class="custom-control-label m-2 checkbox" for="checked3" id='label3'>Enganche para remolque</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/aleron.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked4" data-value="645.20">
                                            <label class="custom-control-label m-2 checkbox" for="checked4" id='label4'>Alerón</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/tintado.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked5" data-value="310.35">
                                            <label class="custom-control-label m-2 checkbox" for="checked5" id='label5'>Cristales tintados</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/camara.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked6" data-value="400.70">
                                            <label class="custom-control-label m-2 checkbox" for="checked6" id='label6'>Cámara trasera</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/tapiceria.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked7" data-value="1080.10">
                                            <label class="custom-control-label m-2 checkbox" for="checked7" id='label7'>Tapicería de cuero</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-xl-6 accesorio-hidden'>
                                    <div class='accesorio mt-2'>
                                        <img src="Imagenes/gps.jpg" class='w-100 img-accesorio' alt="img-accesorio">
                                          
                                        <div class="custom-control custom-checkbox m-1">
                                            <input type="checkbox" class="custom-control-input" id="checked8" data-value="90.80">
                                            <label class="custom-control-label m-2 checkbox" for="checked8" id='label8'>Sistema GPS</label>
                                        </div>

                                    </div>
                                </div>   

                                <div class='col-12 text-center mb-2 accesorio-hidden' id='capa-button-mostrar-menos'>
                                    <button class='btn button-mas-menos' id='button-mostrar-menos'>Mostrar menos <img src="Imagenes/top.png" id='icon-down' alt="icon-down"></button>                          
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class='col-12 mt-3'>
                        <div class='opcion-configurar'>
                            <h4 class='titulo-opcion-conf p-1'>Selecciona el tipo de financiación o pago al contado:</h4>                
                            <div>
                                <div class='financiacion' data-value="1.05">
                                    <img src="Imagenes/pay.png" class='img-financiacion' alt="img-financia">
                                    <label data-value="12" class='porcentaje-finan mt-2'>Financiar en 1 año</label>
                                </div>

                                <div class='financiacion' data-value="1.10">
                                    <img src="Imagenes/pay.png" class='img-financiacion' alt="img-financia">
                                    <label data-value="36" class='porcentaje-finan mt-2'>Financiar en 3 años</label>
                                </div>
 
                                <div class='financiacion' data-value="1.15">
                                    <img src="Imagenes/pay.png" class='img-financiacion' alt="img-financia">
                                    <label data-value="60" class='porcentaje-finan mt-2'>Financiar en 5 años</label>
                                </div>

                                <br>
                                <hr class='linea-financiacion'>

                                <div class='financiacion mb-3' data-value="1">
                                    <img src="Imagenes/money.png" class='img-financiacion' alt="img-financia">
                                    <label data-value="1" class='porcentaje-finan mt-2'>Pago al contado</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class='text-center'>
                    <button onclick="Enviar_resultado()" class='btn mt-3' id='button-confi'>Presupuesto <img src="Imagenes/next.png" alt="icon-arrow"></button>
                </div>
                    
        </div>
        
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>