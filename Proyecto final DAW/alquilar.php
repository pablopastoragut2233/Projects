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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <title>Index</title>

</head>

<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";

    //Si no existe una session se redirecciona a login.php
    if(!isset($_SESSION["id_usuario"])){
        header('Location: login.php');
    }
    
?>
<script>

        var precio_base = <?php //Recoger el precio de alquiler del modelo
                $sql = "SELECT precio_alquiler FROM modelos WHERE id = $_GET[modelo]";

                try{
                    $conexion = Conection::con("proyectodaw");
                    $stmt = $conexion->prepare($sql);
                    $stmt->execute();
                    $modelos = $stmt->fetchAll();
        
                    foreach($modelos as $row){       
                       echo $row["precio_alquiler"];
                    }
        
                    $stmt = null;
                    $conexion = null;
                    
                }catch(PDOException $e){
                    echo "Connection failed: ".$e->getMessage();
                }
            ?>

        $(document).ready(function() {
            update_localidades();//Al iniciar el php que rellene los selects

            //Actualizar la fecha
            var today = new Date();
            today.setDate(today.getDate() + 1);//Poner un dia de antelación
            var date = today.getFullYear()+'-'+ ('0' +(today.getMonth()+1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

            var d = date.toString();

            document.getElementById("recogida").value = d;
            document.getElementById("entrega").value = d;

            calcular_precio();

        });

        function update_localidades(){
            var provincia = document.getElementById("provincias");
        
            update_select(provincia.value);//El value es el id de la provincia en la bbdd
        }

        function update_select(provincia_id){
            //Renderizar localidades.php cada vez que se modifique el select de provincias pasandole el id de provincia
            $("#localidades").load('localidades.php?provincia='+provincia_id);
        }

        function calcular_precio(){

            if(Comprobar_fechas()){
                boton_alquilar.disabled = true;
                document.getElementById("precio").innerHTML = "0";
            }else{
                boton_alquilar.disabled = false;
                //Pasar a tipo Date los valores de los inputs
                var recogida = new Date(document.getElementById("recogida").value);
                var entrega = new Date(document.getElementById("entrega").value);

                //Conocer los dias para calcular el precio total
                const diffTime = Math.abs(entrega - recogida);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                

                //alert(precio_base*diffDays);
                document.getElementById("precio").innerHTML = precio_base*diffDays;
                document.getElementById("input_hidden_precio").value = precio_base*diffDays;//Enviar el precio al value del input name='precio'
            }
            
        }

        function Comprobar_fechas(){
            //1-No se permite que la fecha de entrega sea menor o igual a la de recogida.
            //2-La fecha de recogida no puede ser menor al dia actual.

            var error = false;

            //Comprobar que las fechas no son anteriores al dia actual
            var boton_alquilar = document.getElementById("boton_alquilar");

            var today = new Date();
            today.setDate(today.getDate() + 1);//Poner un dia de antelación
            var date = today.getFullYear()+'-'+ ('0' +(today.getMonth()+1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

            if(document.getElementById("recogida").value < date || document.getElementById("entrega").value <= document.getElementById("recogida").value){
                error = true;
            };
        
            return error;
        }
    
</script>
<body>
    
    <?php
       include "./menu.php";
    ?>
    
    <main class=''>
        <div class="d-flex justify-content-center flex-column contenido-capa-alquiler">
            
            <?php

                $sql = "SELECT * FROM modelos WHERE id = $_GET[modelo]";
         
                try{
                    $conexion = Conection::con("proyectodaw");
                    $stmt = $conexion->prepare($sql);
                    $stmt->execute();
                    $model = $stmt->fetchAll();
         
                    foreach($model as $row){
                        $nombre = $row["nombre_modelo"];
                        $imagen = base64_encode($row["miniatura2_modelo"]);
                        $precio_alquiler = $row["precio_alquiler"];
                        $info_alquiler = $row["info_alquiler"];

                        Generar_capa_alquiler($nombre,$imagen,$_GET["modelo"],$precio_alquiler,$info_alquiler);
                        
                    }
         
                    $stmt = null;
                    $conexion = null;
                     
                }catch(PDOException $e){
                    echo "Connection failed: ".$e->getMessage();
                }

            ?>
        </div>
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>