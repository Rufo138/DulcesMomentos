<div class="container-fluid well well-sm barraProductos">

    <div class="container">
        
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle backColor" data-toggle="dropdown">
                        Ordenar Productos<span class="caret"></span></button>
                        <ul class="dropdown-menu backColor" role="menu">
                            <?php
                            echo '<li><a href="'.$url.$rutas[0].'/1/reciente/'.$rutas[3].'">Más Reciente</a></li>
                                 <li><a href="'.$url.$rutas[0].'/1/antiguo/'.$rutas[3].'">Más Antiguo</a></li>';
                            ?>
                        </ul>

                    
                    
                </div>
            </div>

            <div class="col-xs-6 organizarProductos">

                <div class="pull-right">

                    <button name="grid" type="button" class="btn btn-default btnGrid backColor rounded" id="btnGrid0" aria-label="grid" data-toggle="tooltip" title="Cambiar a modo Grilla">

                        <i class="fa fa-th" aria-hidden="true"></i>

                        <span class="col-xs-0 pull-right">GRID</span>

                    </button>

                    <button name="list" type="button" class="btn btn-default btnList backColor" id="btnList0" aria-label="list" data-toggle="tooltip" title="Cambiar a modo Lista">

                    <i class="fa fa-list" aria-hidden="true"></i>

                    <span class="col-xs-0 pull-right">LIST</span>

                    </button>

                </div>

            </div>

        </div>
        
    </div>

</div>
    <!--=============================================
    LISTAR PRODUCTOS
    =============================================*-->

    <div class="container-fluid productos">
    <div class="container" style="margin:0px , padding:0px">
        
        <div class="row">
    <!--=============================================
    MIGAS DE PAN
    =============================================*-->
            <ul class="breadcrumb fondoBreadcrumb text-uppercase">
                <li><a href="<?php echo $url;?>">INICIO</a></li>
                <li class="active pagActiva"><?php echo $rutas[0]; ?></li>
            </ul>



<?php
    /*=============================================
    LLAMADO DE PAGINACION
    =============================================*/
    if(isset($rutas[1])){
        if(isset($rutas[2])){
            if($rutas[2]=="antiguo"){
                $modo = "ASC";
                $_SESSION["ordenar"] = $modo;
            }else{
                $modo = "DESC";
                $_SESSION["ordenar"] = $modo;
            }
        }else{
            $modo = $_SESSION["ordenar"];
        }
        $base = ((int)$rutas[1] - 1)*8;
        $tope = 8;

    }else{
        $rutas[1] = 1;
        $base = 0;
        $tope = 8;
        $modo = "DESC";
    }


    /*=============================================
    LLAMADO DE PRODUCTOS POR BUSQUEDA
    =============================================*/
    $productos = null;
    $listaProductos = null;
    $ordenar = "id";
    if(isset($rutas[3])){
        $busqueda = $rutas[3]; 
        $productos = ControladorProductos::ctrBuscarProductos($busqueda,$ordenar,$modo,$base, $tope);
        $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
    }
    

    if(!$productos){
        echo '<div class="col-xs-12 error404 text-center">
        <h1><small>¡Oops!</small></h1>
        <h2>Aún no hay productos en esta sección<h2>
        </div>';
    }else{
        echo '<ul class="grid0">';
        foreach ($productos as $key => $value) {
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
                       </h2><br>';


                    }else{
                        echo'
                        <h2><small>
                        <strong>$'.$value["precio"].'</strong></small></h2><br>';

                    }

                
            
                    
                echo '</div>
                <div class="text-right col-lg-6 col-md-6 col-xs-12 enlaces" style="padding-right:0px;padding-left:0px;margin-bottom:15px">
                <div class="btn-group">

                    <button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos" name="agregar_lista_deseos">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>

                    <button name="ver_producto" type="button" class="btn btn-default btn-xs deseos" style="color:black;margin:2px" data-toggle="tooltip" title="Ver producto">
                    <a href="'.$value["ruta"].'" class="pixelProdaucto">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </a>';  
                    
                    if($value["oferta"] != 0){

                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                        </button>';

                    }else{

                        echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'"  peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                        </button>';

                    }

                }

                echo '

            </div>

        </div>

    </li>';
        echo'</ul>
        <ul class="list0" style="display:none">'; 
        foreach ($productos as $key => $value) {

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


                        <small>

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

                            echo '<h2 style="margin-top:-10px">
                            
                                    <small>
                
                                        <strong class="oferta">$ '.$value["precio"].'</strong>

                                    </small>

                                    <small>$ '.$value["precioOferta"].'</small>
                                
                                </h2>';

                        }else{

                            echo '<h2><small>$'.$value["precio"].'</small></h2>';
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

    echo '</ul>';

        
    }

?>



<div class="clear fix text-center col-xs-12">
    <!--=============================================
    PAGINACION
    =============================================*-->
    <?php 
        if(count($listaProductos) != 0){
            $pagProductos = ceil(count($listaProductos)/8);
            if($pagProductos > 4){
                /*Si rutas es igual a 1 retornar esto*/
                if($rutas[1] == 1){
                    /*=============================================
					PRIMERAS 4 PAG
					=============================================*/
                    echo '<ul class="pagination" style="margin:20px 0">
               ';

                for($i = 1; $i <= 4; $i ++){
                    echo '<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                }
                echo '<li class="disabled"><a class="page-link">...</a></li>
                      <li id="item'.$pagProductos.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
                      <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.(2).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                </ul>';
                }
                /*=============================================
					BOTONES DE LAS ULTIMAS 4 PAG
					=============================================*/
                    elseif($rutas[1] == $pagProductos){
                        echo '<ul class="pagination" style="margin:20px 0">
                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($pagProductos-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/1/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
                        <li class="disabled"><a class="page-link">...</a></li>

               ';

                for($i = ($pagProductos-2); $i <= $pagProductos; $i ++){
                    echo '<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                }
                echo '
                </ul>';


                    }
                    /*=============================================
					BOTONES MITAD HACIAS ABAJO
					=============================================*/
                    elseif($rutas[1] != $pagProductos &&
                        $rutas[1] != 1
                        &&
                        $rutas[1] != $pagProductos &&
                        $rutas[1] != ($pagProductos-1)

                    ){
                        $numPagActual = $rutas[1];

                        echo '<ul class="pagination" style="margin:20px 0">
                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
               ';
                        if($numPagActual >=3){
                             for($i = $numPagActual-2; $i < $pagProductos; $i ++){

                            echo '<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                        }

                        }else{
                            for($i = $numPagActual-1; $i < $pagProductos; $i ++){

                            echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                        }

                        }


                        echo '<li class="disabled"><a class="page-link">...</a></li>
                            <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$pagProductos.'/'.$rutas[2].'/'.$rutas[3].'">'.$pagProductos.'</a></li>
                            <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                        </ul>';

                    }
                    elseif($rutas[1] == ($pagProductos-1)){
                        $numPagActual = $rutas[1];
                        
                        echo '
                        <ul class="pagination" style="margin:20px 0">
                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual-1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                        <li class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$rutas[2].'/'.$rutas[3].'">1</a></li>
                        <li class="disabled"><a class="page-link">...</a></li>
               ';
               for($i = $numPagActual-2; $i <= ($numPagActual+1); $i ++){
                echo '<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';
            }
            echo'<li id="item'.$i.'" class="page-item"><a class="page-link" href="'.$url.$rutas[0].'/'.($numPagActual+1).'/'.$rutas[2].'/'.$rutas[3].'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';

                    }

            }else{
                echo '<ul class="pagination" style="margin:20px 0">';

                for($i = 1; $i <= $pagProductos; $i ++){
                    echo '<li class="page-item" id="item'.$i.'"><a class="page-link" href="'.$url.$rutas[0].'/'.$i.'/'.$rutas[2].'/'.$rutas[3].'">'.$i.'</a></li>';

                }
                echo '</ul>';
            }
        }
    ?>
</div>
</div>
</div>
</div>