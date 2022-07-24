<?php

class proyectoControlador
{
    static public function pasarProyecto(){

        
        $tipo = isset($_REQUEST['tipo_pro'])? $_REQUEST['tipo_pro'] :"";

        if ($tipo!='') {

            $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

            $pro_nombre             = isset($_REQUEST['pro_nombre'])        ? $_REQUEST['pro_nombre']       :"";
            $pro_estimado           = isset($_REQUEST['pro_estimado'])      ? $_REQUEST['pro_estimado']     :"";
            $pro_usuario            = isset($_REQUEST['pro_usuario'])       ? $_REQUEST['pro_usuario']      :"";
            $id_cotizacion            = isset($_REQUEST['id_cotizacion'])       ? $_REQUEST['id_cotizacion']      :"";

            $usuario_creacion=$_SESSION['usu_codigo'];
            $new_dire="vistas/proyectos/$pro_nombre";
           
            if (!file_exists($new_dire)) {
                mkdir($new_dire,0777);//CREACION DE LA CARPETA
            }

            $campoInsert="";
            $valueInsert="";
            if ($_FILES["pro_autocat"]["tmp_name"]!='' ) {
                echo '<pre>';
                print_r($_FILES["pro_autocat"]["name"]);
                echo '</pre>';
                $extension =   explode('.',$_FILES["pro_autocat"]["name"]);
                $nombre_archivo= "autocat.".$extension[1];
                move_uploaded_file($_FILES["pro_autocat"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_autocat";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_escritura"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_escritura"]["name"]);
                $nombre_archivo= "escritura.".$extension[1];
                move_uploaded_file($_FILES["pro_escritura"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_escritura";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_certifitradi"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_certifitradi"]["name"]);
                $nombre_archivo= "tradicion.".$extension[1];
                move_uploaded_file($_FILES["pro_certifitradi"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_certiftradi";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_impredial"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_impredial"]["name"]);
                $nombre_archivo= "predial.".$extension[1];
                move_uploaded_file($_FILES["pro_impredial"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_impredial";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_otroarch"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_otroarch"]["name"]);
                $nombre_archivo= "otroarchivo.".$extension[1];
                move_uploaded_file($_FILES["pro_otroarch"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_otroarch";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_foto1"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto1"]["name"]);
                $nombre_archivo= "foto1.".$extension[1];
                move_uploaded_file($_FILES["pro_foto1"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto1";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto2"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto2"]["name"]);
                $nombre_archivo= "foto2.".$extension[1];
                move_uploaded_file($_FILES["pro_foto2"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto2";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto3"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto3"]["name"]);
                $nombre_archivo= "foto3.".$extension[1];
                move_uploaded_file($_FILES["pro_foto3"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto3";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto4"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto4"]["name"]);
                $nombre_archivo= "foto4.".$extension[1];
                move_uploaded_file($_FILES["pro_foto4"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto4";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto5"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto5"]["name"]);
                $nombre_archivo= "foto5.".$extension[1];
                move_uploaded_file($_FILES["pro_foto5"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto5";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto6"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto6"]["name"]);
                $nombre_archivo= "foto6.".$extension[1];
                move_uploaded_file($_FILES["pro_foto6"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoInsert.=",pro_foto6";
                $valueInsert.=",'$new_dire/$nombre_archivo'";
            }

            $sql="UPDATE cotizacion SET cot_estado='1' WHERE cot_id='$id_cotizacion' ";
            
            $detalle->insert($sql);

            $sql="INSERT INTO proyecto
                (
                    pro_nombre,
                    pro_estimado,
                    pro_cotizacion,
                    pro_estado,
                    pro_usuario,
                    pro_usuc
                    $campoInsert
                ) 
                VALUES
                (
                    '$pro_nombre',
                    '$pro_estimado',
                    '$id_cotizacion',
                    '0',
                    '$pro_usuario',
                    '$usuario_creacion'
                    $valueInsert
                )  
            ";
            
            $result = $detalle->insert($sql);

            $icon="";
            $title="";
            $text="";
            if ($result=='ok' ) {
                $icon="success";
                $title="Felicitaciones";
                $text="El proyecto se creo exitosamente";                

            }else {
                $icon="error";
                $title="Lo sentimos";
                $text="Hubo un problema al crear el proyecto";
            }
            $detalle->close();

            if ($icon!='') {
                echo"<script>
                        Swal.fire({
                            icon: '$icon',
                            title: '$title',
                            text: '$text'
                        }).then((result) => {                            
                            if (result.isConfirmed) {
                                window.location = 'cotizacion';
                            } 
                        })
                                           
                </script>";
            }
            
            $detalle->close();
        }

    }

    static public function getProyectos(){    

        $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

        $sql="SELECT *
            FROM proyectos         
            WHERE 1=1";
        $result = $detalle->getDatos($sql);
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // die("Termino");
        $detalle->close();
        return $result;
    }

    static public function actualizar(){

        $tipo = isset($_REQUEST['tipo_proyecto'])? $_REQUEST['tipo_proyecto'] :"";

        if ($tipo!='') {

            $detalle = new con_db( $_SESSION['ipConect'], $_SESSION['usuConect'],$_SESSION['passConect'], $_SESSION['proyeConect']);

            $pro_estado             = isset($_REQUEST['proyecto_estado'])       ? $_REQUEST['proyecto_estado']      :"";
            $codigo_proyecto        = isset($_REQUEST['codigo_proyecto'])       ? $_REQUEST['codigo_proyecto']      :"";
            $pro_nombre             = isset($_REQUEST['nombre_pro'])       ? $_REQUEST['nombre_pro']      :"";
            
            $usuario_creacion=$_SESSION['usu_codigo'];
            $new_dire="vistas/proyectos/$pro_nombre";
           
            if (!file_exists($new_dire)) {
                mkdir($new_dire,0777);//CREACION DE LA CARPETA
            }

            $campoUpd="";
            if ($_FILES["autocat_new"]["tmp_name"]!='' ) {                
                $extension =   explode('.',$_FILES["autocat_new"]["name"]);
                $nombre_archivo= "autocat.".$extension[1];
                delete_archivo($detalle,'pro_autocat',$codigo_proyecto);
                move_uploaded_file($_FILES["autocat_new"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_autocat='$new_dire/$nombre_archivo'";
            }

            if ($_FILES["escritura_new"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["escritura_new"]["name"]);
                $nombre_archivo= "escritura.".$extension[1];
                delete_archivo($detalle,'pro_escritura',$codigo_proyecto);
                move_uploaded_file($_FILES["escritura_new"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_escritura='$new_dire/$nombre_archivo'";
            }

            if ($_FILES["certifitradi_new"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["certifitradi_new"]["name"]);
                $nombre_archivo= "tradicion.".$extension[1];
                delete_archivo($detalle,'pro_certiftradi',$codigo_proyecto);
                move_uploaded_file($_FILES["certifitradi_new"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_certiftradi='$new_dire/$nombre_archivo'";
            }

            if ($_FILES["impredial_new"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["impredial_new"]["name"]);
                $nombre_archivo= "predial.".$extension[1];
                delete_archivo($detalle,'pro_impredial',$codigo_proyecto);
                move_uploaded_file($_FILES["impredial_new"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_impredial='$new_dire/$nombre_archivo'";
            }

            if ($_FILES["otroarch_new"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["otroarch_new"]["name"]);
                $nombre_archivo= "otroarchivo.".$extension[1];
                delete_archivo($detalle,'pro_otroarch',$codigo_proyecto);
                move_uploaded_file($_FILES["otroarch_new"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_otroarch='$new_dire/$nombre_archivo'";
            }

            if ($_FILES["pro_foto1"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto1"]["name"]);
                $nombre_archivo= "foto1.".$extension[1]; 
                delete_archivo($detalle,'pro_foto1',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto1"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto1='$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto2"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto2"]["name"]);
                $nombre_archivo= "foto2.".$extension[1];
                delete_archivo($detalle,'pro_foto2',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto2"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto2 ='$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto3"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto3"]["name"]);
                $nombre_archivo= "foto3.".$extension[1];
                delete_archivo($detalle,'pro_foto3',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto3"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto3='$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto4"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto4"]["name"]);
                $nombre_archivo= "foto4.".$extension[1];
                delete_archivo($detalle,'pro_foto4',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto4"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto4='$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto5"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto5"]["name"]);
                $nombre_archivo= "foto5.".$extension[1];
                delete_archivo($detalle,'pro_foto5',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto5"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto5='$new_dire/$nombre_archivo'";
            }
            if ($_FILES["pro_foto6"]["tmp_name"]!='' ) {
                $extension =   explode('.',$_FILES["pro_foto6"]["name"]);
                $nombre_archivo= "foto6.".$extension[1];
                delete_archivo($detalle,'pro_foto6',$codigo_proyecto);
                move_uploaded_file($_FILES["pro_foto6"]["tmp_name"], $new_dire."/$nombre_archivo");
                $campoUpd.=",pro_foto6='$new_dire/$nombre_archivo'";
            }

            $campoUpd.=($pro_estado=='1') ? ",pro_fechaini=current_date" : ($pro_estado=='2' ? ",pro_fechafin=current_date" : "");

            if ($pro_estado!="") {
                $sql="SELECT pro_estado FROM proyecto WHERE pro_codigo='$codigo_proyecto' ";
                $result = $detalle->getDatos($sql);

                if ($result[0]['pro_estado']!='' && $result[0]['pro_estado']!=$pro_estado ) {
                    $campoUpd.=",pro_estado='$pro_estado' ";
                }
            }

            
            if ($campoUpd!='') {
                $campoUpd=substr($campoUpd, 1);
                $sql="UPDATE proyecto SET         
                        $campoUpd        
                        where pro_codigo='$codigo_proyecto'           
                ";
                // echo '<pre>';
                // print_r($sql);
                // echo '</pre>';
                // die("Termino");
                $result = $detalle->insert($sql);

                $icon="";
                $title="";
                $text="";
                if ($result=='ok' ) {
                    $icon="success";
                    $title="Felicitaciones";
                    $text="Se actualizo el proyecto";                
    
                }else {
                    $icon="error";
                    $title="Lo sentimos";
                    $text="Hubo un problema con el proyecto";
                }
                
                if ($icon!='') {
                    echo"<script>
                            Swal.fire({
                                icon: '$icon',
                                title: '$title',
                                text: '$text'
                            }).then((result) => {                            
                                if (result.isConfirmed) {
                                    window.location = 'proyectos';
                                } 
                            })
                                               
                    </script>";
                }
            }

            
            $detalle->close();
        }

    }
}


function delete_archivo($detalle,$tipo,$pro_codigo) {

   $sql="SELECT $tipo FROM proyecto WHERE pro_codigo='$pro_codigo' ";   
   $result = $detalle->getDatos($sql);

   if (file_exists($result[0][$tipo])) {
        unlink($result[0][$tipo]);
   }
}

?>