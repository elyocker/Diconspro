<?php

//INICIO::inicio de controladores
    require_once "./controlador/controladorMain.php";
    require_once "./controlador/usuarioControlador.php";
    require_once "./controlador/menuControlador.php";
    require_once "./controlador/rolesControlador.php";
    require_once "./controlador/cotizacionControlador.php";
    
//FIN::inicio de controladores

//INICIO::inicio de modelos
    require_once "./modelo/conexion.php";
//FIN::inicio de modelos

include_once ("global.inc");

$plantilla = new PlantillaControlador();

$plantilla-> ctrPlantilla();