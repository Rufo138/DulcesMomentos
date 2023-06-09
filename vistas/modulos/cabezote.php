<?php      
    $servidor = Ruta::ctrRutaServidor();
    $url = Ruta::ctrRuta();
    ?>

<!-- TOP-->
<div class="container-fluid barraSuperior" id="top">
    <div class="container">
        <div class="row">
            <!-- REDES SOCIALES-->
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
                <ul>
                    <?php
                    $social = ControladorPlantilla::ctrEstiloPlantilla();
                    $jsonRedesSociales = json_decode($social["redesSociales"],true);
                    
                    foreach ($jsonRedesSociales as $key => $value) {

                        echo '<li>
                                <a href="'.$value["url"].'" target="_blank" title="'.$value["red"].'">
                                    <i class="fa '.$value["red"].' redSocial '.$value["estilo2"].'" aria-hidden="true"></i>
                                </a>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- REGISTRO -->
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">
                <ul>
                    <li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
                    <li>|</li>
                    <li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>

                </ul>
            </div>

        </div>
    </div>
</div>
<!-- HEADER -->
<header class="container-fluid">
    <div class="container">
        <div class="row" id="cabezote">
            <!-- LOGOTIPO -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="logotipo">
                <a href="<?php echo $url?>">
                    <img src="<?php echo $servidor.$social["logo"]?>" class="img-responsive" alt="Sublime general rodriguez">
                    
                </a>
            </div>
            <!-- CATEGORIAS Y BUSCADOR -->

            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                <!-- BOTON CATEGORIAS -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
                    <p>CATEGORIAS
                        <span class="pull-right">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                    </p>
                </div>
                <!-- BUSCADOR -->
                <div class="input-group col-lg-8 col-md-8 col-sm-7 col-xs-12" id="buscador">
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <a href="<?php 
                        echo $url; ?>buscador/1/recientes">
                            <button name="search" class="btn btn-default backColor" type="submit" aria-label="Search">
                                <i class="fa fa-search"></i>
                            </button>
                        </a>
                    </span>
                </div>
            </div>
            <!-- CARRITO -->
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
                <a href="#">
                    <button name="carrito" class="btn btn-default pull-left backColor" aria-label="Carrito">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                </a>
                <p>TU CESTA <span class="cantidadCesta"></span><br> ARG $ <span class="sumaCesta"></span></p>
            </div>
        </div>
        <!-- CATEGORIAS -->
        <div class="col-xs-12 backColor " id="categorias">
            <?php

            $item = null;
            $valor = null;

            $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);
            
            foreach ($categorias as $key => $value) {
                echo'<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4><a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a></h4>
                <hr/>
                <ul>';
                $item = "id_categoria";
                $valor = $value["id"];

                $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
                foreach ($subcategorias as $key => $value) {
                    echo '
                    <li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
                }
                echo '</ul>
                </div>';
            }
            ?>

        </div>
    </div>
</header>