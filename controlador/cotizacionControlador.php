<?php

class cotizacionControlador 
{
    static public function setCotizacion(){        
        $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '';

        if ($tipo=='nuevo') {
           
            $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);
            
            //INICIO::datos de cotizacion
                $total_medidas      = isset($_REQUEST['total_medidas'])     ? $_REQUEST['total_medidas']        : '';
                $valor_total        = isset($_REQUEST['valor_total'])       ? $_REQUEST['valor_total']          : '';
                $tipo_vivienda      = isset($_REQUEST['tipo_vivienda'])     ? $_REQUEST['tipo_vivienda']        : '';
                $tipo_cotiza        = isset($_REQUEST['tipo_cotiza'])       ? $_REQUEST['tipo_cotiza']          : '';
                $pisos_recon        = isset($_REQUEST['pisos_recon'])       ? $_REQUEST['pisos_recon']          : '0';
                $pisos_obra         = isset($_REQUEST['pisos_obra'])        ? $_REQUEST['pisos_obra']           : '0';
                $obra_nueva         = isset($_REQUEST['obra_nueva'])        ? "true"                            : 'false';
                $reconocimiento     = isset($_REQUEST['reconocimiento'])    ? "true"                            : 'false';
                $pro_horizon        = isset($_REQUEST['pro_horizon'])       ? "true"                            : 'false';
                $leva_arqui         = isset($_REQUEST['leva_arqui'])        ? "true"                            : 'false';
                $estu_suelos        = isset($_REQUEST['estu_suelos'])       ? "true"                            : 'false';
            //FIN::datos de cotizacion

            //INICIO::datos del cliente
                $cli_cedula         = isset($_REQUEST['cli_cedula'])        ? $_REQUEST['cli_cedula']           : '';
                $cli_nombre         = isset($_REQUEST['cli_nombre'])        ? $_REQUEST['cli_nombre']           : '';
                $cli_telefono       = isset($_REQUEST['cli_telefono'])      ? $_REQUEST['cli_telefono']         : '';
                $cli_email          = isset($_REQUEST['cli_email'])         ? $_REQUEST['cli_email']            : '';
                $cli_direccion      = isset($_REQUEST['cli_direccion'])     ? $_REQUEST['cli_direccion']        : '';
                $cli_barrio         = isset($_REQUEST['cli_barrio'])        ? $_REQUEST['cli_barrio']           : '';
                $departamento       = isset($_REQUEST['departamento'])      ? $_REQUEST['departamento']         : '';
                $ciudad             = isset($_REQUEST['ciudad'])            ? $_REQUEST['ciudad']               : '';
            //FIN::datos del cliente

            $nombre_proyecto="INMUEBLE ".strtoupper($cli_nombre);
            $usuarioc=$_SESSION['usuCodigo'];

            $sql="INSERT INTO cotizacion 
                (
                    cot_nombre,
                    cot_tipocot,
                    cot_tipo,
                    cot_recono,
                    cot_recopisos,
                    cot_obranue,
                    cot_obrapisos,
                    cot_prophori,
                    cot_arquit,
                    cot_metro2,
                    cot_valortot,
                    cot_estado,
                    cot_suelos,
                    cot_usuarioc
                )
                VALUES
                (
                    '$nombre_proyecto',
                    '$tipo_cotiza',
                    '$tipo_vivienda',
                    '$reconocimiento',
                    '$pisos_recon',
                    '$obra_nueva',
                    '$pisos_obra',
                    '$pro_horizon',
                    '$leva_arqui',
                    '$total_medidas',
                    '$valor_total',
                    '0',
                    '$estu_suelos',
                    '$usuarioc'
                )";
            
            $result_cotiza = $detalle->insert($sql);
           

            $sql_cli="INSERT INTO cliente 
                (
                    cli_nombre,
                    cli_cedula,
                    cli_telefono,
                    cli_email,
                    cli_depart,
                    cli_ciudad,
                    cli_direccion,
                    cli_barrio,
                    cli_estado,
                    cli_usuac
                )
                VALUES
                (
                    '$cli_nombre',
                    '$cli_cedula',
                    '$cli_telefono',
                    '$cli_email',
                    '$cli_direccion',
                    '$cli_barrio',
                    '$departamento',
                    '$ciudad',
                    '1',
                    '$usuarioc'
                )";
           
            $result_cliente = $detalle->insert($sql_cli);
            
            if ($result_cotiza=='ok' && $result_cliente=='ok') {
                echo "result_cotiza:: $result_cotiza <BR>\r\n";
                echo "result_cliente:: $result_cliente <BR>\r\n";

                # se crea el pdf

                #se envia el whatsap
            }
    
            $detalle->close();
        }
    }

    static public function getDepartamento(){        

        $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

        $sql="SELECT * FROM departamentos ";
        $result = $detalle->getDatos($sql);

        $detalle->close();
        return $result;
    }
}








?>