var RegistroUnidades  = '';
var manejoRefresh=limpiarUnidades=errorRut=0;

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var ManejoRespuestaProcesarD = function(respuesta){
    if(respuesta.code==200){
        $(".divDetalles").toggle();
        pintarDatosDetalles(respuesta.respuesta.v_detalles[0]);
        cargarTablaBodegas(respuesta.respuesta.v_bodegas);
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});       
    }

}
// Manejo Activar / Desactivar empresa
var ManejoRespuestaProcesarI = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.activar>0){
            if(respuesta.respuesta.v_familias.length>0){
                $.growl({message:"Procesado"},{type: "success", allow_dismiss: true,});
                cargarTablaFamilias(respuesta.respuesta.v_familias);
            }
        }else{
            $.growl({message:"Debe seleccionar un registro"},{type: "warning", allow_dismiss: true,});
        }
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
}

// Manejo Registro o actualizacion de empresa
var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro.f_registro_familia);
        switch(res.code) {
            case '200':
                $.growl({message:res.des_code},{type: "success", allow_dismiss: true,});
                $(".divForm").toggle();
                $('#FormFamilia')[0].reset();
                $('#IdFamilia').val("");
                cargarTablaFamilias(respuesta.respuesta.v_familias);
                break;
            case '-2':
                $.growl({message:res.des_code},{type: "warning", allow_dismiss: true,});
                break;
            default:
                $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
                break;
        } 
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
};

var cargarTablaFamilias = function(data){
    if(limpiarUnidades==1){destruirTabla('#tablaFamilias');$('#tablaFamilias thead').empty();}
        $("#tablaFamilias").dataTable({ 
            "aLengthMenu": DataTableLengthMenu,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "scrollX": true,
            "scrollY": '45vh',
            "scrollCollapse": true,
            "columnDefs": [
                {"targets": [ 1 ],"searchable": true},
                {"sWidth": "1px", "aTargets": [8]}
            ],
            "data": data,
            "columns":[
            {"title": "IdFamilia","data": "IdFamilia",visible:0},
            {"title": "Nombre","data": "NombreFamilia"},
            {"title": "fecha de creacion","data": "auFechaCreacion"},
            {"title": "Usuario creacion","data": "auUsuarioCreacion",visible:0},
            {"title": "Creado por","data": "creador"},
            {"title": "auModificadoPor","data": "auUsuarioModificacion",visible:0},
            {"title": "auUsuarioModificacion","data": "auFechaModificacion",visible:0},
            {"title": "Modificado por","data": "modificador"},
            {"title": "Estado","data": "DesEstadoFamilia"},
            {
                "title": "Opciones", 
                "data": "IdFamilia",
                "render": function(data, type, row, meta){
                    var result = `
                    <center>
                    <a href="#" onclick="cambiarEstatusUnidad(`+data+`);" class="text-muted" data-toggle="tooltip" data-placement="top" title="Activar / Desactivar" data-original-title="Delete">
                        <i class="icofont icofont-ui-delete"></i>
                    </a>
                    </center>`;
                    return result; 
                }
            }
                ],
        });
        limpiarUnidades=1;
    if (data.length>0){seleccionarTablaFamilias();}
};

var seleccionarTablaFamilias = function(data){
    var tableB = $('#tablaFamilias').dataTable();
    $('#tablaFamilias tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroUnidades = TablaTraerCampo('tablaFamilias',this);
    });
    $('#tablaFamilias tbody').on('dblclick', 'tr', function () {
        bloquearInuts();
        $("#divVolver").show();
        $("#divBtnModificar").show();
        $("#divBtnAceptar").hide();  
        cargarFormulario();
        pintarDatosActualizar(RegistroUnidades);
    }); 
}

var cargarFormulario= function(){
    $(".divForm").toggle();
}

var pintarDatosActualizar= function(data){
    $(".md-form-control").addClass("md-valid");
    $("#spanTitulo").text("Editar Familia");
    $("#IdFamilia").val(data.IdFamilia);
    $("#IdUnidadMedida").val(data.IdUnidadMedida);
    $("#NombreFamilia").val(data.NombreFamilia);
    $("#EstadoFamilia").val(data.EstadoFamilia).trigger("change");
}

var BotonCancelar = function(){
    $(".md-form-control").removeClass("md-valid");
    $("#spanTitulo").text("Familias registradas");
    $(".divForm").toggle();    
    $('#divConsulta').hide();
    $('#FormFamilia')[0].reset();
    $("#IdFamilia").val("");
    $('#divSpanPerfiles').hide();
}

var BotonAgregar = function(){
    $("#spanTitulo").text("Registrar Familia");
    $("#divBtnModificar").hide();
    $("#divVolver").hide();
    $("#divBtnAceptar").show();
    cargarFormulario();
    $("#divConsulta").hide();
    $("#divSpanPerfiles").hide();
    $("#IdFamilia").val("");
    $(".comboclear").val('').trigger("change");
    $('#FormFamilia')[0].reset();
    desbloquearInuts();
}

var ProcesarUnidad = function(){
    if (errorRut==0){  
        var camposNuevo = {
            'EstadoFamilia': $('#EstadoFamilia').val()
        }
        parametroAjax.ruta=ruta;
        parametroAjax.data = $("#FormFamilia").serialize() + '&' + $.param(camposNuevo);
        respuesta=procesarajax(parametroAjax);
        ManejoRespuestaProcesar(respuesta);
    }
};

var validador = function(){
    $('#FormFamilia').formValidation('validate');
};

var cambiarEstatusUnidad = function(IdFamilia){
    parametroAjax.ruta=rutaA;
    parametroAjax.data = {IdFamilia:IdFamilia};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarI(respuesta);
}

var bloquearInuts = function(){
    $("#NombreFamilia").prop('readonly', true);
    $("#EstadoFamilia").prop('disabled', true);
}

var desbloquearInuts = function(){
    $("#NombreFamilia").prop('readonly', false);
    $("#EstadoFamilia").prop('disabled', false);
}

var modificarFamilia = function(){
    $("#divBtnModificar").hide();
    $("#divBtnAceptar").show();
    desbloquearInuts();    
}

var crearAllSelect = function(data){
    crearselect(data.v_estados,"EstadoFamilia");
}

$(document).ready(function(){
    $("#spanTitulo").text("Familias registradas");
    cargarTablaFamilias(d.v_familias);
    crearAllSelect(d);
    $(document).on('click','#guardar',validador);
    $(document).on('click','#cancelar',BotonCancelar);
    $(document).on('click','#agregar',BotonAgregar);
    $(document).on('click','#modificar',modificarFamilia);
    $(document).on('click','#volverAct',BotonCancelar);
    $('#FormFamilia').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'NombreFamilia': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            }, 
            'EstadoFamilia': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },            
        }
    })
    .on('success.form.fv', function(e){
        ProcesarUnidad();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});