<script src="vistas/dist/js/modulos/login.js"></script>


<section class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Diconspro</b></a>
            </div>
            <div class="card-body">
                 <p class="login-box-msg">Inicia sesión</p>
        
                <form action="" method="post">

                    <input type="hidden" name="tipo" id="tipo" value="login">
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="log_usuario" id="log_usuario" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="log_password" id="log_password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">              
                        <idv class="col-md-4"></idv>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" >Ingresar</button>
                        </div>

                        <?php
                            $login = new usuarioControlador();
                            $login->ctrLogin();
                        ?>
                    
                    </div>
                </form>
                 <!-- /.social-auth-links -->
                <p class="mb-1">
                    <a href="#" data-toggle="modal" data-target="#consultar_cotizacion" >Consultar proyecto</a>
                </p>
            
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</section>

<!-- modal de estado del proyecto-->
<div class="modal  fade " id="consultar_cotizacion"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog   modal-xl ">
    <div class="modal-content ">

        <div class="modal-header row">
            
            <div class="col-md-6">

            <h4 class="modal-title" > 
                Consulta tu proyecto          
            </h4>
            
            </div>

            <div class="col-md-2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        </div>

    

        <div class="modal-body">

            <!-- FILTROS DE BUSQUEDA  -->
                <div class="card">

                    <div class="card-header">
                        <h4>Filtro de busqueda</h4>
                    </div>

                    <div class="card-body row">

                        <div class="form-group col-md-12">
                            <label for="valor">Nombre:</label>
                            <input type="text" class="form-control" id="nombre_filtro" name="nombre_filtro" value="" placeholder="Escribe el nombre del proyecto....">
                        </div>
                        
                    </div>

                    <div class="card-footer row">
                        <div class="col-md-5"></div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" onclick="buscar('buscar')">Buscar</button>
                            <button type="button" class="btn btn-secundary" onclick="clean_consulta()">Limpiar</button>
                        </div>
                    </div>

                </div>
            <!-- FIN FILTROS DE BUSQUEDA  -->
              
            <!-- DETALLE DE BUSQUEDA  -->
                <div class="card">

                    <div class="card-header">
                        <h4>Detalle de busqueda</h4>
                    </div>

                    <div class="card-body row">

                        <div class="col-md-12 table-responsive p-0" >
                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>PDF</th>
                                    </tr>
                                </thead>
                                <tbody id="body_consulta">
                                    
                                </tbody>
                                
                            </table>
                        </div>
                        
                    </div>



                </div>
            <!-- FIN DETALLE DE BUSQUEDA  -->
            

        </div>


        <div class="modal-footer">           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>               
        </div>
        

    </div>
  </div>
</div>