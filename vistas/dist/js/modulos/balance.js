$( document ).ready(function() {
    buscar('buscar');    
    
});


function buscar(tipo) {

    if(document.getElementById('bal_nombre')) var bal_nombre =document.getElementById('bal_nombre').value;
    if(document.getElementById('fecha_ini')) var fecha_ini =document.getElementById('fecha_ini').value;
    if(document.getElementById('fecha_fin')) var fecha_fin =document.getElementById('fecha_fin').value;
    if(document.getElementById('limite')) var limite =document.getElementById('limite').value;
    
    $.ajax({
        url : 'ajax/ajax_balance.php',
        type : 'POST',
        data : {tipo:tipo,bal_nombre:bal_nombre,fecha_ini:fecha_ini,fecha_fin:fecha_fin,limite:limite},
        dataType : 'json',
        success : function(json) {
            console.log(json);
            if(json.status=='success'){
                llenarTabla(json.result);
            }
            if(json.status=='error'){
                
            }
        }
    });
}

function llenarTabla(result) {

    $("#body_balance").empty();

    result.forEach(element => {

        btn_delete=(element.cot_estado==0)? "danger" : "success"; 
        name_delete=(element.cot_estado==0)? "Inactivo" : "Activo"; 

        var tab =`<tr>`;
        tab +=`<td>${element.bal_id}</td>`;
        tab +=`<td>${element.cot_nombre}</td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i> 40% </small> $ ${element.bal_proveedor}</td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i> 20% </small> $ ${element.bal_ingresos}</td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i> ${element.bal_porcentaje}% </small></td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i>  </small> $ ${element.bal_sesenta}</td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i>  </small> $ ${element.bal_cuarenta}</td>`;
        tab +=`<td>${element.fecha}</td>`;
        tab +=`<td><small class="text-success mr-1"><i class="fas fa-arrow-up"></i> $ ${element.bal_total}</td>`;
    
        tab +=`</tr>`;
    
        $( "#body_balance" ).append(tab);
    });

}