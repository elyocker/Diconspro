<?php
require('vistas/pdf/fpdf.php');
require('vistas/pdf/formato_pdf.php');
include_once('controlador/cotizacionControlador.php');

// $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '';

// switch ($tipo) {
//     case 'cotizacion':
//         generarpdf();
//         break;
    
//     default:
//         # code...
//         break;
// }

function generarpdf($id=''){
// $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $resul_cli=cotizacionControlador::getCliente($id);

    $pisos="";
    $modalidad="";
    if ( $resul_cli[0]['cot_recono']=='true') {
        $pisos=" ".$resul_cli[0]['cot_pisos'];
        $modalidad="Reconocimiento";

    }

    if ( $resul_cli[0]['cot_obranue']=='true') {
        $pisos=" ".$resul_cli[0]['cot_pisos'];
        $modalidad="Obra nueva";
    }

$resul_cli[0]['municipio'];
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$mes= valida_mes( date("m") );
$fecha= date("j")." de $mes, ".date("Y");
$pdf->Cell(320,0,utf8_decode('Tuluá - '.$fecha) ,0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);

$pdf->MultiCell(90,5,utf8_decode('Señor : '.$resul_cli[0]['cli_nombre']),0,'L',0);
$pdf->Ln(2);

$pdf->MultiCell(90,5,utf8_decode('Teléfono :'.$resul_cli[0]['cli_telefono']),0,'L',0);
$pdf->Ln(8);

$pdf->SetFont('Arial','',12);
$pdf->Image('vistas/dist/img/marca_agua.jpeg',50,100,120);

$mensaje="A continuación describo la cotización del diseño para reconocimiento y modificación de una vivienda de $pisos pisos con cubierta tradicional de ".$resul_cli[0]['cot_metro2']." m2 aproximadamente ubicado en ".$resul_cli[0]['cli_direccion']." barrio ".$resul_cli[0]['cli_barrio']." de la ciudad de ".$resul_cli[0]['municipio'].", bajo la modalidad de $modalidad 1 piso Adición $pisos piso vivienda ".$resul_cli[0]['cot_tipo'];

$pdf->MultiCell(190,5,utf8_decode($mensaje),0,'FJ',0);
$pdf->Ln(15);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(48,0,utf8_decode('TRABAJO A REALIZAR:') ,0,0,'C');
$pdf->Ln(10);

$pdf->Cell(52,0,utf8_decode('Licencia de construcción.') ,0,0,'C');
$pdf->Ln(8);

$pdf->SetFont('Arial','',12);

$pdf->Cell(130,0,utf8_decode('* Acondicionamiento de planos Arquitectónicos constructivos,') ,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(100,0,utf8_decode('eléctricos,hidráulicos, sanitarios básicos.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(135,0,utf8_decode('* Diseño y elaboración de planos arquitectónicos para obtención') ,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(80,0,utf8_decode('de licencia de construcción') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(130,0,utf8_decode('* Elaboración de planos eléctricos e hidráulicos básicos para') ,0,0,'C');
$pdf->Ln(5);
$pdf->Cell(100,0,utf8_decode('obtención de licencia de construcción.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(145,0,utf8_decode('* Elaboración de planos estructurales a partir de la norma NSR-2010.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(53,0,utf8_decode('* Estudio de Suelos.') ,0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,0,utf8_decode('DOCUMENTOS:') ,0,0,'C');
$pdf->Ln(8);

$pdf->SetFont('Arial','',12);

$pdf->Cell(75,0,utf8_decode('* Copia de la escritura pública.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(70,0,utf8_decode('* Copia de impuesto predial.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(85,0,utf8_decode('* Copia de la cedula del propietario.') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(125,0,utf8_decode('* Copia de recibo de energía y agua (línea de paramento)') ,0,0,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(20,0,utf8_decode('NOTA:') ,0,0,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,0,utf8_decode(' Todos los documentos necesarios y costo de cada uno de ellos, para los trámites') ,0,0,'C');
$pdf->Ln(4);
$pdf->Cell(160,0,utf8_decode('de la licencia de construcción serán suministrados por la parte contratante.') ,0,0,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(90,0,utf8_decode('COSTOS DE ACTIVIDADES A REALIZAR: ') ,0,0,'C');
$pdf->Ln(8);
$pdf->Cell(94,0,utf8_decode('Valor para '.$pisos.' pisos con cubierta tradicional:') ,0,0,'C');
$pdf->Ln(8);

$resul_vlr=cotizacionControlador::getValores();

$valor_arquit=0;
if ($resul_cli[0]['cot_arquitectonico']=='arquitectonico') { 

    $vlr_pisos      = ($pisos ==1)?  $resul_vlr[0]['valor_proyecto'] :$resul_vlr[0]['valor_arquite']; 
    $vlr_propHori   = ($resul_cli[0]['cot_prophori'] =='true') ? $resul_vlr[0]['valor_prohori']  : 0;
    $vlr_levanArq   = ($resul_cli[0]['cot_arquit'] =='true') ? $resul_vlr[0]['valor_levant']  : 0;
    if ($pisos==1) {

        $valor_arquit=$resul_vlr[0]['valor_proyecto'] + (($vlr_propHori + $vlr_levanArq) * $resul_cli[0]['cot_metro2']) ;
    }else {
        
        $valor_arquit= (($resul_cli[0]['cot_metro2'] * $pisos) *  ($vlr_pisos + $vlr_propHori +$vlr_levanArq )); 
    }

    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(50,0,utf8_decode('Valor arquitectonico:') ,0,0,'C');
    $pdf->Cell(190,0 ,'$ '.number_format($valor_arquit,0)    ,0,0,'C');
    $pdf->Ln(8);
}

if ($resul_cli[0]['cot_estructural']=='estructural') {    

    $vlr_suelos= ($resul_cli[0]['cot_suelos']=='true') ?  $resul_vlr[0]['valor_suelos']  : 0;
    $vlr_estru= $resul_cli[0]['cot_valortot'] - ($valor_arquit + $vlr_suelos);

    $pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(66,0,utf8_decode('Valor Estructural '.$resul_cli[0]['cot_tipocot'].':') ,0,0,'C');
    $pdf->Cell(158,0 ,'$ '.number_format($vlr_estru,0) ,0,0,'C');
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Ln(8);
}

if ($resul_cli[0]['cot_suelos']=='true') {
    $pdf->SetTextColor(41, 185, 12);
    $pdf->Cell(45,0,utf8_decode('Estudio de suelos:') ,0,0,'C');
    $pdf->Cell(200,0 ,'$ '.number_format($resul_vlr[0]['valor_suelos'],0) ,0,0,'C');
    $pdf->Ln(8);
}

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(190,0,utf8_decode('______________________________________________________________________________') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(30,0,utf8_decode('Valor Total:') ,0,0,'C');
$pdf->Cell(230,0 ,'$ '.number_format($resul_cli[0]['cot_valortot'],0)  ,0,0,'C');
$pdf->Ln(50);

// segunda pagina 
if ($resul_cli[0]['cot_tradicion']=='true' ||
    $resul_cli[0]['cot_curaduria']=='true' || 
    $resul_cli[0]['cot_vecinos']=='true'
    ) {
    $pdf->Cell(55,0,utf8_decode('Valor Documentación : ') ,0,0,'C');
}else {
    $pdf->Cell(55,0,'' ,0,0,'C');
}


$pdf->Image('vistas/dist/img/marca_agua.jpeg',50,100,120);
$pdf->Ln(8);

$pdf->SetFont('Arial','',12);
$mostrar_impuesto=false;
$total_impuestos=0;
if ($resul_cli[0]['cot_tradicion']=='true') {
    $pdf->Cell(58,0,utf8_decode('Certificado de tradición: ') ,0,0,'C');
    $pdf->Cell(180,0 ,'$ '.number_format($resul_vlr[0]['valor_tradicion'],0)  ,0,0,'C');
    $pdf->Ln(8);
    $total_impuestos+=$resul_vlr[0]['valor_tradicion'];
    $mostrar_impuesto=true;
}

if ($resul_cli[0]['cot_curaduria']=='true') {
    $pdf->Cell(75,0,utf8_decode('Valor valla curaduría + Carpeta: ') ,0,0,'C');
    $pdf->Cell(146,0 ,'$ '.number_format($resul_vlr[0]['valor_curaduria'],0) ,0,0,'C');
    $pdf->Ln(8);
    $total_impuestos+=$resul_vlr[0]['valor_curaduria'];
    $mostrar_impuesto=true;
}

if ($resul_cli[0]['cot_vecinos']=='true') { 

    $vlr_vecinos =  ($resul_vlr[0]['valor_vecinos'] * $resul_cli[0]['cot_cantveci']);

    $pdf->Cell(55,0,utf8_decode('Valor cartas vecinos: ') ,0,0,'C');
    $pdf->Cell(186,0 ,'$ '.number_format($vlr_vecinos,0) ,0,0,'C');
    $pdf->Ln(5);
    $total_impuestos+=$vlr_vecinos;
    $mostrar_impuesto=true;
}

if ( $resul_cli[0]['cot_lineaparam'] >0) { 

    $vlr_paramentos =  ($resul_cli[0]['cot_vlrparam']!='')? $resul_cli[0]['cot_vlrparam'] : 17000 ;

    $pdf->Cell(75,0,utf8_decode('Valor Linea de paramentos: ') ,0,0,'C');
    $pdf->Cell(145,0 ,'$ '.number_format($vlr_paramentos,0) ,0,0,'C');
    $pdf->Ln(5);
    $total_impuestos+=$vlr_paramentos;
    $mostrar_impuesto=true;
}

if ($mostrar_impuesto) {
    $pdf->Cell(190,0,utf8_decode('______________________________________________________________________________') ,0,0,'C');
    $pdf->Ln(8);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(55,0,utf8_decode('Valor impuestos: ') ,0,0,'C');
    $pdf->Cell(186,0 ,'$ '.number_format($total_impuestos,0) ,0,0,'C');
    $pdf->Ln(8);
}

$secenta= ($resul_cli[0]['cot_valortot']*0.6); 
$cuarenta= ($resul_cli[0]['cot_valortot']*0.4); 
$pdf->SetFont('Arial','',12);
$subMsj="Inicio de trabajos con el 60% ($ ".number_format($secenta,0).") y 40% ($ ".number_format($cuarenta,0).") restante al momento de 
TERMINACION del proyecto para su radicación ante Planeación Municipal.";

$pdf->MultiCell(190,5,utf8_decode($subMsj),0,'FJ',0);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75,0,utf8_decode('Tiempo de entrega: 30 Días hábiles') ,0,0,'C');
$pdf->Ln(8);
$pdf->MultiCell(190,5,utf8_decode('Elaboro: '.$resul_cli[0]['usuario']),0,'L',0);
$pdf->Ln(40);

$pdf->SetFont('Arial','',12);

$tam_firma= ($mostrar_impuesto==false && $resul_cli[0]['cot_lineaparam'] ==0 && $resul_cli[0]['cot_suelos']=='false') ? 90 : 130;

$pdf->Image('vistas/dist/img/firma.jpeg',10,$tam_firma,60);
$pdf->MultiCell(190,20,utf8_decode('___________________________'),0,'L',0);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(190,5,utf8_decode('Coordinador de proyectos - MAT: 76502-066528'),0,'L',0);
$pdf->Ln(8);
// for($i=1;$i<=40;$i++){
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
// }

// se guarda el pdf en el servidor local 
$ruta_carga="vistas/pdf/generados/";
$nombre_archivo="cotizacion_".$resul_cli[0]['cot_nombre'].".pdf";
$pdf->Output($ruta_carga.$nombre_archivo,'F');
// $pdf->Output();


}

function valida_mes($vlr_mes=''){
    $meses = [
        "01"=>"Enero",
        "02"=>"Febrero",
        "03"=>"Marzo",
        "04"=>"Abril",
        "05"=>"Mayo",
        "06"=>"Junio",
        "07"=>"Julio",
        "08"=>"Agosto",
        "09"=>"Septiembre",
        "10"=>"Octubre",
        "11"=>"Noviembre",
        "12"=>"Diciembre"
    ];

    return $meses[$vlr_mes];
}








?>