$( document ).ready(function() {
    alerta('alerta');    
    
});
var entro =false;
function alerta(tipo='') {

    $.ajax({
        url : 'ajax/ajax_proyecto.php',
        type : 'POST',
        data : {tipo:tipo},
        dataType : 'json',
        success : function(json) {

            // console.log(json);
            if(json.status=='success'){
                entro =true;
                var res="";
                json.result.forEach(element => {
                    res+=`<span>${element.mensaje}</span><br />`;
                });

                Swal.fire({
                    title: 'Proyectos pendientes!',
                    html: `${res}`,
                    imageWidth: 400,
                    imageHeight: 200
                })
            }
            if(json.status=='error'){
                entro =false;
            }
        }

    });
}