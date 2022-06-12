<?php

//INICIO::inicio de controladores
    require_once "./controlador/controladorMain.php";
    require_once "./controlador/usuarioControlador.php";
//FIN::inicio de controladores

//INICIO::inicio de modelos
//FIN::inicio de modelos

include_once ("global.inc");

$plantilla = new PlantillaControlador();

$plantilla-> ctrPlantilla();