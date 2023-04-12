<?php
class ControladorPlantilla
{
    /*=============================================
	Llamamos plantilla
	=============================================*/
        public function plantilla()
    {
            include "vistas/plantilla.php";
    }
    /*=============================================
        Estilos Dinamicos
    =============================================*/
        public static function ctrEstiloPlantilla(){
            $tabla = "plantilla";
            $respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);
            return $respuesta;
        }
}
