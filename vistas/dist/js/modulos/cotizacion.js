function valida_medidas(tipo) {
    if (tipo === 'ancho - fondo') {
        document.getElementById('ancho_fondo').style.display='';
        document.getElementById('medida_m2').style.display='none';
        document.getElementById('metros_m2').value='';
        return;
    }

    if (tipo === 'm2') {
        document.getElementById('medida_m2').style.display='';
        document.getElementById('ancho_fondo').style.display='none';
        document.getElementById('ancho').value='';
        document.getElementById('fondo').value='';
        return;
    }

    document.getElementById('ancho_fondo').style.display='none';
    document.getElementById('medida_m2').style.display='none';
    document.getElementById('metros_m2').value='';
    document.getElementById('ancho').value='';
    document.getElementById('fondo').value='';

}

function validaCamposCoti(valor) {

    if (valor==='confinado') {        
        document.getElementById('div_estud_suelos').style.display='none';
        document.getElementById('estu_suelos').checked=false;
        calcula_cotizacion();
        return;
    }

    if (valor==='aporticado') {
        document.getElementById('div_estud_suelos').style.display='';
        calcula_cotizacion();
        return;
    }
}

function evento(event) {

    if (event.keyCode==13) {

        calcula_cotizacion();        

    }
}

function valid_check(check,id) {
    
    if (!check.checked) {
        document.getElementById(id).value='';
    }
}



function getValores() {

    $.ajax({
        url : 'ajax/ajax_cotizacion.php',
        type : 'POST',
        data : {tipo:'valores'},
        dataType : 'json',
        success : function(json) {
            
            if(json.status=='success'){
                document.getElementById('valor_recono').value=json.result[0]['valor_reco'];
                document.getElementById('valor_obranueva').value=json.result[0]['valor_obranue'];
                document.getElementById('valor_phorizontal').value=json.result[0]['valor_prohori'];
                document.getElementById('valor_levanarqui').value=json.result[0]['valor_aqui'];
                document.getElementById('valor_suelos').value=json.result[0]['valor_suelos'];                
            }
            if(json.status=='error'){
                document.getElementById('valor_recono').value=0;
                document.getElementById('valor_obranueva').value=0;
                document.getElementById('valor_phorizontal').value=0;
                document.getElementById('valor_levanarqui').value=0;
                document.getElementById('valor_suelos').value=0; 
            }
        }
    });
    
}

function calcula_cotizacion() {
    getValores();    

    let reconocimiento  = document.getElementById('reconocimiento').checked;
    let pisos_recon     = document.getElementById('pisos_recon').value;
    let obra_nueva      = document.getElementById('obra_nueva').checked;
    let pisos_obra      = document.getElementById('pisos_obra').value;
    let pro_horizon     = document.getElementById('pro_horizon').checked;
    let leva_arqui      = document.getElementById('leva_arqui').checked;
    let estu_suelos     = document.getElementById('estu_suelos').checked;
    let medidas         = document.getElementById('medidas').value;
    let metros_m2       = document.getElementById('metros_m2').value;
    let ancho           = document.getElementById('ancho').value;
    let fondo           = document.getElementById('fondo').value;

    let valor_recono        = document.getElementById('valor_recono').value;
    let valor_obranueva     = document.getElementById('valor_obranueva').value;
    let valor_phorizontal   = document.getElementById('valor_phorizontal').value;
    let valor_levanarqui    = document.getElementById('valor_levanarqui').value;
    let valor_suelos        = document.getElementById('valor_suelos').value;

    let metros_cuadrados=0;
    let sub_valor=0;
    let valor_total=0;

    var valido_check=validaCheck(reconocimiento,obra_nueva);

    if (valido_check) {    

        metros_cuadrados= (medidas == 'ancho - fondo') ? ancho * fondo : metros_m2;
        
        valor_recon     =(reconocimiento)   ? parseInt(valor_recono)        : 0;
        valor_obranue   =(obra_nueva)       ? parseInt(valor_obranueva)     : 0;
        valor_phori     =(pro_horizon)      ? parseInt(valor_phorizontal)   : 0;
        valor_arqui     =(leva_arqui)       ? parseInt(valor_levanarqui)    : 0;
        valor_suelos    =(estu_suelos)      ? parseInt(valor_suelos)        : 0;
    
        sub_valor = (pisos_recon>0 && reconocimiento==true) ? (metros_cuadrados * pisos_recon):0;
        sub_valor += (pisos_obra>0 && obra_nueva==true) ? (metros_cuadrados * pisos_obra) :0;
        valor_total= (sub_valor * (valor_recon+valor_obranue+valor_phori+valor_arqui))+valor_suelos;        
    }
    
    document.getElementById('label_valortot').innerHTML= new Intl.NumberFormat().format(valor_total);

    document.getElementById('valor_total').value=valor_total;

    document.getElementById('total_medidas').value=metros_cuadrados;
}

function validaCheck(reconocimiento,obra_nueva) {
    
    if (obra_nueva===true && reconocimiento===true) {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Lo sentimos',
            text:'solo puedes escoger reconocimiento o obras nuevas',
            showConfirmButton: false,
            timer: 1500
          }); 
        document.getElementById('obra_nueva').checked=false;
        document.getElementById('pisos_obra').value='';
        document.getElementById('reconocimiento').checked=false;
        document.getElementById('pisos_recon').value='';
        calcula_cotizacion();
        return false;
    }

    if (reconocimiento===true ) {       
        document.getElementById('obra_nueva').checked=false;
        document.getElementById('pisos_obra').value='';
        return true;
    }
    
    
    if (obra_nueva===true ) {       
        document.getElementById('reconocimiento').checked=false;
        document.getElementById('pisos_recon').value='';
        return true;
    }

    return true;
}

function getMunicipio(depart) {
    $.ajax({
        url : 'ajax/ajax_cotizacion.php',
        type : 'POST',
        data : {tipo:'ciudad',depart:depart},
        dataType : 'json',
        success : function(json) {
            // console.log(json);
            if(json.status=='success'){
                $("#ciudad").empty();
                var option="<option value=''>-</option>"
                json.result.forEach(element => {
                    option+=`<option value='${element.id_municipio}'>${element.municipio}</option>`;
                });
                $( "#ciudad" ).append(option);
            }
            if(json.status=='error'){
                $("#ciudad").empty();
                option="<option value=''>Seleccion invalida</option>"
                $( "#ciudad" ).append(option);
            }
        },beforeSend: function(){
            $("#ciudad").val('Validando...')
        }
    });
}

function validaForma(event) {
    event.preventDefault();
    let result=false;
    var forma_cotiza= document.getElementById('forma_cotiza');    

    result= valida_campos('total_medidas','Debes llenar los metro cuadrados');
    if (!result) return;
    result= valida_campos('cli_cedula','El campo cedula es obligatorio');
    if (!result)return;
    result= valida_campos('cli_nombre','El campo nombre es obligatorio');
    if (!result)return;
    result= valida_campos('cli_telefono','El campo telefono es obligatorio');
    if (!result)return;
    result= valida_campos('cli_email','El campo email es obligatorio');
    if (!result)return;
    result= valida_campos('departamento','El campo departamento es obligatorio');
    if (!result)return;
    result= valida_campos('cli_direccion','El campo dirección es obligatorio');
    if (!result)return;
    result= valida_campos('cli_barrio','El campo barrio es obligatorio');
    if (!result)return;
    result= valida_campos('ciudad','El campo municipios es obligatorio');
    if (!result)return;
 
    if (result) forma_cotiza.submit();

}

function valida_campos(id,msj) {

    if (document.getElementById(id).value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: `${msj}`,
            showConfirmButton: false,
            timer: 1500
          });
              
        return false ;
    }

    return true;
}
