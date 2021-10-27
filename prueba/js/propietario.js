$(obtener_registros());

function obtener_registros(consulta){
    $.ajax({
        url: 'consulta_prop.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta}
    })
    .done(function(resultado){
        $("#tabla_propietario").html(resultado);
    })
}

$(document).on('keyup','#busqueda',function(){
    var valorBusqueda=$(this).val();
    if(valorBusqueda!=""){
        obtener_registros(valorBusqueda);
        
    }else{
        obtener_registros();
    }
})

