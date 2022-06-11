<?php
include_once "../modelo/conexion.php";

switch ($_REQUEST['tipo']) {
    case 'buscar':
        buscar();
        break;
    
    default:
        # code...
        break;
}

function Buscar(){         
    $detalle = new con_db('127.0.0.1','root','','diconspro');

    $usu_cedula     = isset($_REQUEST['usu_cedula'])        ?$_REQUEST['usu_cedula']        : '';
    $usu_nombre     = isset($_REQUEST['usu_nombre'])        ?$_REQUEST['usu_nombre']        : '';
    $fecha_inicio   = isset($_REQUEST['fecha_inicio'])      ?$_REQUEST['fecha_inicio']      : '';
    $fecha_fin      = isset($_REQUEST['fecha_fin'])         ?$_REQUEST['fecha_fin']         : '';

    $where="1=1";
    if ($fecha_inicio!='' && $fecha_fin!='') $where.=" AND  usu_fechac BETWEEN '$fecha_inicio' AND '$fecha_fin' ";
    if ($usu_cedula!='' ) $where.=" AND  usu_cedula ='$usu_cedula' ";
    if ($usu_nombre!='' ) $where.=" AND  usu_nombre ='$usu_nombre' ";

    $sql  = "SELECT usu_codigo,
                    usu_rol,
                    usu_nombre,
                    usu_foto,
                    usu_estado,
                    usu_cuenta
            FROM usuario 
            WHERE $where ";  
    
    $resp = $detalle->getDatos($sql);
    
    $detalle->close();

    if ($resp!='') {
        $respues= array(
            "status"=>"success",
            "result"=>$resp
        );
    }else {
        $respues= array(
            "status"=>"error",
            "result"=>"No hay registros"
        );
    }

    echo json_encode($respues);
}




?>