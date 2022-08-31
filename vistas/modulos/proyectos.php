<script src="vistas/dist/js/modulos/proyectos.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proyectos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Proyectos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">

        <div class="card-header">
          <span>Filtros de Busqueda</span> 

          <div class="card-tools">
           
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>

        </div>

        <div class="card-body row">

            <div class="form-group col-md-4">
              <label for="">Codigo:</label>                
              <input type="number" min='0' class="form-control" id="pro_codigo" name="pro_codigo"  >                        
            </div>

            <div class="form-group col-md-4">
              <label for="">Nombre:</label>                
              <input type="text" min='0' class="form-control" id="proy_nombre" name="proy_nombre" >                        
            </div>

            <?php

              if (in_array($_SESSION['rol'],array('Secretaria','admin')) ) {
                echo'<div class="form-group col-md-4">
                  <label for="">Asignado:</label>    
                    <select class="form-control" id="pro_asignado" name="pro_asignado">
                        <option value="">-</option>
                        ';
                          $usuario= cotizacionControlador::getUsuario();
                          foreach ($usuario as $usu) {
                            echo"<option value='".$usu['usu_codigo']."'>".$usu['usu_nombre']."</option>";
                          }
                          echo' 
                    </select>                                             
                </div>';
              }

            ?>          
            
            <div class="col-md-4">
              <div class="form-group input-group-sm">
                <label for="codigo">Estado:</label>
                <select class="form-control" name="pro_estado" id="pro_estado">
                  <option value="">-</option>
                  <option value="0">Pendiente</option>
                  <option value="1">En proceso</option>
                  <option value="2">Entregado</option>
                </select>
              </div>
            </div>

            <div class="form-group col-md-2">
              <label for="">Fecha inicio:</label>              
                <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" >  
            </div>

            <div class="form-group col-md-2">   
              <label for="">Fecha fin:</label>             
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"  >                        
            </div>

            <div class="form-group col-md-4">
              <label for="">limite:</label>                
              <input type="number" min='0' class="form-control" id="pro_limite" name="pro_limite" value="100" >                        
            </div>

        </div>

        <div class="card-footer row">

          <div class="col-md-5"></div>

          <div class="col-md-4">
            <button type="button" class="btn btn-primary" onclick="buscar('bsucar')">Buscar</button>
            <button type="button" class="btn btn-primary" onclick="cleanFiltros()">Limpiar</button>
          </div>

        </div>

      </div>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Resultados de proyectos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive p-0">

          <table class="table table-hover table-striped" id="table_proyecto">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Asignado</th>
                <th>Barrio</th>
                <th>Fecha entrega</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Estado</th>
                <th>Cotización</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="body_proyectos">
            </tbody>            
          </table>
        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- modal de estado del proyecto-->
<div class="modal  fade " id="modal_proyecto"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog   modal-xl ">
    <div class="modal-content ">

      <div class="modal-header row">
        
        <div class="col-md-6">
          <h4 class="modal-title" >
            <span  id="titulo_proyecto_modal"></span>
          </h4>
          <input type="hidden"  id="pro_nombre" name="pro_nombre" >
        </div>

        <div class="col-md-4">
          <h4>
            <span class="badge badge-warning" id="title_fecha_entrega_mdl"> </span>
          </h4>
          <input type="hidden"  id="pro_estimado" name="pro_estimado"  >
        </div>

        <div class="col-md-2">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <form role="form" method="post" enctype="multipart/form-data" id="forma_proy_upd" action="" >
        <div class="modal-body">

          <input type="hidden" name="codigo_proyecto" id="codigo_proyecto">
          <input type="hidden" name="tipo_proyecto" id="tipo_proyecto">
          <input type="hidden" name="nombre_pro" id="nombre_pro">          
          <input type="hidden" name="usuario_login" id="usuario_login" value="<?php echo $_SESSION['usu_codigo']?>">
          <input type="hidden" name="usuario_rol" id="usuario_rol" value="<?php echo $_SESSION['rol'] ?>">


          <div class="card">

            <div class="card-body row">

              <div class="form-group col-md-6">
                <label for="">Asignado a:</label> 
                <span id="asginado"></span>                           
              </div>

              <div class="col-md-6">
                <div class="form-group input-group-sm">
                  <label for="codigo">Estado:</label>
                  <select class="form-control" name="proyecto_estado" id="proyecto_estado">
                    <option value="">-</option>
                    <option value="0">Pendiente</option>
                    <option value="1">En proceso</option>
                    <option value="2">Curaduria</option>
                    <option value="3">Entregado</option>
                  </select>
                </div>
              </div>

              <div class="form-group col-md-2">
                <label for="">Archivo autocat:</label>

                <div class="row">

                    <div class="btn-group ">
                      <span class="btn btn-primary btn-file">
                        <i class="fas fa-file-upload"></i><input type="file" name="autocat_new" id="autocat_new">
                      </span>
                      <div id="div_autocat" style="display:none ;">
                        <a href="#" class="btn btn-success fas fa-download" id="autocat_descarga" download ></a>
                        <input type="hidden" name="name_autocat" id="name_autocat">
                      </div>
                    </div>

                </div>
                
              </div>

              <div class="form-group col-md-2">
                <label for="">Escritura:</label>

                <div class="row">

                  <div class="btn-group">
                    <span class="btn btn-primary btn-file">
                      <i class="fas fa-file-upload"></i> <input type="file" name="escritura_new" id="escritura_new">
                    </span>
                    <div id="div_escritura" style="display:none ;"> 
                      <a href="#" class="btn btn-success fas fa-download" id="escritura_descarga" download ></a>
                      <input type="hidden" name="name_escritura" id="name_escritura">
                    </div>
                  </div> 

                </div>
           
              </div>

              <div class="form-group col-md-3">
                <label for="">Certificado de tradición:</label>

                <div class="row">

                  <div class="btn-group">
                    <span class="btn btn-primary btn-file">
                      <i class="fas fa-file-upload"></i> <input type="file" name="certifitradi_new" id="certifitradi_new">
                    </span>
                    <div id="div_certifitradi" style="display:none ;">
                      <a href="#" class="btn btn-success fas fa-download" id="certifitradi_descarga" download ></a>
                      <input type="hidden" name="name_certifitradi" id="name_certifitradi">
                    </div>
                  </div> 

                </div>
         
              </div>

              <div class="form-group col-md-2">
                <label for="">impuesto predial:</label>

                <div class="row">

                  <div class="btn-group">
                    <span class="btn btn-primary btn-file">
                      <i class="fas fa-file-upload"></i> <input type="file" name="impredial_new" id="impredial_new">
                    </span>
                    <div id="div_impredial" style="display:none ;">
                      <a href="#" class="btn btn-success fas fa-download" id="impredial_descarga" download ></a>
                      <input type="hidden" name="name_impredial" id="name_impredial">
                    </div>
                  </div> 

                </div>                  
                
              </div>

              <div class="form-group col-md-2">
                <label for="">otro archivo:</label>

                <div class="row">

                  <div class="btn-group">
                    <span class="btn btn-primary btn-file">
                      <i class="fas fa-file-upload"></i> <input type="file" name="otroarch_new" id="otroarch_new">
                    </span>
                    <div id="div_otroarch" style="display:none ;">                  
                      <a href="#" class="btn btn-success fas fa-download" id="otroarch_descarga" download ></a>
                      <input type="hidden" name="name_otroarch" id="name_otroarch">
                    </div>
                  </div> 

                </div>  
                            
              </div>
              
            </div>
            
          </div>
          
          <div class="card">
  
            <div class="card-header">
              <h4>Registro fotografícos</h4>
            </div>
  
            <div class="card-body row">
              <?php
              
                for ($i=1; $i <= 6; $i++) { 
                  echo'<div class="form-group col-md-4">
                        <label for="">Foto '.$i.':</label>
                        <div class="btn-group">
                          <span class="btn btn-primary btn-file">
                            <i class="fas fa-file-upload"></i> <input type="file" name="pro_foto'.$i.'" id="pro_foto'.$i.'">
                          </span>
                          <div id="btn_foto'.$i.'" style="display:none ;">                  
                            <a href="#" class="btn btn-success fas fa-download" id="foto'.$i.'_descarga" download ></a>
                          </div>
                        </div> 
                        <div class="" id="div_foto'.$i.'" style="display:none ;">
                          <img src="#" id="foto'.$i.'_img" class="img-thumbnail previsualizar" width="100px">                  
                          <input type="hidden" name="name_foto'.$i.'" id="name_foto'.$i.'">
                        </div>
                      </div> ';
                }

              ?>
  
            </div>
            
          </div>

          <div class="card" id="div_descripcion" style="display: none;">
            <div class="body" >

              <div class="card direct-chat direct-chat-warning" >
                <div class="card-header">
                  <h3 class="card-title">Descripción</h3>

                  <div class="card-tools">
                    
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" id="text_descrip">

                  </div>
                  <!--/.direct-chat-messages-->

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Describe el trabajo realizado ..." id="input_descripcion" class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-warning" onclick="guardar_descrip();" id="btnDescrip">Guardar</button>
                      </span>
                    </div>
                  </form>
                </div>
                <!-- /.card-footer-->
              </div>




            </div>
          </div>

        </div>


        <div class="modal-footer">           
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>  
          <button type="button" class="btn btn-primary" id="btn_pro_mdl" onclick="validaForma(event);" >Actualizar</button>              
          <?php
          
            $ctrCliente= new proyectoControlador();
            $ctrCliente->actualizar();

          ?>
        </div>
      </form>    

    </div>
  </div>
</div>