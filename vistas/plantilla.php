<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <meta name="title" content="Dulces Momentos">

    <meta name="description" content="Dulces Momentos">

    <meta name="keyword" content="Dulces Momentos - general rodriguez - Pasteleria">

    <title>Dulces Momentos</title>

    <?php 
    session_start();
    $icono = ControladorPlantilla::ctrEstiloPlantilla();
    /*=============================================
	 RUTA SERVIDOR
	=============================================*/

    $servidor = Ruta::ctrRutaServidor();

    echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

    /*=============================================
    RUTA CLIENTE
	=============================================*/
    $url = Ruta::ctrRuta();
    ?>
    <!-- /*=============================================
    PLUGINS CSS
    =============================================*/ -->
    <link rel="preconnect" href="<?php echo $url;?>https://fonts.googleapis.com">

    <link rel="preconnect" href="<?php echo $url;?>https://fonts.gstatic.com" crossorigin>

    <link rel="preconnect" href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plugins/flexslider.css">
    <!-- /*=============================================
    HOJAS DE ESTILO (CSS)
    =============================================*/ -->
    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/plantilla2.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/cabezote.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/slide.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/productos.css">

    <link rel="stylesheet" href="<?php echo $url;?>vistas/css/infoproducto.css">
    

    <!-- /*=============================================
    PLUGINS JS
    =============================================*/ -->
    <script src="<?php echo $url;?>vistas/js/plugins/jquery.min.js"></script>

    <script src="<?php echo $url;?>vistas/js/plugins/bootstrap.min.js"></script>

    <script src="<?php echo $url;?>vistas/js/plugins/jquery.easing.js"></script>

    <script src="<?php echo $url;?>vistas/js/plugins/jquery.scrollUp.js"></script>

    <script src="<?php echo $url;?>vistas/js/plugins/jquery.flexslider.js"></script>

    
</head>

<body>

    <?php

    /*=============================================
    Header
    =============================================*/
    include "modulos/cabezote.php";
    /*=============================================
    Contenido Dinamico
    =============================================*/
    $rutas = array();

    $ruta = null;

    $infoProducto = null;

    if(isset($_GET["ruta"])){

        $rutas = explode("/", $_GET["ruta"]);

        $item = "ruta";

        $valor = $rutas[0];

        /*=============================================
        URL'S AMIGABLES DE CATEGORIAS
        =============================================*/

        $rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

            if(empty($rutas[0]) == empty($rutaCategorias["ruta"])){

            $ruta = $rutas[0];

        }
        /*=============================================
        URL'S AMIGABLES DE SUBCATEGORIAS
        =============================================*/
        $rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

        foreach ($rutaSubCategorias as $key => $value) {

            if($rutas[0] == $value["ruta"]){
                
                $ruta = $rutas[0];

        }
        }
        /*=============================================
        URL'S AMIGABLES DE INFO PRODUCTOS
        =============================================*/
        $rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

        if(empty($rutas[0]) == empty($rutaProductos["ruta"])){

            $infoProducto = $rutas[0];

        }

        /*=============================================
        LISTA BLANCA URL'S AMIGABLES
        =============================================*/
        if(empty($ruta) == null || $rutas[0] == "articulos-nuevos" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto" ){

            include "modulos/productos.php";

        }else if($infoProducto != null){
            include "modulos/infoproducto.php";
        }else if($rutas[0] == "buscador"){
            include "modulos/buscador.php";
        }
        else{
            
            include "modulos/error404.php";
        }
    }else{

        include "modulos/slide.php";

        include "modulos/destacados.php";
    }
    ?>
    <input type="hidden" value="<?php echo $url;?>" id="rutaOculta">
    <!-- /*=============================================
    JS PERSONALIZADO
    =============================================*/ -->
    <script src="<?php echo $url;?>vistas/js/cabezote.js"></script>

    <script src="<?php echo $url;?>vistas/js/plantilla.js"></script>
    
    <script src="<?php echo $url;?>vistas/js/slide.js"></script>

    <script src="<?php echo $url;?>vistas/js/buscador.js"></script>

    <script src="<?php echo $url;?>vistas/js/infoproducto.js"></script>

</body>

</html>