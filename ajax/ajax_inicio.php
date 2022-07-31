<?php
include_once "../modelo/conexion.php";
session_start();

$tipo = isset($_REQUEST['tipo'])? $_REQUEST['tipo']:'';

switch ($tipo) {
    case 'ganancias':
        ganancias();
        break;
    
    case 'editar':
        editar();
        break;

    case 'descripcion':
        descripcion();
        break;

    case 'getDescrip':
        getDescrip();
        break;

    case 'alerta':
        alerta();
        break;
    default:
        ganancias();
        break;
}

function ganancias(){       
      
    $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

    $year= date('Y');

    
    $fecha_fin=  date("Y-m-t", strtotime(date('Y-m-d')));
    $fecha_inicio= date('Y-m-01');

    $sql  = "SELECT 
                case when valor_gastos > sum(vlr_valor) then 0 else sum(vlr_valor)-valor_gastos END   AS valores,
                valor_gastos 
            FROM vlr_company , valores_cotizacion
            WHERE vlr_fechac BETWEEN '$fecha_inicio' AND '$fecha_fin' 
            AND valor_ano ='$year' ";  
            
    $resp_ingresos = $detalle->getDatos($sql);

    for ($i=0; $i < sizeof($resp_ingresos); $i++) { 
        $resp_ingresos[$i]['valores']= number_format($resp_ingresos[$i]['valores'],0) ;
        $resp_ingresos[$i]['valor_gastos']= number_format($resp_ingresos[$i]['valor_gastos'],0) ;
    }

    $detalle->close();

    if ($resp_ingresos!='' ) {
        $respues= array(
            "status"=>"success",
            "ingresos"=>$resp_ingresos[0]['valores'],
            "gastos"=>$resp_ingresos[0]['valor_gastos']
        );
    }else {
        $respues= array(
            "status"=>"error",
            "ingresos"=>"No hay registros",
            "gastos"=>"No hay registros"
        );
    }

    echo json_encode($respues);
}

?>