function validaCampos(tipo) {
    if ( document.getElementById('fecha_inicio').value=='') {
        alert('la fecha inicio es obligatorio');
        return;
    }
    if ( document.getElementById('fecha_fin').value=='') {
        alert('la fecha fin es obligatorio');
        return;
    }
    accion(tipo);
}

function accion(tipo) {

    switch (tipo) {
        case 'buscar':
            buscar(tipo);
            break;

    
        default:
            break;
    }

}

function limpiar() {
    document.getElementById('usu_cedula').value='';
    document.getElementById('usu_nombre').value='';
    document.getElementById('fecha_inicio').value='';
    document.getElementById('fecha_fin').value='';
}

function buscar(tipo) {
   

    $.ajax({
        url : 'ajax/ajax_usuarios.php',
        type : 'POST',
        async:false,
        data :  {
                    tipo:tipo                    
                },
        dataType : 'json',
        success : function(json) {
            // console.log(json.result);
            if(json.status=='success'){
                cargarTabla(json.result);
                pluginDataTable('tabla_usu');
            }
            if(json.status=='error'){
                               
            }
        },error:function(e){
            // console.log(e);
        }
    });
}

function cargarTabla(result) {
    $("#body_usu").empty();
  
    var table ="";
    var btn_estado_class="";
    var btn_estado="";
    // console.log(result);
    for (let i = 0; i < result.length; i++) {
        const element = result[i];

        if (element.usu_estado =='1') {
            btn_estado_class="btn btn-success";
            btn_estado="Activo";
        }else{
            btn_estado_class="btn btn-danger";
            btn_estado="Inactivo";
        }
        table +="<tr><td>"+element.usu_rol+"</td>";
        table +="<td>"+element.usu_nombre+"</td>";
        table +="<td>"+element.usu_cuenta+"</td>";
        table +="<td>"+element.usu_foto+"</td>";        
        table +="<td><button class='"+btn_estado_class+"'>"+btn_estado+"</button></td>";
        table +="<td><button class='btn btn-warning'><i class='fas fa-pencil-alt'></i></button>";
        table +="<button class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></td>";        
        table +="</tr>";
    }
    $( "#body_usu" ).append(table);
    
}

function validarImagen() {
    var nombre_imagen = document.getElementById('usu_foto').value;
    var extensiones_permi = /(.jpg|.jpeg|.png|.JPG|.PNG|.JPEG)$/i;
    
    if (!extensiones_permi.exec(nombre_imagen) ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'el archivo no cumple con la extencion',
            showConfirmButton: false,
            timer: 1500
          });        
        document.getElementById('usu_foto').value="";
        return;
    }
}

function validarCampos(event) {
    event.preventDefault();
    var frm_usu= document.getElementById('frm_usu');    
    
    if (document.getElementById('usuario').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo usuario es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
              
        return;
    }
    if (document.getElementById('password').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo contraseña es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
       
        return;
    }
    if (document.getElementById('nombre').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo nombre es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
        return;
    }
    if (document.getElementById('rol').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo rol es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
        return;
    }
    if (document.getElementById('telefono').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo telefono es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
        return;
    }
    if (document.getElementById('correo').value=='') {
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'El campo correo es obligatorio',
            showConfirmButton: false,
            timer: 1500
          });
        return;
    }
    
    frm_usu.submit();

}

$( document ).ready(function() {
    accion('buscar');
});

function pluginDataTable(id) {
    $(`#${id}`).DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo(`#${id}_wrapper .col-md-6:eq(0)`);
}