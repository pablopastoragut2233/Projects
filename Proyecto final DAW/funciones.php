<?php

    function Generar_ofertas(){//Recorrer las ofertas
        $sql = "SELECT model.nombre_modelo, model.imagen, model.id, of.info FROM modelos model, ofertas of WHERE of.modelo=model.id";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $ofertas = $stmt->fetchAll();
            
            foreach($ofertas as $row){
                $nombre = $row["nombre_modelo"];
                $imagen = base64_encode($row["imagen"]);//Descodificar los bytes del tipo Blob
                $info = $row["info"];
                $modelo_id= $row["id"];
               
                echo "<div class='col-12 col-md-6 p-4 d-flex justify-content-around'>
                        <div class='carta-oferta'>
                            <a class='enlace-oferta' href='modelo.php?modelo=$modelo_id'>
                                <img class='img-oferta card-img-top' src='data:image/jpg;base64, $imagen' alt=''>
                                <div class='card-body tipografia-modelos'>
                                    <h5 class='card-title'>$nombre</h5>
                                    <p class='card-text'>$info</p>
                                </div>
                            </a>
                        </div>
                    </div>";
                
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }

    function Generar_modelos($tipo,$marca=null){//Generar los modelos segun el tipo de motor y pasar id a los form de configurar y alquilar
        
        //Si no es null y marca no es igual a Todas entonces se le esta pasando un filtro de una marca
        if($marca!=null && $marca!= "Todas"){
            $sql = "SELECT model.id ,model.nombre_modelo, model.precio, model.miniatura, tipo.imgmin FROM modelos model, tipos tipo WHERE model.tipo=$tipo AND model.marca='$marca' AND model.tipo = tipo.id";
        }else{
            $sql = "SELECT model.id ,model.nombre_modelo, model.precio, model.miniatura, tipo.imgmin FROM modelos model, tipos tipo WHERE model.tipo=$tipo AND model.tipo=tipo.id";
        }

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $tipos = $stmt->fetchAll();
            
            foreach($tipos as $row){
                $id = $row["id"];
                $nombre = $row["nombre_modelo"];
                $miniatura = base64_encode($row["miniatura"]);
                $precio = number_format($row["precio"]);
                
                $imgmin = base64_encode($row["imgmin"]);

                echo "<div class='mt-4 col-xl-3 col-md-4 col-sm-6 col-12 d-flex justify-content-around'>
                        <div class='carta-modelo'>
                            <img class='img-tipo' src='data:image/jpg;base64, $imgmin' alt=''>
                            <div class='img-capa-modelo'>
                                <a href='modelo.php?modelo=$id'><img class='img-modelo card-img-top' src='data:image/jpg;base64, $miniatura' alt='minmodel'></a>
                            </div>
                            <div class='card-body carta-cuerpo'>
                                <h5 class='card-title tipografia-modelos carta-titulo'>$nombre</h5>
                                <p class='font-italic tipografia-modelos font-weight-bold card-text'>Desde $precio €</p>
                                <div class='d-flex'>
                                    <form class='mr-1' action='configurar.php'>
                                        <input type='hidden' name='modelo' value=$id>
                                        <input type='submit' class='btn botones-modelo' value='Configurar'>
                                    </form>
                                    
                                    <form action='alquilar.php'>
                                        <input type='hidden' name='modelo' value=$id>
                                        <input type='submit' class='btn botones-modelo' value='Alquilar'>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>";
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }

    function Generar_opciones_marcas(){//Generar las marcas comom options del select filtrar.

        $sql = "SELECT DISTINCT model.marca FROM modelos model ";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $marcas = $stmt->fetchAll();

            foreach($marcas as $row){
                $marca = $row["marca"];
                echo "<option value='$marca'>$marca</option>";
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }

    function Generar_Modelo_introduccion($img,$nombre,$marca,$precio,$tipo_nombre,$diseño){//El $diseño son li que se guardan en la bbdd como Texto

        echo "
            <div class='row m-0'>

                <div class=' col-12 col-xl-6 capa-img-modelo-individual p-2'>
                    <img class='img-modelo-individual' src='data:image/jpg;base64, $img' alt='imgmodelo'>
                    <div class='nombre-modelo-individual'>
                        <h1>$nombre</h1>
                    </div>
                </div>

                <div class=' col-12 col-xl-6 capa-info-modelo-individual p-1 d-flex align-items-center justify-content-center'>
                    <div class='w-100 row'>

                        <div class='col-12 col-md-6'>
                            <div>
                                <div class='detalles-modelo'>
                                    <h2 class='ml-2'>Detalles</h2>
                                </div>
                                <ul class='detalles-lista'>
                                    <li><label class='detalles-titulos'>Modelo:</label> $nombre</li>
                                    <li><label class='detalles-titulos'>Marca:</label> $marca </li>
                                    <li><label class='detalles-titulos'>Precio:</label> Desde $precio €</li>
                                    <li><label class='detalles-titulos'>Motor: </label> $tipo_nombre</li>
                                </ul>
                            </div>
                        </div>

                        <div class='col-12 col-md-6 mt-5 mt-md-0'>
                            <div>
                                <div class='detalles-modelo'>
                                    <h2 class='ml-2'>Diseño</h2>
                                </div>
                                <ul class='detalles-lista' id='diseño-lista'>
                                    $diseño
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <p class='ml-3'></p>

            </div>";
            
    }

    function Generar_info_Modelo($info){
        echo "<div class='info-modelo-individual m-1 p-3 ml-xl-3 mr-xl-3'>
                <div class='detalles-modelo'>
                    <h2 class='ml-2'>Análisis</h2>
                </div>
                <div class='capa-analisis-modelo'>
                    <p>$info</p>
                </div>      
            </div>";
    }

    function Generar_tipo_motor($tipo,$tipo_nombre,$tipo_imagen,$tipo_imagen2,$tipo_info,$tipo_info2){
        echo "<div class='mt-4 info-motor-modelo p-3'>

                <div class='titulo-motor-modelo'>
                    <h2 class='ml-2'>Motor $tipo_nombre</h2>
                </div>

                <div class='row m-1 d-flex justify-content-center'>

                    <div class='col-12 col-md-6 col-xl-5 mt-3'>
                        <img class='img-modelo-tipo-motor' src='data:image/jpg;base64, $tipo_imagen' alt=''>
                        <ul class='lista-motor-info'>
                           $tipo_info
                        </ul>
                    </div>

                    <div class='col-12 col-md-6 col-xl-5 mt-3'>
                        <img class='img-modelo-tipo-motor' src='data:image/jpg;base64, $tipo_imagen2' alt=''>
                        <ul class='lista-motor-info'>
                            $tipo_info2
                        </ul>
                    </div>

                   
                </div>
                
              </div>";
     
    }

    function Generar_botones_modelo($modelo_id){
        echo "<div class='row m-1 d-flex justify-content-center mt-5'>

                <div class='col-10 col-sm-6 col-md-5 col-lg-4 m-3 d-flex justify-content-center'>
                    <div class='capa-botones-modelo-individual'>
                        <div class='text-center'>
                            <img src='Imagenes/car.png' alt='icono-configurar'>
                        </div>

                        <form action='Configurar.php'>
                            <input type='hidden' name='modelo' value=$modelo_id>
                            <input type='submit' class='btn botones-modelo-individual mt-2' value='Configurar'>
                        </form>

                    </div>
                </div>  

                <div class='col-10 col-sm-6 col-md-5 col-lg-4 m-3 d-flex justify-content-center'>
                    <div class='capa-botones-modelo-individual'>
                        <div class='text-center'>
                            <img src='Imagenes/car-rental.png' alt='icono-configurar'>
                        </div>
                        
                        <form action='Alquilar.php'>
                            <input type='hidden' name='modelo' value=$modelo_id>
                            <input type='submit' class='btn botones-modelo-individual mt-2' value='Alquilar'>
                        </form>
                
                    </div>
                </div>   

              </div>";
              
    }

    function Insertar_usuario($usuario,$email,$password){

        //Encriptar con blowfish
        $pwd = crypt($password,'$2a$07$passwordusuarioconsalt');

        $sql = "INSERT INTO usuarios (nombre_usuario,email_usuario,password_usuario) VALUES ('$usuario', '$email', '$pwd')";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $stmt = null;
            $conexion = null;

        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }  
        
    }

    function Generar_inputs_formulario(){
        echo " <h2 class='titulo-registro mb-4'>Registro</h2>
        <p>Regístrate para poder acceder a tus alquileres y comenzar ha alquilar vehículos.</p>
        
        <h5 class='mt-5'>Nombre de usuario:</h5>
        <input type='text' class='input-registro' name='usuario' placeholder='Username'>

        <h5>Email:</h5>
        <input type='text' class='input-registro' name='email' placeholder='email@gmail.com'>

        <h5>Contraseña:</h5>
        <input type='password' class='input-registro' name='password' placeholder='password'>
        
        <h5>Repita contraseña:</h5>
        <input type='password' class='input-registro' name='password2' placeholder='password'>

        <div class='text-center'>
            <input type='submit' class='btn boton-submit-registro' name='submit' value='Registrarse'>
        </div>";
    }

    function Generar_capa_registrado($usuario){
        echo "<div class='mt-3'>
            <h2 class='titulo-registro'>Registrado con éxito</h2>
            <p>Ya puedes acceder a tu cuenta con tu usuario: $usuario</p>
            <p class='text-center'><a href='login.php' class='enlace-login'>Hacer Login</a><img src='Imagenes/arrow.png' class='icono-login-arrow' alt='icono-arrow'></p>
            </div>";
    }

    function Comprobar_usuario($usuario,$password){//Comprobar si existe un usuario con ese nombre y esa contraseña

        $pwod = crypt($password,'$2a$07$passwordusuarioconsalt');

        $sql = "SELECT id_usuario, nombre_usuario FROM usuarios WHERE nombre_usuario = '$usuario' AND password_usuario = '$pwod'";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll();

            foreach($usuarios as $row){//Se entiende que solo hay un usuario
                
                if($usuarios){//Si existe ese usuario se crea una session

                    $_SESSION["id_usuario"] = $row["id_usuario"];
                    $_SESSION["nombre_usuario"] = $row["nombre_usuario"];

                    header('Location: index.php');

                }
                
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }

    function Generar_capa_alquiler($nombre,$imagen,$id_modelo,$precio_alquiler,$info_alquiler){

        echo "<div class='capa-imagen-alquiler'>
                <img src='Imagenes/paisaje.jpg' alt='img_alquiler'>
              </div>
              
              <div class='row capa-alquiler m-1 justify-content-center'>

                <div class='col-md-10 col-lg-6 col-xl-5 capa-proceso-alquiler'>

                    <form action='alquileres.php?' class='formulario-alquiler'>
                        <h3 class='m-2'>Proceso de alquiler</h3>

                        <div class='m-4'>
                            <label class='input-titulo-alquiler mr-2'>Provincia: </label> 
                            <select class='input-alquiler' name='provincia' onchange='update_localidades(item)' id='provincias'>";

                                //Generar el select con las provincias de la bbdd en forma de options
                                $sql = "SELECT * FROM provincias";

                                try{
                                    $conexion = Conection::con("proyectodaw");
                                    $stmt = $conexion->prepare($sql);
                                    $stmt->execute();
                                    $provincias = $stmt->fetchAll();
                        
                                    foreach($provincias as $row){       
                                        $id_provincia = $row["id_provincia"];
                                        $nombre_provincia = $row["nombre_provincia"];
                        
                                        echo "<option value='$id_provincia'>$nombre_provincia</option>";
                                    }
                        
                                    $stmt = null;
                                    $conexion = null;
                                    
                                }catch(PDOException $e){
                                    echo "Connection failed: ".$e->getMessage();
                                }

                    echo "</select>
                            <input type='hidden' name='modelo' value=$id_modelo>
                        </div>

                        <div class='m-4'>
                            <label class='input-titulo-alquiler mr-2'>Localidad: </label> 
                            <select class='input-alquiler' name='localidad' id='localidades'>    

                            </select>
                        </div>

                        <div class='m-4 mt-5'>
                            <label class='input-titulo-alquiler mr-2'>Recogida: </label>
                            <input type='date' class='input-date-alquiler' name='recogida' id='recogida' onchange='calcular_precio()' class='mr-3'>
                        </div>

                        <div class='m-4'>             
                            <label class='input-titulo-alquiler mr-2'>Entrega: </label>
                            <input type='date' class='input-date-alquiler' name='entrega' id='entrega' onchange='calcular_precio()'>
                        </div>

                        <div class='text-white m-4 mt-5 d-flex justify-content-between row'>
                            <div class='mr-4'>
                                <label>Precio diario: $precio_alquiler € - Total a pagar: <label id='precio'></label> €</label>
                                <input type='hidden' id='input_hidden_precio' name='precio' value=''>
                            </div>
                            
                            <div>
                                <input type='submit' class='btn boton-alquilar-vehiculo' id='boton_alquilar' value='Alquilar Vehículo'>
                            </div>
    
                        </div>

                    </form>

                </div>

                <div class='col-lg-5 col-md-10 capa-modelo-alquiler d-flex justify-content-center align-column row'>

                    <div class='col-lg-8 col-md-6 capa-info-alquiler'>
                        <div>
                            <h3 class='mt-3 font-italic'>$nombre</h3>
                            <ul>
                                $info_alquiler
                            </ul>
                        </div>
                    </div>

                    <div class='capa-imagen-modelo-alquiler col-md-6 mt-4  d-flex justify-content-center'>
                        <img class='imagen-modelo-alquiler' src='data:image/jpg;base64, $imagen' alt='alquiler_model_img'>
                    </div>
                    
                </div>

              </div>";
              
              
    }


    function Generar_localidades_options($provincia){
        
        $sql = "SELECT * FROM localidades WHERE id_provincia = $provincia";
        
        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $localidades = $stmt->fetchAll();

            foreach($localidades as $row){       
                $id_localidad = $row["id_localidad"];
                $nombre_localidad = $row["nombre_localidad"];

                echo "<option value='$id_localidad'>$nombre_localidad</option>";
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }


    function Insertar_alquiler($provincia, $localidad, $recogida, $entrega, $precio, $usuario, $modelo_id){

        $sql = "INSERT INTO alquileres (provincia, localidad, fecha_recogida, fecha_entrega, precio_alquiler, usuario, modelo)  VALUES ($provincia,$localidad,'$recogida','$entrega',$precio,$usuario,$modelo_id)";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $stmt = null;
            $conexion = null;

        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }

    }

    function Generar_alquileres(){

        $sql = "SELECT prov.nombre_provincia, loc.nombre_localidad, alq.id_alquiler, alq.fecha_recogida, alq.fecha_entrega, alq.precio_alquiler, model.miniatura2_modelo, model.id FROM provincias prov, localidades loc, modelos model, alquileres alq WHERE alq.provincia=prov.id_provincia AND alq.localidad=loc.id_localidad AND alq.modelo=model.id AND alq.usuario=$_SESSION[id_usuario] ORDER BY alq.fecha_recogida ASC";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll();

            foreach($datos as $row){       
                $provincia = $row["nombre_provincia"];
                $localidad = $row["nombre_localidad"];
                $fecha_recogida = $row["fecha_recogida"];
                $fecha_entrega = $row["fecha_entrega"];
                $precio = number_format($row["precio_alquiler"]);
                $imagen = base64_encode($row["miniatura2_modelo"]);
                $id_modelo = $row["id"];
                $id_alquiler = $row["id_alquiler"];

                $fecha_actual = date("y-m-d");

                $dateTimeActual = strtotime($fecha_actual); 
                $dateTimeRecogida = strtotime($fecha_recogida);
                $dateTimeEntrega = strtotime($fecha_entrega);

                echo "<div class='capa-alquilado col-xl-10 mt-5'>
                        
                        <div class='row'>

                            <div class='col-md-4 d-flex justify-content-center'>
                                <a href='modelo.php?modelo=$id_modelo'><img class='img-alquilado' src='data:image/jpg;base64, $imagen' alt=''></a>
                            </div>

                            <div class='col-md-8 row'>

                                <div class='col-sm-6 mt-2'>
                                    <div class='h5'><label class='provincia-alquiler datos-alquiler'>Provincia: </label><label class='resultado-alquilado'>$provincia</label></div>
                                    <div class='h5 mt-2'><label class='provincia-alquiler datos-alquiler'>Localidad: </label><label class='resultado-alquilado'>$localidad</label></div>                        
                                </div>
                                
                                <div class='col-sm-6 mt-2'>
                                    <div class='h5'><label class='datos-alquiler fecha-alquiler'>Fecha de recogida: </label> <label class='resultado-alquilado'>$fecha_recogida</label></div> 
                                    <div class='h5 mt-2'><label class='datos-alquiler fecha-alquiler'> Fecha de entrega:</label>  <label class='resultado-alquilado'>$fecha_entrega</label></div>                        
                                </div>

                                <div class='col-sm-6 mt-2'>
                                    <div class='h5'><label class='datos-alquiler mr-2'>Total: </label><label class='resultado-alquilado'>$precio €</label></div>         
                                </div>

                                <div class='col-sm-6 mt-sm-2'>
                                    <div class='h5'><label class='datos-alquiler mr-2'>Estado: </label><label class='resultado-alquilado'>";

                                    if ($dateTimeActual < $dateTimeRecogida){
                                        echo "En espera de recogida"; 
                
                                    }else if($dateTimeActual >= $dateTimeRecogida && $dateTimeActual <= $dateTimeEntrega){
                                        echo "En periodo de alquiler";
                                         
                                    }else{
                                        echo "Finalizado";//Apareceráel botón de eliminar del historial cuando el estado sea Finalizados 
                                        echo "<a href='alquileres.php?alquiler=$id_alquiler'><img src='Imagenes/delete.png' id='icon-delete' alt='delete' type='submit'></a>"; 
                                    }
                                    
                                echo "</label></div>   
                                </div>
                                
                            </div>

                        </div>

                    </div>";
                    
                    
                           
            }

            $stmt = null;
            $conexion = null;
            
        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }

    }

    function Eliminar_alquiler($id_alquiler){
        $sql = "DELETE FROM alquileres WHERE id_alquiler = $id_alquiler";

        try{
            $conexion = Conection::con("proyectodaw");
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $stmt = null;
            $conexion = null;

        }catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }
    }
 ?>