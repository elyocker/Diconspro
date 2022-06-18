<script src="vistas/dist/js/modulos/cotizacion.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bienvenido al Dahsboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Pagina principal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-primary" id="btn-cotizacion" data-toggle="modal" data-target="#modal_cotizacion" ><i class="fas fa-plus"> Cotización</i></button>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <div class="row">
              <!-- inicio de cards -->
              <div class="col-lg-4 col-6">
                <div class="small-box bg-info">

                  <div class="inner">
                    <h3>150</h3>
                    <p>Cotizaciones</p>
                  </div>

                  <div class="icon">
                    <i class="fas fa-user"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas informacion... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                  
                  <div class="inner">
                    <h3>150.000</h3>
                    <p>Ganancias</p>
                  </div>

                  <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas informacion... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                  
                  <div class="inner">
                    <h3>1.500.000</h3>
                    <p>Gastos Mensuales</p>
                  </div>

                  <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mas informacion... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- fin de cards -->
            </div>
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

<!-- modal de update  -->
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
              <div class="car-header row">
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
                    <input class="form-check-input" type="radio" name="tipo_cotiza" id="confinado" value="confinado" 
                    onclick="validaCamposCoti(this.value);"checked>
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
                  <label for="">Reconocimiento:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="reconocimiento" name="reconocimiento" onclick="calcula_cotizacion(); valid_check(this,'pisos_recon');">   
                    <input class="form-check-input" type="hidden" value="" id="valor_recono" name="valor_recono">             
                  </div>                        
                </div>
    
                <div class="form-group col-md-6">
                  <label for="">Pisos Reconocimiento:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-building" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" id="pisos_recon" name="pisos_recon" onchange="calcula_cotizacion();">
                      <option value="0">-</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>              
                </div>
    
                <div class="form-group col-md-6">
                  <label for="">Obra nueva:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="obra_nueva" name="obra_nueva" onclick="calcula_cotizacion(); valid_check(this,'pisos_obra');">   
                    <input class="form-check-input" type="hidden" value="" id="valor_obranueva" name="valor_obranueva">             
                  </div>                        
                </div>

                <div class="form-group col-md-6">
                  <label for="">Pisos Obra nueva:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-building" aria-hidden="true"></i></span>
                    </div>
                    <select class="form-control" id="pisos_obra" name="pisos_obra" onchange="calcula_cotizacion();">
                      <option value="0">-</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>              
                </div>

                <div class="form-group col-md-6">
                  <label for="">Propiedad Horizontal:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="pro_horizon" name="pro_horizon" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_phorizontal" name="valor_phorizontal">             
                  </div>                        
                </div>

                <div class="form-group col-md-6">
                  <label for="">Levantamiento Arquitectonico:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="leva_arqui" name="leva_arqui" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_levanarqui" name="valor_levanarqui">             
                  </div>                        
                </div>

                <div class="form-group col-md-6" id="div_estud_suelos" style="display: none;">
                  <label for="">Estudios de suelos:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="estu_suelos" name="estu_suelos" onclick="calcula_cotizacion();">   
                    <input class="form-check-input" type="hidden" value="" id="valor_suelos" name="valor_suelos">             
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

              </div>

            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <H3>Datos del cliente</H3>
            </div>
            <div class="card-body row">

                <div class="form-group col-md-6">
                  <label for="">Cedula:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                    </div>
                    <input type="text" class="form-control" id="cli_cedula" name="cli_cedula" require >
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

          <div class="modal-footer">           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>  
            <button type="button" class="btn btn-primary" onclick="validaForma(event);" >Registrar</button>              
            <?php
            
            $ctrCotizacion= new cotizacionControlador();
            $ctrCotizacion->setCotizacion();

            ?>
          </div>
        </div>
      </form>    
  </div>
</div>
