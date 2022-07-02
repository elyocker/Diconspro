<?php

date_default_timezone_set('America/Bogota');

class PDF extends FPDF
{
    // Cabecera de página
    public function Header()
    {        
        // Logo
        $this->Image('vistas/dist/img/logo.png',10,2,40);
        // Arial bold 15
        // Movernos a la derecha
        $this->Cell(80);
        // imagen del titulo
        $this->Image('vistas/dist/img/titulo_pdf.jpeg',80,10,60);
        // Título
        $this->SetFont('Arial','',10);
       
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    public function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-18);
        // Arial italic 8
        $this->SetFont('Arial','I',8);        
        $this->Cell(0,10,'DICONSPRO',0,0,'C');
        $this->Ln(3);
        $this->Cell(0,10,'Cel. 317 729 79 29',0,0,'C');
        $this->Ln(3);
        $this->Cell(0,10,'C.Comercial Cafe Plaza Oficina 104a',0,0,'C');
        $this->Ln(3);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}






?>