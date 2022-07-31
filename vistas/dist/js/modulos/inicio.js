$( document ).ready(function() {
    alerta('alerta');    
    dasboard('ganancias');
});

var entro_alert =true;
function alerta(tipo='') {

    $.ajax({
        url : 'ajax/ajax_proyecto.php',
        type : 'POST',
        data : {tipo:tipo},
        dataType : 'json',
        success : function(json) {

            // console.log(json);
            if(json.status=='success'){
                var res="";
                json.result.forEach(element => {
                    res+=`<span>${element.mensaje}</span><br />`;
                });
                if (entro_alert==true) {                    
                    Swal.fire({
                        title: 'Proyectos pendientes!',
                        html: `${res}`,
                        icon:'info',
                        imageWidth: 400,
                        imageHeight: 200
                    })
                }
                entro_alert =false;
            }

            if(json.status=='error'){
                entro =true;
            }
        }

    });
}

function dasboard(tipo) {

    $("#h3_ingresos").empty();
    $("#h3_gastos").empty();

    $.ajax({
        url : 'ajax/ajax_inicio.php',
        type : 'POST',
        data : {tipo:tipo},
        dataType : 'json',
        success : function(json) {
            console.log(json);
            if(json.status=='success'){
                
                $( "#h3_ingresos" ).append(json.ingresos);

                $( "#h3_gastos" ).append(json.gastos);

                

            }
            if(json.status=='error'){
                document.getElementById('h3_ingresos').value=0;
                document.getElementById('h3_gastos').value=0;
            }
        }
    });
}
