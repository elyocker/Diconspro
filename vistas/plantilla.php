<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>AdminLTE 3 | Blank Page</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
         <!-- =======================================================
            SCRIPTS
         ======================================================= -->
        <!-- jQuery -->
        <script src="vistas/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="vistas/dist/js/adminlte.min.js"></script> 
        <!-- SweetAlert2 -->
        <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="vistas/plugins/jszip/jszip.min.js"></script>
        <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- <script src="vistas/dist/js/demo.js"></script> -->
    </head>
    <body class="hold-transition sidebar-mini">

        <div class="wrapper">        
            <?php
            //INICIO::menu de arriba
                include "vistas/modulos/cabezote.php";
            //FIN::menu de arriba

            //INICIO::menu lateral
                include "vistas/modulos/sidebar.php";
            //FIN::menu lateral

            //INICIO::conetnido/body
                $vista = (isset($_GET["vista"])) ? $_GET["vista"] : "";

                if ($vista !='' ) {
                   if (in_array($vista,array('usuarios','inicio') )) {
                       include "vistas/modulos/".$vista.".php";
                   }
                }else {
                    include "vistas/modulos/inicio.php";
                }

            //FIN::conetnido/body

            //INICIO::footer
                include "vistas/modulos/footer.php";    
            //FIN::footer
            ?>
        </div>
        <!-- ./wrapper -->


    </body>
</html>
