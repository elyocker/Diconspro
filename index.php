<?php

    //INICIO::inicio de controladores
        require_once "./controlador/controladorMain.php";
        require_once "./controlador/usuarioControlador.php";
        require_once "./controlador/menuControlador.php";
        require_once "./controlador/rolesControlador.php";
        require_once "./controlador/proyectoControlador.php";
        require_once "./controlador/cotizacionControlador.php";
        require_once "./controlador/clientesControlador.php";
        require_once "./controlador/balanceControlador.php";

    //FIN::inicio de controladores
    
    //INICIO::inicio de modelos
        require_once "./modelo/conexion.php";
    //FIN::inicio de modelos
    require_once "./vistas/modulos/pdf_cotizacion.php";

include_once ("global.inc");

$plantilla = new PlantillaControlador();

$plantilla-> ctrPlantilla();