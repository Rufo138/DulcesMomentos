<?php
$servidor = Ruta::ctrRutaServidor();
/* BANNER */
$banner = ControladorProductos::ctrMostrarBanner($ruta);
if(is_array($banner)){
$ruta = $rutas[0];
$titulo1 = json_decode($banner["titulo1"],true);
$titulo2 = json_decode($banner["titulo2"],true);
$titulo3 = json_decode($banner["titulo3"],true);
echo '<figure class="banner">
<img src="'.$servidor.$banner["img"].'" style="width:100%; min-height: 150px" alt="">
<div class="textoBanner '.$banner["estilo"].'">
<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>
</br>
<h2 style="color:'.$titulo2["color"].'">'.$titulo2["texto"].'</h2>
<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

</div>
</figure> ';
}

    echo '<figure class="banner">
<img src="'.$servidor.$social["banner"].'" style="width:100%; min-height: 150px" alt="">
<div class="textoBanner textoDer">

'.$social["bannerTexto"].'

</div>


</figure>
';


//TITULOS//
$titulosModulos = array("ARTICULOS NUEVOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutasModulos = array("articulos-nuevos", "lo-mas-vendido", "lo-mas-visto");
$base = 0;
$tope = 4;
if($titulosModulos[0] == "ARTICULOS NUEVOS"){
    $ordenar = "id";
    $item = "nuevo";
    $valor = 1;
    $modo = "DESC";
    // $item = "precio"; si quisieramos articulos gratis
    // $valor = 0;

    $destacados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor,$base, $tope,$modo);
}
if($titulosModulos[1] == "LO MÁS VENDIDO"){
    
    $ordenar = "ventas";
    $item = null;
    $valor = null;
    $modo = "DESC";
    $ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor,$base, $tope,$modo);
}
if($titulosModulos[2] == "LO MÁS VISTO"){

    $ordenar = "vistas";
    $item = null;
    $valor = null;
    $modo = "DESC";
    $vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor,$base, $tope,$modo);
}
$modulos = array($destacados, $ventas, $vistas);
//FIN TITULOS//

//BOTONES DINAMICOS//
for ($i=0; $i < count($titulosModulos); $i++) { 
    echo '<div class="container-fluid well well-sm barraProductos">

    <div class="container">
        
        <div class="row">

            <div class="col-xs-12 organizarProductos">

                <div class="pull-right">

                    <button name="grid" type="button" class="btn btn-default btnGrid backColor rounded" id="btnGrid'.$i.'" aria-label="grid" data-toggle="tooltip" title="Cambiar a modo Grilla">

                        <i class="fa fa-th" aria-hidden="true"></i>

                        <span class="col-xs-0 pull-right">GRID</span>

                    </button>

                    <button name="list" type="button" class="btn btn-default btnList backColor" id="btnList'.$i.'" aria-label="list" data-toggle="tooltip" title="Cambiar a modo Lista">

                    <i class="fa fa-list" aria-hidden="true"></i>

                    <span class="col-xs-0 pull-right">LIST</span>

                    </button>

                </div>

            </div>

        </div>
        
    </div>

</div>
<div class="container-fluid productos">

    <div class="container">

        <div class="row">

        <div class="col-xs-12 tituloDestacado">
        <div class="col-sm-6 col-xs-12">

            <h1><small>'.$titulosModulos[$i].'</small></h1>

        </div>
        <div class="col-sm-6 col-xs-12">

            <a href="'.$rutasModulos[$i].'">

                <button name="ver_mas"class="btn btn-default pull-right backColor ">
                    VER MÁS <span class="fa fa-chevron-right"></span>
                </button>
            </a>
        </div>
         </div>
         <div class="clearfix"></div>

         <hr>

        </div>

        <ul class="grid'.$i.'">';

        //GRID DINAMICO//

        foreach ($modulos[$i] as $key => $value) {
            echo '<li class="col-md-3 col-sm-6 col-xs-12">
                    <figure>
                        <a href="'.$value["ruta"].'" class="pixelProducto centrar">
                        <img src="'.$servidor.$value["portada"].'" class="img-responsive" alt="'.$value["ruta"].'" data-toggle="tooltip" title="'.$value["titulo"].'">
                        </a>
                    </figure>
                <h4 class="text-center">
                    <small>
        
                    <a href="'.$value["ruta"].'" class="pixelProducto" data-toggle="tooltip" title="Detalles de '.$value["titulo"].'">'.$value["titulo"].'<br>
                    <span style="color:rgba(0,0,0,0)">-</span>';
                    if($value["nuevo"] != 0){
                        echo '<span class="label label-warning fontSize">Nuevo</span> ';
                    }
                    if($value["oferta"] != 0){
                        echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'%OFF</span>';

                    }

                    echo '
        
                    </a>
                    
                    </small>
                </h4>
                <div class="col-lg-6 col-md-6 col-xs-12 precio">
                ';
                    if($value["oferta"] != 0){
                       echo '
                       <h2>
                       <small class="oferta">
                       $'.$value["precio"].'
                       </small>
                       <small>
                       <strong>$'.$value["precioOferta"].'
                       </strong>
                       </small>
                       </h2>';


                    }else{
                        echo'
                        <h2><small>
                        <strong>$'.$value["precio"].'</strong></small></h2>';

                }
            
                    
                echo '</div>
                <div class="text-right col-lg-6 col-md-6 col-xs-12 enlaces" style="padding-right:0px;padding-left:0px;margin-bottom:15px">
                <div class="btn-group">

                    <button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos" name="agregar_lista_deseos">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>

                    <button name="ver_producto" type="button" class="btn btn-default btn-xs deseos" style="color:black;margin:2px" data-toggle="tooltip" title="Ver producto">
                    <a href="'.$value["ruta"].'" class="pixelProdaucto" style="color:black">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </a>';  
                    
                        if($value["oferta"] != 0){
                            echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </button>
                        ';

                        }else{
                            echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" " peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>';
                        }
                    }
                    echo'
                    </div>
        </div>
        
    </li>';
                        
        echo'</ul>
        <ul class="list'.$i.'" style="display:none">'; 
        foreach ($modulos[$i] as $key => $value) {

            echo '<li class="col-xs-12">
              
                  <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                       
                    <figure>
                
                        <a href="'.$value["ruta"].'" class="pixelProducto">
                            
                            <img src="'.$servidor.$value["portada"].'" class="img-responsive" data-toggle="tooltip" title="'.$value["titulo"].'">

                        </a>

                    </figure>

                  </div>
                      
                <div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
                    
                    <h1 style="margin-top:-1px;line-height:1px">

                        <small data-toggle="tooltip" title="'.$value["titulo"].'">

                            <a href="'.$value["ruta"].'" class="pixelProducto">
                                
                                '.$value["titulo"].'<br>';

                                if($value["nuevo"] != 0){

                                    echo '<span class="label label-warning">Nuevo</span> ';

                                }

                                if($value["oferta"] != 0){

                                    echo '<span class="label label-warning">'.$value["descuentoOferta"].'% off</span>';

                                }		

                            echo '</a>

                        </small>

                    </h1>

                    <p class="text-muted">'.$value["titular"].'</p>';

                            if($value["oferta"] != 0){

                            echo '<h2 style="margin-top:0px">

                                    <small>
                
                                        <strong class="oferta">$'.$value["precio"].'</strong>

                                    </small>

                                    <small>$'.$value["precioOferta"].'</small>
                                
                                </h2>';

                        }else{

                            echo '<h2 style="margin-top:0px"><small>$'.$value["precio"].'</small></h2>';

                        }
                        
                    

                    echo '<div class="btn-group pull-left enlaces">                      
                          <button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                          </button>

                        <a href="'.$value["ruta"].'" class="pixelProducto">
                            <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </a>'; 
                
                    if($value["oferta"] != 0){

                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                        </button>';

                    }else{

                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                        </button>';

                }

              echo '
        
        </div>

    </div>

    <div class="col-xs-12"><hr></div>

    </li>';

    }

    echo '</ul>

    </div>

    </div>';

    }

?>
