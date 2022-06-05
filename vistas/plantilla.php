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

        <!-- jQuery -->
        <script src="vistas/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="vistas/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="vistas/dist/js/demo.js"></script>
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
                include "vistas/modulos/inicio.php";
            //FIN::conetnido/body

            //INICIO::footer
                include "vistas/modulos/footer.php";    
            //FIN::footer
            ?>
        </div>
        <!-- ./wrapper -->


    </body>
</html>
