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
?>
<body>
    
    <?php
       include "./menu.php";
    ?>

    <main>
        <?php
            if(isset($_GET["modelo"])){

                $modelo_id = $_GET["modelo"];

                $sql = "SELECT model.*, tipo.nombre, tipo.imagen_tipo, tipo.imagen_tipo2, tipo.info_tipo, tipo.info_tipo2 FROM modelos model, tipos tipo WHERE model.id = $modelo_id AND model.tipo = tipo.id";

                try{
                    $conexion = Conection::con("proyectodaw");
                    $stmt = $conexion->prepare($sql);
                    $stmt->execute();
                    $modelo = $stmt->fetchAll();
        
                    foreach($modelo as $row){
                        $img = base64_encode($row["imagen"]);
                        $nombre = $row["nombre_modelo"];
                        $info = $row["info"];
                        $marca = $row["marca"];
                        $precio = number_format($row["precio"]);
                        $tipo_nombre = $row["nombre"];
                        $diseño = $row["diseño"];
                        $tipo = $row["tipo"];
                        $tipo_imagen = base64_encode($row["imagen_tipo"]);
                        $tipo_imagen2 = base64_encode($row["imagen_tipo2"]);
                        $tipo_info = $row["info_tipo"];
                        $tipo_info2 = $row["info_tipo2"];
                        
                        //Llamar a los metodos que generen los contenidos del modelo por separado.
                        Generar_Modelo_introduccion($img,$nombre,$marca,$precio,$tipo_nombre,$diseño);
                        Generar_info_Modelo($info);
                        Generar_tipo_motor($tipo,$tipo_nombre,$tipo_imagen,$tipo_imagen2,$tipo_info,$tipo_info2);
                        Generar_botones_modelo($modelo_id);
                    }
        
                    $stmt = null;
                    $conexion = null;
                    
                }catch(PDOException $e){
                    echo "Connection failed: ".$e->getMessage();
                }
            
            }
             
        ?>
    </main>

    <?php
       include "./footer.php";
    ?>

</body>
</html>