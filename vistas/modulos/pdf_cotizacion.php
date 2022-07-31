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
$pisos=" ".$resul_cli[0]['cot_pisos'];

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

$tipo_viend=($resul_cli[0]['cot_prophori']=='true')? "vivienda Bifamiliar" :" vivienda ".$resul_cli[0]['cot_tipo'];

$modalidad =($resul_cli[0]['cot_arquit']=='true') ? " Levantamiento arquitectonico " :
( $resul_cli[0]['cot_recono']=='true' ? " Reconocimiento " : 
( $resul_cli[0]['cot_obranue']=='true' ? " Obra nueva ": 
( $resul_cli[0]['cot_prophori']=='true' ? " Propiedad Horizontal " :
 ($resul_cli[0]['cot_arquit']=='true' ?" Arquitectonico "  : ""      )) )   ) ;

if ($resul_cli[0]['cot_prophori']=='true' && $resul_cli[0]['cot_arquit']=='true' ) {
    $reco=( $resul_cli[0]['cot_recono']=='true' )? "reconocimiento":"Obra nueva" ;
   $modalidad=" $reco , Propiedad Horizontal , Levantamiento Arquitectonico";
}

$text_num= ($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true' ) ? "del diseño para reconocimiento y modificación de una vivienda de $pisos pisos con cubierta tradicional":($resul_cli[0]['cot_arquitectonico']=='arquitectonico' ? "del diseño arquitectonico de una vivienda de $pisos pisos con un area ":($resul_cli[0]['cot_prophori']=='true' ? " para el visto bueno de propieda horizontal en una vivienda ":"para el visto bueno de Levantamiento arquitectonico en una vivienda") );

$text_pisos=($resul_cli[0]['cot_arquit']=='true' || $resul_cli[0]['cot_prophori']=='true')? " $pisos pisos": "1 piso Adición $pisos pisos";

$mensaje="A continuación describo la cotización $text_num de ".($resul_cli[0]['cot_metro2'] * $pisos)." m2 aproximadamente ubicado en ".$resul_cli[0]['cli_direccion']." barrio ".$resul_cli[0]['cli_barrio']." de la ciudad de ".$resul_cli[0]['municipio'].", bajo la modalidad de $modalidad $text_pisos  $tipo_viend";

$pdf->MultiCell(190,5,utf8_decode($mensaje),0,'FJ',0);
$pdf->Ln(15);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(48,0,utf8_decode('TRABAJO A REALIZAR:') ,0,0,'C');
$pdf->Ln(10);

$sub_titulo ="";

if( $resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true' )$sub_titulo =  "Licencia de construcción: ";

if( $resul_cli[0]['cot_prophori']=='true' && 
    $resul_cli[0]['cot_suelos']=='false' && 
    $resul_cli[0]['cot_arquit']=='false' &&
    $resul_cli[0]['cot_estructural']=='' &&
    $resul_cli[0]['cot_arquitectonico']=='' )$sub_titulo =  "Licencia de Propiedad Horizontal: ";

if( $resul_cli[0]['cot_arquit']=='true' &&
    $resul_cli[0]['cot_prophori']=='false' && 
    $resul_cli[0]['cot_suelos']=='false' && 
    $resul_cli[0]['cot_estructural']=='' &&
    $resul_cli[0]['cot_arquitectonico']=='arquitectonico'
    ) $sub_titulo =  " Levantamiento Arquitectonico :";

if( $resul_cli[0]['cot_estructural']=='estructural' && 
    $resul_cli[0]['cot_arquit']=='false' &&
    $resul_cli[0]['cot_prophori']=='false' && 
    $resul_cli[0]['cot_suelos']=='false' )$sub_titulo =  " calculo estructural :";

if( $resul_cli[0]['cot_arquitectonico']=='arquitectonico' && 
    $resul_cli[0]['cot_arquit']=='false' &&
    $resul_cli[0]['cot_prophori']=='false' && 
    $resul_cli[0]['cot_suelos']=='false')$sub_titulo =  " Diseño arquitectonico :";

if( (   $resul_cli[0]['cot_metro2'] * $pisos)==0 && 
        $resul_cli[0]['cot_suelos']=='true' && 
        $resul_cli[0]['cot_prophori']=='false' && 
        $resul_cli[0]['cot_arquit']=='false' ) $sub_titulo =  " Estudio de suelos :";

if( ($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true') && 
                $resul_cli[0]['cot_prophori']=='true' && 
                $resul_cli[0]['cot_arquit']=='true' &&
                $resul_cli[0]['cot_estructural']=='estructural' &&
                $resul_cli[0]['cot_arquitectonico']=='arquitectonico' 
            )$sub_titulo =  "Licencia de construcción :";

if( ($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true') && 
            $resul_cli[0]['cot_prophori']=='true' && 
            $resul_cli[0]['cot_arquit']=='true' &&
            $resul_cli[0]['cot_estructural']=='estructural' &&
            $resul_cli[0]['cot_arquitectonico']=='arquitectonico'  && $resul_cli[0]['cot_suelos']=='true'
        )$sub_titulo =  "Licencia de construcción :";

$pdf->MultiCell(190,5,utf8_decode($sub_titulo),0,'L',0);
// $pdf->Cell(52,0,utf8_decode($sub_titulo.'.') ,0,0,'C');
$pdf->Ln(8);

$pdf->SetFont('Arial','',12);
if( $resul_cli[0]['cot_prophori']=='true' &&
    $resul_cli[0]['cot_suelos']=='false' && 
    $resul_cli[0]['cot_arquit']=='false' &&
    $resul_cli[0]['cot_estructural']=='' &&
    $resul_cli[0]['cot_arquitectonico']==''){

    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de planos de la propiedad horizontal con áreas definidas"),0,'L',0);
    $pdf->Ln(5);
    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de minuta y reglamento de la propiedad horizontal"),0,'L',0);
    $pdf->Ln(5);
}

if( $resul_cli[0]['cot_arquit']=='true' &&
    $resul_cli[0]['cot_prophori']=='false' && 
    $resul_cli[0]['cot_suelos']=='false' && 
    $resul_cli[0]['cot_estructural']=='' &&
    $resul_cli[0]['cot_arquitectonico']==''){
        
    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de planos a edificacion exístente"),0,'L',0);
    $pdf->Ln(5);
}

if( $resul_cli[0]['cot_arquit']=='true' &&
        $resul_cli[0]['cot_prophori']=='false' && 
        $resul_cli[0]['cot_suelos']=='false' && 
        $resul_cli[0]['cot_estructural']=='' &&
        $resul_cli[0]['cot_arquitectonico']=='arquitectonico'
     ){

    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de diseño arquitectonico"),0,'L',0);
    $pdf->Ln(5);
    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de fachada y cubierta"),0,'L',0);
    $pdf->Ln(5);
    
}

if( $resul_cli[0]['cot_estructural']=='estructural' && 
    $resul_cli[0]['cot_arquit']=='false' &&
    $resul_cli[0]['cot_prophori']=='false' && 
    $resul_cli[0]['cot_suelos']=='false' ){

    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de planos estructurales a partir de la norma NSR-2010"),0,'L',0);
    $pdf->Ln(5);
    $pdf->MultiCell(190,5,utf8_decode("* Elaboración de fachada y cubierta"),0,'L',0);
    $pdf->Ln(5);
    
}

if (   ( ($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true') && 
        $resul_cli[0]['cot_prophori']=='true' && 
        $resul_cli[0]['cot_arquit']=='true' &&
        $resul_cli[0]['cot_suelos']=='true' &&
        $resul_cli[0]['cot_estructural']=='estructural' &&
        $resul_cli[0]['cot_arquitectonico']=='arquitectonico' )
        
        || 

        (($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true' ) &&
        $resul_cli[0]['cot_prophori']=='false' && 
        $resul_cli[0]['cot_arquit']=='false' &&
        $resul_cli[0]['cot_estructural']=='estructural' &&
        $resul_cli[0]['cot_arquitectonico']=='arquitectonico')

        ||

        (($resul_cli[0]['cot_recono']=='true' || $resul_cli[0]['cot_obranue']=='true' ) &&
        $resul_cli[0]['cot_prophori']=='false' && 
        $resul_cli[0]['cot_arquit']=='false' &&
        $resul_cli[0]['cot_estructural']=='' &&
        $resul_cli[0]['cot_arquitectonico']=='arquitectonico')
        

    ) {
    
    $pdf->MultiCell(190,5,utf8_decode('* Acondicionamiento de planos Arquitectónicos constructivos, eléctricos,hidráulicos, sanitarios básicos.'),0,'L',0);
    $pdf->Ln(5);

    $pdf->MultiCell(190,5,utf8_decode('* Diseño y elaboración de planos arquitectónicos para obtención de licencia de construcción'),0,'L',0);
    $pdf->Ln(5);

    $pdf->MultiCell(190,5,utf8_decode('* Elaboración de planos eléctricos e hidráulicos básicos para obtención de licencia de construcción.'),0,'L',0);
    $pdf->Ln(5);

    $pdf->MultiCell(190,5,utf8_decode('* Elaboración de planos estructurales a partir de la norma NSR-2010.'),0,'L',0);
    $pdf->Ln(5);

    $pdf->MultiCell(190,5,utf8_decode('* Estudio de Suelos.'),0,'L',0);
    $pdf->Ln(5);

}



$pdf->SetFont('Arial','B',12);

$pdf->MultiCell(190,5,utf8_decode('DOCUMENTOS:'),0,'L',0);
$pdf->Ln(5);

$pdf->SetFont('Arial','',12);
$pdf->MultiCell(190,5,utf8_decode('* Copia de la escritura pública.'),0,'L',0);
$pdf->Ln(5);
$pdf->MultiCell(190,5,utf8_decode('* Copia de impuesto predial.'),0,'L',0);
$pdf->Ln(5);
$pdf->MultiCell(190,5,utf8_decode('* Copia de la cedula del propietario.'),0,'L',0);
$pdf->Ln(5);
$pdf->MultiCell(190,5,utf8_decode('* Copia de recibo de energía y agua (línea de paramento)'),0,'L',0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);

$pdf->MultiCell(190,5,utf8_decode('NOTA:'),0,'L',0);
$pdf->Ln(5);

$pdf->SetFont('Arial','',12);

$pdf->MultiCell(190,5,utf8_decode('Todos los documentos necesarios y costo de cada uno de ellos, para los trámites de la licencia de construcción serán suministrados por la parte contratante.'),0,'TJ',0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);

$pdf->AddPage();

$pdf->MultiCell(190,5,utf8_decode('COSTOS DE ACTIVIDADES A REALIZAR: '),0,'L',0);
$pdf->Ln(10);

$resul_vlr=cotizacionControlador::getValores();

$valor_arquit=0;
if ($resul_cli[0]['cot_arquitectonico']=='arquitectonico') { 

    $valor_arquit      = ($pisos ==1)?  $resul_vlr[0]['valor_proyecto'] :($resul_vlr[0]['valor_arquite'] * ( $resul_cli[0]['cot_pisos'] * $resul_cli[0]['cot_metro2'])); 
        
    // echo "valor_arquit:: $valor_arquit <BR>\r\n";

    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(50,0,utf8_decode('Valor arquitectonico:') ,0,0,'C');
    $pdf->Cell(190,0 ,'$ '.number_format($valor_arquit,0)    ,0,0,'C');
    $pdf->Ln(8);
}

if ($resul_cli[0]['cot_estructural']=='estructural') {    

    
    $vlr_estru= ($resul_cli[0]['cot_tipocot']=='aporticado') ?  ($resul_vlr[0]['valor_aporticado'] * ( $resul_cli[0]['cot_pisos'] * $resul_cli[0]['cot_metro2'])) : ($resul_vlr[0]['valor_confinado'] * ( $resul_cli[0]['cot_pisos'] * $resul_cli[0]['cot_metro2']));
    
    // echo "vlr_estru:: $vlr_estru <BR>\r\n";

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

if ($resul_cli[0]['cot_arquit']=='true') {

    $vlr_levant_arqui= ($resul_vlr[0]['valor_levant'] * ( $resul_cli[0]['cot_pisos'] * $resul_cli[0]['cot_metro2']) );

    $pdf->SetTextColor(41, 185, 12);
    $pdf->Cell(50,0,utf8_decode('Levan arquitectonico:') ,0,0,'C');
    $pdf->Cell(190,0 ,'$ '.number_format($vlr_levant_arqui,0) ,0,0,'C');
    $pdf->Ln(8);
}

if ($resul_cli[0]['cot_prophori']=='true') {

    $vlr_prohori= ($resul_vlr[0]['valor_prohori'] * ( $resul_cli[0]['cot_pisos'] * $resul_cli[0]['cot_metro2']) );

    $pdf->SetTextColor(41, 185, 12);
    $pdf->Cell(50,0,utf8_decode('Propidad Horizontal:') ,0,0,'C');
    $pdf->Cell(190,0 ,'$ '.number_format($vlr_prohori,0) ,0,0,'C');
    $pdf->Ln(8);
}

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(190,0,utf8_decode('______________________________________________________________________________') ,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(30,0,utf8_decode('Valor Total:') ,0,0,'C');
$pdf->Cell(230,0 ,'$ '.number_format($resul_cli[0]['cot_valortot'],0)  ,0,0,'C');
$pdf->Ln(20);


// segunda pagina 
if ($resul_cli[0]['cot_tradicion']=='true' ||
    $resul_cli[0]['cot_curaduria']=='true' || 
    $resul_cli[0]['cot_vecinos']=='true'
    ) {
    $pdf->Cell(55,0,utf8_decode('Valor Documentación : ') ,0,0,'C');
}else {
    $pdf->Cell(55,0,'' ,0,0,'C');
}


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
    $pdf->Ln(8);
    $total_impuestos+=$vlr_vecinos;
    $mostrar_impuesto=true;
}

if ( $resul_cli[0]['cot_lineaparam'] >0) { 

    $rango_param = cotizacionControlador::getVlrParamentos();
    $vlr_paramentos =0;
    foreach ($rango_param as $row) {
        if($resul_cli[0]['cot_lineaparam'] >= $row['vlr_rangoini'] && $resul_cli[0]['cot_lineaparam'] <= $row['vlr_rangofin'] ) $vlr_paramentos = $row['vlr_valor'] ;
    }

    $pdf->Cell(68,0,utf8_decode('Valor Linea de paramentos: ') ,0,0,'C');
    $pdf->Cell(160,0 ,'$ '.number_format($vlr_paramentos,0) ,0,0,'C');
    $pdf->Ln(8);
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
TERMINACION del proyecto para su radicación ante Curaduria urbana.";

$pdf->MultiCell(190,5,utf8_decode($subMsj),0,'FJ',0);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75,0,utf8_decode('Tiempo de entrega: 30 Días hábiles') ,0,0,'C');

$pdf->Ln(20);
$pdf->SetFont('Arial','',12);

$pdf->Image('vistas/dist/img/firma.jpeg',$pdf->GetX()+1, $pdf->GetY()+1,60);
$pdf->Ln(15);
$firma='<div >
<br>
<spa>______________________________________</spa> <br>
<span>Coordinador de proyectos - MAT: 76502-066528</span>
</div>';
$pdf->WriteHTML($firma);
$pdf->SetTopMargin(0);
// $pdf->Ln(30);
// $pdf->Cell(75,0,utf8_decode('___________________________') ,0,0,'C');
// $pdf->Ln(8);
// $pdf->Cell(90,0,utf8_decode('Coordinador de proyectos - MAT: 76502-066528') ,0,0,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Ln(15);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(190,5,utf8_decode('Elaboro: '.$resul_cli[0]['usuario']),0,'L',0);
$pdf->Ln(8);


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