
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
                        <a class="enlaceMenu dropdown-item bg-dark text-light" href="modelos.php?tipo=1">Gasolina</a>
                        <a class="enlaceMenu dropdown-item bg-dark text-light" href="modelos.php?tipo=2">Diésel</a>
                        <a class="enlaceMenu dropdown-item bg-dark text-light" href="modelos.php?tipo=3">Híbridos</a>
                        <a class="enlaceMenu dropdown-item bg-dark text-light" href="modelos.php?tipo=4">Eléctricos</a>
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