<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";

    $sql = "SELECT model.nombre_modelo, model.miniatura, model.marca, model.precio, tipo.nombre, tipo.imgmin FROM modelos model, tipos tipo WHERE model.id = $_GET[modelo] AND model.tipo = tipo.id";

    try{
        $conexion = Conection::con("proyectodaw");
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $modelo = $stmt->fetchAll();

        foreach($modelo as $row){       
            $nombre_modelo = $row["nombre_modelo"];
            $tipo_nombre = $row["nombre"];
            $marca = $row["marca"];
            $imgmin = base64_encode($row["imgmin"]);
            $precio = $row["precio"];
        }

        $stmt = null;
        $conexion = null;
        
    }catch(PDOException $e){
        echo "Connection failed: ".$e->getMessage();
    }

    // Sumar al precio total el color y los caballos
    $precio_total = $precio + $_GET["color_precio"] + $_GET["caballos_precio"];

?>

<script>
        //Cambiar el color del modelo que aparece en el presupuesto
        var referencia = firebase.database().ref(); 
        var refModelo = referencia.child(<?php echo $_GET["modelo"]; ?>);
        var color_modelo = color.replace("%23","");
        
        var refColor = refModelo.child(color_modelo);
        refColor.on('value', snap=> 
            
            document.getElementById("img-presupuesto-color").src = snap.val()
            
        ); 
</script>

<div class='presupuesto'>
    <div class='d-flex justify-content-between intro-presupuesto row'>
        <h2 class="titulo align-self-end col-sm-6">GetAut<img src="Imagenes/steering-wheel.png" class="img-volante" alt="volante"></h2>
        <div class='col-sm-6 d-flex justify-content-end'>
            <img src='' class='img-presupuesto' id='img-presupuesto-color' alt="miniatura_modelo">
        </div>
    </div>

    <div class='datos-vehiculo-presupuesto mt-4'>
        <h3 class='titulo-presupuesto'>Datos del vehículo</h3>
        <div>
            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Nombre del modelo:</h6>               
                <h6 class='p-1'><?php echo $nombre_modelo; ?></h6>
            </div>
            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Tipo de Motor:</h6>               
                <h6 class='p-1'><?php echo $tipo_nombre; ?><img class='img-tipo-presupuesto ml-2' src='data:image/jpg;base64, <?php echo $imgmin; ?>' alt='img-tipo'></h6>
            </div>
            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Marca:</h6>               
                <h6 class='p-1'><?php echo $marca; ?></h6>
            </div>
            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Precio base:</h6>               
                <h6 class='p-1'><?php echo number_format($precio); ?> €</h6>
            </div>
        </div>                  
    </div>

    <div class='datos-vehiculo-presupuesto mt-5'>
        <h3 class='titulo-presupuesto'>Datos de configuración</h3>
        <div>
            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Color:</h6>  
                <div class='d-flex justify-content-between'>
                    <div class='color' style='background-color:<?php echo $_GET["color"]; ?>;'></div>
                    <h6 class='align-self-center mr-3'><?php echo number_format($_GET["color_precio"],2,',',''); ?> €</h6>
                </div>             
            </div>

            <div class='presupuesto-datos'>
                <h6 class='titulo-presupuesto-dato p-1'>Potencia del motor:</h6>  
                <div class='d-flex justify-content-between'>
                    <h6 class='p-1'><?php echo $_GET["caballos"]; ?></h6>
                    <h6 class='align-self-center mr-3'><?php echo number_format($_GET["caballos_precio"],2,',',''); ?> €</h6>
                </div>             
            </div>

            <?php 
                //Recorrer el número de accesorios y con la variable $i concatenar los strings uno por uno.
                echo "<div class='presupuesto-datos'>
                        <h6 class='titulo-presupuesto-dato p-1'>Accesorios:</h6> "; 
                       
                   
                for($i=1;$i<=8;$i++){
                    if(!empty($_GET["accesorio$i"])){//Si no esta vacío significa que se ha seleccionado ese accesorio, por lo tanto tiene nombre y precio
                        
                        $ac = $_GET["accesorio$i"];
                        $ac_precio = number_format($_GET["accesorio".$i."_precio"],2,',','');

                        echo "<div class='d-flex justify-content-between'>
                                <h6 class='p-1'>$ac</h6>
                                <h6 class='align-self-center mr-3'>$ac_precio €</h6>
                              </div>";
                        // Sumar al precio total los accesorios si existen
                        $precio_total = $precio_total + $_GET["accesorio".$i."_precio"];
                    }
                    
                }

                echo "</div>";

            ?>

        </div>   
        
        <div class='datos-vehiculo-presupuesto mt-5'>
            <h3 class='titulo-presupuesto'>Datos de trámite</h3>
            <div>
                <div class='presupuesto-datos'>
                    <h6 class='titulo-presupuesto-dato p-1'>Forma de pago:</h6>  
                    <div class='d-flex justify-content-between'>
                        <?php 
                            if($_GET["financiacion"] != 1){
                                echo "<h6 class='p-1'>Financiación en $_GET[financiacion] meses</h6>";
                                echo "<h6 class='align-self-center mr-3'>".number_format(($precio_total * $_GET["financiacion_porcentaje"])/$_GET["financiacion"],2,",",".")." €/mes</h6>";//Sacar cuanto pagará por mes preciototal/meses
                            }else{//Si es 1 significa que se dividirá entre 1 porque no esta financiado sino que es pago al contado.
                                echo "<h6 class='p-1'>Pago al contado</h6>";
                            }
                        
                        ?>
                       
                    </div>             
                </div>

                <div class='presupuesto-datos'>
                    <h6 class='titulo-presupuesto-dato p-1'>Precio total:</h6>  
                    <div class='d-flex justify-content-between'>
                        <h6 class='p-1'><?php echo number_format(($precio_total * $_GET["financiacion_porcentaje"]),2,",",".");//Multiplicar el percio final por el porcentaje de financiacion ?> €</h6>
                    </div>             
                </div>
            </div>                  
        </div>

    </div>

    <div class='d-flex justify-content-end'>
        <form action="configurar.php">
            <input type="hidden" name=modelo value="<?php echo $_GET["modelo"]; ?>">
            <input type="button" class='btn mt-3 boton-presupuesto' value="Volver atrás" onclick='Recargar_datos()' id='boton-atras'>
        </form>
        <input type="button" class='btn mt-3 ml-3 boton-presupuesto' value="Generar PDF" onclick="imprimir(this)">
    </div>
    
</div>

