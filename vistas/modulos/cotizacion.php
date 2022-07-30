<script src="vistas/dist/js/modulos/cotizacion.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cotizaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cotizaciones</li>
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
              <label for="">Nombre:</label>                
              <input type="text"  class="form-control" id="nombre_pro" name="nombre_pro" >                        
            </div>            

            <div class="form-group col-md-4">
              <label for="">Fecha inicio:</label>              
                <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" >  
            </div>

            <div class="form-group col-md-4">   
              <label for="">Fecha fin:</label>             
              <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"  >                        
            </div>

            <div class="form-group col-md-2">
              <label for="">Limite:</label>                
              <input type="number" min='0' class="form-control" id="limite" name="limite" value="10" >                        
            </div> 

        </div>

        <div class="card-footer row">

          <div class="col-md-5"></div>

          <div class="col-md-4">
            <button type="button" class="btn btn-primary" onclick="buscar('buscar')" >Buscar</button>
            <button type="button" class="btn btn-primary"  onclick="cleanBusqueda()">Limpiar</button>
          </div>

        </div>

      </div>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" id="btn-cotizacion" data-toggle="modal" data-target="#modal_cotizacion" ><i class="fas fa-plus"> Cotización</i></button>


          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button"  class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive p-0">

          <table class="table table-hover table-striped " id="tabla_cotizacion">

            <thead>
              <tr>
                <th>Nombre</th>
                <th>Tipo de cotización</th>
                <th>Medidas en m2</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Documento</th>
                <th>Acción</th>
              </tr>
            </thead>

            <tbody id="body_cotiza" >              
            </tbody>   

          </table>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- modal de cotizacion -->
<div class="modal  fade " id="modal_cotizacion"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog   modal-lg ">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creación de Cotizacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data" id="forma_cotiza" action="" >
        <div class="modal-body">

          <div class="card"> 

              <div class="card-header row">
                <div class="col-md-6">
                  <h3> Datos de cotización </h3> 
                </div>

                <div class="col-md-6">
                  <input type="hidden"  name="valortot_m2" id="valortot_m2" >                    
                  <h3 id="text_valortot"> <span class="badge badge-secondary">$</span><label id="label_valortot"> 0</label></h3>
                </div>
              </div>

              <div class="card-body row">

                <input type="hidden" name="total_medidas" id="total_medidas" value="" >
                <input type="hidden" name="valor_total" id="valor_total" value="" >
                <input type="hidden" name="tipo" id="tipo" value="nuevo" >
                <input type="hidden" name="tot_confinado" id="tot_confinado" value="" >
                <input type="hidden" name="tot_aporticado" id="tot_aporticado" value="" >
                <input type="hidden" name="vlr_proyecto" id="vlr_proyecto" value="" >
                <input type="hidden" name="tot_proyecto" id="tot_proyecto" value="" >

                <div class="form-group col-md-6">
                  <label for="">Seleciona: </label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_vivienda" id="tipo_vivienda1" value="unifamiliar" 
                       checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Unifamiliar
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_vivienda" id="tipo_vivienda2" value="bifamiliar">
                    <label class="form-check-label" for="exampleRadios2">
                      Bifamiliar
                    </label>
                  </div>                       
                </div>

                <div class="form-group col-md-6">
                  <label for="">Seleciona: </label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="arquitectonico" id="arquitectonico" value="arquitectonico" 
                    onclick="validaDato();">
                    <label class="form-check-label" >
                      Arquitectonico
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="estructural" id="estructural" 
                    onclick="validaDato();"
                    value="estructural">                    
                    <label class="form-check-label" >
                      Estructural
                    </label>
                  </div>                       
                </div>

                <div class="form-group col-md-6" id="aport_confinado" style="display: none;">
                  <label for="">Seleciona: </label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_cotiza" id="confinado" value="confinado" 
                    onclick="validaCamposCoti(this.value);">
                    <label class="form-check-label" for="exampleRadios1">
                      Confinado
                    </label>

                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_cotiza" id="aporticado" onclick="validaCamposCoti(this.value);"
                    value="aporticado">
                    <label class="form-check-label" for="exampleRadios2">
                      Aporticado
                    </label>
                  </div>                       
                </div>

                <div class="form-group col-md-6">
                  <div class="form-check ">

                    <input class="form-check-input" type="checkbox"  id="reconocimiento" name="reconocimiento" onclick="calcula_cotizacion();">          
                    <label for="">Reconocimiento</label>
                  </div>
                  <div class="form-check " >
                    <input class="form-check-input" type="checkbox"  id="obra_nueva" name="obra_nueva" onclick="calcula_cotizacion(); ">   
                    <label for="">Obra nueva</label>
                  </div>                        
                </div>
    
                <div class="form-group col-md-6">
                  <label for="">Numero de Pisos :</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-building" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" id="numero_pisos" name="numero_pisos" onchange="calcula_cotizacion();">
                      <option value='0'>-</option>
                      <?php                      
                        for ($i=1; $i <= 5; $i++) { 
                          echo"<option value='$i'>$i</option>";
                        }
                      ?>
                    </select>
                  </div>              
                </div>

                <div class="form-group col-md-6">

                  <div class="form-check " >
                    <input class="form-check-input" type="checkbox"  id="pro_horizon" name="pro_horizon" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_phorizontal" name="valor_phorizontal">             
                    <label for="">Propiedad Horizontal</label>
                  </div> 

                  <div class="form-check " >
                    <input class="form-check-input" type="checkbox"  id="leva_arqui" name="leva_arqui" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_levanarqui" name="valor_levanarqui">             
                    <label for="">Levantamiento Arquitectonico</label>
                  </div>  

                  <div class="form-check" id="div_estud_suelos" style="display: none;">
                    <input class="form-check-input" type="checkbox"  id="estu_suelos" name="estu_suelos" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_suelos" name="valor_suelos">             
                    <label for="">Estudios de suelos</label>
                  </div>                        
                </div>

                <div class="form-group col-md-6">
                  <label for="">tipo de Medida</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-home" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" id="medidas" name="medidas" onchange="valida_medidas(this.value)">
                      <option value="">-</option>
                      <option value="m2">m2</option>
                      <option value="ancho - fondo">Ancho - Fondo</option>                      
                    </select>
                  </div>              
                </div>

                <div id="ancho_fondo" style="display:none;" class="col-md-6 col-6 row">
                  <div class="form-group col-md-6" >
                    <label for="">Medida Ancho:</label>              
                    <input type="number" min="0" class="form-control" name="ancho" id="ancho"  >                    
                  </div> 
                  <div class="form-group col-md-6">
                    <label for="">Medida Fondo:</label>              
                    <input type="number" min="0" class="form-control" name="fondo" id="fondo"  onkeypress="evento(event)">                    
                  </div>
                </div>

                <div class="form-group col-md-6" style="display:none;" id="medida_m2">
                  <label for="">Medida x m2:</label>              
                  <input type="number" min="0" class="form-control" name="metros_m2" id="metros_m2"  onkeypress="evento(event)">                    
                </div>

                <div class="form-group col-md-6">
                  <label for="">Descuento:</label>              
                  <input type="number" min="0" class="form-control" name="descuento" id="descuento"  onkeypress="evento(event)">                    
                </div>

              </div>

          </div>

          <div class="card">

            <div class="card-header">
              <h4>
                Documentación
              </h4>
            </div>
            <div class="card-body row">

              <div class="form-check form-check-inline col-md-12">

                <div class="col-md-4">
                  <input class="form-check-input" type="checkbox"  id="tradicion" name="tradicion" > Certificado de Tradición
                  <input class="form-check-input" type="hidden" value="" id="valor_tradicion" name="valor_tradicion">                 
                </div>

                <div class="col-md-4">
                  <input class="form-check-input" type="checkbox"  id="curaduria" name="curaduria" > Valor valla curaduría
                  <input class="form-check-input" type="hidden" value="" id="valor_curaduria" name="valor_curaduria">
                </div>

                <div class="col-md-4">
                  <input class="form-check-input" type="checkbox"  id="carta_vecino" name="carta_vecino" > Valor cartas vecinos
                  <input class="form-check-input" type="hidden" value="" id="valor_carta_vecino" name="valor_carta_vecino">
                </div>

                
              </div>  

              <div class="form-group col-md-4">
                <label for="">Cantidad de vecinos:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building" aria-hidden="true"></i></span>
                  </div>
                  <select class="form-control" id="cant_vecinos" name="cant_vecinos">
                    
                    <option value='0'>-</option>
                      <?php                      
                        for ($i=1; $i <= 10; $i++) { 
                          echo"<option value='$i'>$i</option>";
                        }
                      ?>
                  </select>
                </div>              
              </div>

              <div class="form-group col-md-4">
                <label for="">Linea de paramentos:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building" aria-hidden="true"></i></span>
                  </div>
                  <select class="form-control" id="linea_paramentos" name="linea_paramentos" >
                    <option value='0'>-</option>
                    <?php                      
                      for ($i=1; $i <= 8; $i++) { 
                        echo"<option value='$i'>$i</option>";
                      }
                    ?>                 
                  </select>
                  <input type="hidden" name="vlr_linea_parame" id="vlr_linea_parame">
                </div>              
              </div>

            </div>

          </div>

          <div class="card">

            <div class="card-header">
              <H3>Datos del cliente</H3>
            </div>
            <div class="card-body row">
                <input type="hidden" name="cliente_existe" id="cliente_existe">
                <div class="form-group col-md-6">
                  <label for="">Cedula:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input type="text" class="form-control" id="cli_cedula" name="cli_cedula" require onkeypress="evento(event,'cliente')")>
                  </div>              
                </div>

                <div class="form-group col-md-6">
                  <label for="">Nombre completo:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" id="cli_nombre" name="cli_nombre" require>
                  </div>              
                </div>
                <div class="form-group col-md-6">
                  <label for="">Telefono:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone" aria-hidden="true"></i></span>
                    </div>
                    <input type="number" min='0' maxlength="10" class="form-control" id="cli_telefono" name="cli_telefono" >
                  </div>              
                </div>

                
                <div class="form-group col-md-6">
                  <label for="">Email:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" id="cli_email" name="cli_email" require>
                  </div>              
                </div>
                
                <div class="form-group col-md-6">
                  <label for="">Dirección:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-home" aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" id="cli_direccion" name="cli_direccion" require>
                  </div>              
                </div>

                <div class="form-group col-md-6">
                  <label for="">Barrio:</label>                  
                  <input type="text" class="form-control" id="cli_barrio" name="cli_barrio" require>                            
                </div>

                <div class="form-group col-md-6">
                  <label for="">Departamento:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-map" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" id="departamento" name="departamento" onchange="getMunicipio(this.value);">
                      <option value="">-</option>
                      <?php
                        $depart= cotizacionControlador::getDepartamento();
                        foreach ($depart as $dep) {
                          echo"<option value='".$dep['id_departamento']."'>".$dep['departamento']."</option>";
                        }
                      ?>                      
                    </select>
                  </div>              
                </div>

                <div class="form-group col-md-6">
                  <label for="">Municipios:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-map"></i></span>
                    </div>
                    <select class="form-control" id="ciudad" name="ciudad" >                                     
                    </select>
                  </div>              
                </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">           
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>  
          <button type="button" class="btn btn-primary" onclick="validaForma(event);" >Registrar</button>              
          <?php
          
          $ctrCotizacion= new cotizacionControlador();
          $ctrCotizacion->setCotizacion();

          ?>
        </div>
      </form>   
    </div> 
  </div>
</div>

<!-- modal de creacion del proyecto -->
<div class="modal  fade " id="modal_proyecto"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog   modal-lg ">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creación del Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form role="form" method="post" enctype="multipart/form-data" id="forma_proyecto" action="" >
        <div class="modal-body">

          <div class="card">

            <div class="card-body row">
              <input type="hidden"  id="tipo_pro" name="tipo_pro" value="proyecto" >
              <input type="hidden"  id="nombre_archivo" name="nombre_archivo" value="" >
              <input type="hidden"  id="id_cotizacion" name="id_cotizacion" value="" >
                
              <div class="form-group col-md-6">
                <label for="">Nombre del proyecto:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                  </div>
                  <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" require >
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Asignado a:</label> 
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span>
                  </div>
                  <select class="form-control" id="pro_usuario" name="pro_usuario" >
                    <option value="">-</option>
                    <?php
                      $usuario= cotizacionControlador::getUsuario();
                      foreach ($usuario as $usu) {
                        echo"<option value='".$usu['usu_codigo']."'>".$usu['usu_nombre']."</option>";
                      }
                    ?>                      
                  </select>
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Fecha de estimación:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                  </div>
                  <input type="date" class="form-control" id="pro_estimado" name="pro_estimado" require >
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Archivo autocat:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_autocat" name="pro_autocat" require >
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Escritura:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_escritura" name="pro_escritura" require >
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Certificado de tradición:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_certifitradi" name="pro_certifitradi" require >
                </div>              
              </div>

              <div class="form-group col-md-6">
                <label for="">Archivo impuesto predial:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_impredial" name="pro_impredial" require >
                </div>              
              </div>
              <div class="form-group col-md-6">
                <label for="">otro archivo:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_otroarch" name="pro_otroarch" require >
                </div>              
              </div>

              
            </div>
            
          </div>
          
          <div class="card">
  
            <div class="card-header">
              <h4>Registro fotografíco</h4>
            </div>
  
            <div class="card-body row">
              <div class="form-group col-md-6">
                <label for="">Foto 1 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto1" name="pro_foto1" require >
                </div>              
              </div>
  
              <div class="form-group col-md-6">
                <label for="">Foto 2 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto2" name="pro_foto2" require >
                </div>              
              </div>
  
              <div class="form-group col-md-6">
                <label for="">Foto 3 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto3" name="pro_foto3" require >
                </div>              
              </div>
  
              <div class="form-group col-md-6">
                <label for="">Foto 4 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto4" name="pro_foto4" require >
                </div>              
              </div>
  
              <div class="form-group col-md-6">
                <label for="">Foto 5 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto5" name="pro_foto5" require >
                </div>              
              </div>
  
              <div class="form-group col-md-6">
                <label for="">Foto 6 :</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                  </div>
                  <input type="file" class="form-control" id="pro_foto6" name="pro_foto6" require >
                </div>              
              </div>
  
            </div>
            
          </div>
        </div>


        <div class="modal-footer">           
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>  
          <button type="button" class="btn btn-primary" onclick="valida_proyecto(event);" >Crear Proyecto</button>              
          <?php
          
            $ctrProyecto= new proyectoControlador();
            $ctrProyecto->pasarProyecto();

          ?>
        </div>
      </form>    

    </div>
  </div>
</div>

