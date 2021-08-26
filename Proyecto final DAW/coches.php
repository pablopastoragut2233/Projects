<?php
    //Incluir la clase para conectarse a la bbdd
    include "./db.php";
    //Incluir las funciones
    include "./funciones.php";
?>


<main class="d-flex justify-content-center">
    <div class="row m-1 modelos-capa">
        <?php
            if(isset($_GET["tipo"])){
                if(isset($_GET["marca"])){
                    Generar_modelos($_GET["tipo"],$_GET["marca"]);//Si se le pasa marca filtra
                }else{
                    Generar_modelos($_GET["tipo"]);//Los muestra todos
                }
                
            }
        ?>
    </div>
</main>


