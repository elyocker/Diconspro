<?php



class usuarioControlador
{
    
    static public function getInput($tabla="",$campos="",$where="1=1"){
        include_once "modelo/conexion.php";

        $detalle = new con_db('127.0.0.1','root','','diconspro');
        $sql  = "SELECT $campos
            FROM $tabla 
            WHERE $where ";        
        $resp = $detalle->getDatos($sql);

        $detalle->close();
        return $resp;
    }
    
    static public function ctrCreacionUsuario(){

        $tipo= isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"]:"";

        if ($tipo=="nuevo") {
            $nombre     = isset($_REQUEST['nombre'])    ? $_REQUEST['nombre']       : '';
            $telefono   = isset($_REQUEST['telefono'])  ? $_REQUEST['telefono']     : '';
            $correo     = isset($_REQUEST['correo'])    ? $_REQUEST['correo']       : '';
            $rol        = isset($_REQUEST['rol'])       ? $_REQUEST['rol']          : '';
            $password   = isset($_REQUEST['password'])  ? $_REQUEST['password']     : '';
            $usuario    = isset($_REQUEST['usuario'])   ? $_REQUEST['usuario']      : '';
            $apellido   = isset($_REQUEST['apellido'])  ? $_REQUEST['apellido']     : '';

            echo "nombre:: $nombre <BR>\r\n";
            echo "telefono:: $telefono <BR>\r\n";
            echo "correo:: $correo <BR>\r\n";
            echo "rol:: $rol <BR>\r\n";
            echo "password:: $password <BR>\r\n";
            echo "usuario:: $usuario <BR>\r\n";
            echo "apellido:: $apellido <BR>\r\n";

            printf($_FILES["usu_foto"]["tmp_name"]) ;

            die("Termino");
        }
    }
}

