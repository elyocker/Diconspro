<?php

class proyecto 
{
    static public function nombreFuncion(){

        $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

        // $sql="SELECT * FROM departamentos ";
        // $result = $detalle->getDatos($sql);

        $detalle->close();

    }
}








?>