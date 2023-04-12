<?php      
    $servidor = Ruta::ctrRutaServidor();
    $url = Ruta::ctrRuta();
    ?>
<!-- BREADCRUMB INFOPRODUCTOS -->
<div class="container-fluid well-sm">
    
    <div class="container">
    <div class="row">
        <ul class="breadcrumb fondoBreadcrumb text-uppercase">
            <li><a href="<?php echo $url;?>">INICIO</a></li>
            <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
        </ul>
    </div>
    </div>
</div>
<!-- INFOPRODUCTOS -->
<div class="container-fluid infoproducto">
    
    <div class="container">
        
        <div class="row">
            <!-- VISOR PRODUCTOS -->
            <div class="col-md-5 col-sm-6 col-xs-12 visorImg">
                <figure class="visor">
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas01.jpg" alt="torta2">
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas02.jpg" alt="torta2">
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas03.jpg" alt="torta2">
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas04.jpg" alt="torta2">
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas05.jpg" alt="torta2"> 
                </figure>

                <div class="flexslider">
                <ul class="slides">
                    <li>
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas01.jpg" alt="torta2">
                    </li>
                    <li>
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas02.jpg" alt="torta2">
                    </li>
                    <li>
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas03.jpg" alt="torta2">
                    </li>
                    <li>
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas04.jpg" alt="torta2">
                    </li>
                    <li>
                    <img class="img-thumbnail"src="http://localhost/backend/vistas/img/multimedia/clasicas05.jpg" alt="torta2">
                    </li>
                </ul>
                </div>
            </div>
        

        </div>
        
    </div>

    
</div>
