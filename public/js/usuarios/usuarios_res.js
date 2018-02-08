var RegistroUsuario = RegistroPerfiles = '';
var manejoRefresh=limpiarPerfiles=limpiarUsuarios=errorRut=0;

var parametroAjax = {
    'token': $('input[name=_token]').val(),
    'tipo': 'POST',
    'data': {},
    'ruta': '',
    'async': false
};

var parametroAjaxGet = {
    'token': $('input[name=_token]').val(),
    'tipo': 'GET',
    'data': {},
    'ruta': '',
    'async': false
};

// Manejo Desbloquear cuenta de usuario
var ManejoRespuestaDesbloquearcuenta = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.v_desbloqueo);
        if(res.code==200){
            $.growl({message:"Procesado"},{type: "success", allow_dismiss: true,});    
            cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
        }else{
            $.growl({message:"Ocurrio un error al tratar de desbloquear la cuenta."},{type: "warning", allow_dismiss: true,});
        }
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
}

// Manejo Activar Desactivar perfil
var ManejoRespuestaProcesarP = function(respuesta){
    if(respuesta.code==200){
        cargarTablaPerfiles(respuesta.respuesta.v_perfiles);
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
}

// Manejo Activar / Desactivar usuarios
var ManejoRespuestaProcesarI = function(respuesta){
    if(respuesta.code==200){
        if(respuesta.respuesta.activar>0){
            if(respuesta.respuesta.v_usuarios.length>0){
                $.growl({message:"Procesado"},{type: "success", allow_dismiss: true,});
                cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
            }
        }else{
            $.growl({message:"Debe seleccionar un registro"},{type: "warning", allow_dismiss: true,});
        }
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
}

// Manejo Reinicio de contraseña
var ManejoRespuestaProcesarR = function(respuesta){
    if(respuesta.code==200){
        var res = respuesta.respuesta;
        switch(res.code) {
            case '200':
                $.growl({message:res.des_code},{type: "success", allow_dismiss: true,});
                break;
            case '500':
                $.growl({message:res.des_code},{type: "warning", allow_dismiss: true,});
                break;
            default:
                $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
        } 
    }else{
        $.growl({message:"Contacte al personal informatico"},{type: "danger", allow_dismiss: true,});
    }
}

// Manejo Registro o actualizacion de usuario
var ManejoRespuestaProcesar = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro.f_registro_usuario);
        switch(res.code) {
            case '200':
                $.growl({message:res.des_code},{type: "success", allow_dismiss: true,});
                location.reload();
                // $(".divForm").toggle();
                // $(".divBotonera").toggle();
                // $('#FormUsuario')[0].reset();
                // $(".input").prop('readonly', false);
                // $(".comboclear").prop('disabled', false);
                // cargarTablaUsuarios(respuesta.respuesta.v_usuarios);
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

// Manejo agregar perfil
var ManejoRespuestaProcesarPerfil = function(respuesta){
    if(respuesta.code==200){
        var res = JSON.parse(respuesta.respuesta.f_registro_perfil);
        switch(res.code) {
            case '200':
                $.growl({message:res.des_code},{type: "success", allow_dismiss: true,});
                $(".comboclear").val('').trigger("change");  
                cargarTablaPerfiles(respuesta.respuesta.v_perfiles);
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

var cargarTablaUsuarios = function(data){
    if(limpiarUsuarios==1){destruirTabla('#tablaUsuarios');$('#tablaUsuarios thead').empty();}
        $("#tablaUsuarios").dataTable({ 
            "aLengthMenu": DataTableLengthMenu,
            "pagingType": "full_numbers",
            "language": LenguajeTabla,
            "scrollX": true,
            "scrollY": '45vh',
            "scrollCollapse": true,
            "columnDefs": [
            {
                "targets": [ 1 ],
                "searchable": true
            },
            {"sWidth": "20%", "aTargets": [1]},
            {"sWidth": "15%", "aTargets": [2]},
            {"sWidth": "20%", "aTargets": [5]},
            {"sWidth": "20%", "aTargets": [8]},
            {"sWidth": "10%", "aTargets": [9]},
            {"sWidth": "15%", "aTargets": [10]},
            ],
            "data": data,
            "columns":[
            {"title": "Id","data": "idUser",visible:0},
            {"title": "Nombres","data": "usrNombreFull"},
            {
                "title": "Login", 
                "data": "usrUserName",
                "render": function(data, type, row, meta){
                    if(type === 'display'){
                        data = formateaRut(data, true)
                    }
                    return data;
                }
            },
            {"title": "fecha de creacion","data": "auCreadoEl",visible:0},
            {"title": "Creado id","data": "auCreadoPor",visible:0},
            {"title": "Creado por","data": "creador"},
            {"title": "Teléfono","data": "auModificadoEl",visible:0},
            {"title": "Modificado id","data": "auModificadoPor",visible:0},
            {"title": "Modificado por","data": "modificador"},
            {"title": "Estado","data": "des_estado"},
            {"title": "Última visita","data": "usrUltimaVisita"},
            {"title": "Estatus Bloqueo","data": "DescripcionBloqueo"},
            {
                "title": "Options", 
                "data": "idUser",
                "render": function(data, type, row, meta){
                    var result = `
                    <a href="#!" onclick="reiniciarClave(`+data+`);" class="text-muted" data-toggle="tooltip" data-placement="top" title="Reiniciar Contraseña" data-original-title="Delete">
                        <i class="icon-reload"></i>
                    </a>
                    <a href="#!" onclick="cambiarEstatusUsuario(`+data+`);" class="text-muted" data-toggle="tooltip" data-placement="top" title="Activar / Desactivar" data-original-title="Delete">
                        <i class="icon-refresh"></i>
                    </a>
                    <a href="#!" onclick="desbloquearCuenta(`+data+`);" class="text-muted" data-toggle="tooltip" data-placement="top" title="Desbloquear Cuenta" data-original-title="Delete">
                        <i class="icon-lock-open"></i>
                    </a>`;
                    return result; 
                }
            }],
        });
        limpiarUsuarios=1;
    if (data.length>0){
        seleccionarTablaUsuarios();
    }
};

var seleccionarTablaUsuarios = function(data){
    var tableB = $('#tablaUsuarios').dataTable();
    $('#tablaUsuarios tbody').on('click', 'tr', function (e) {
        tableB.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroUsuario = TablaTraerCampo('tablaUsuarios',this);
    });
    tableB.on('dblclick', 'tr', function () {
        $(".divForm").toggle();
        cargarFormulario();
        pintarDatosActualizar(RegistroUsuario);
    });  
}

var cargarTablaPerfiles = function(data){
    if(limpiarPerfiles==1){destruirTabla('#tablaPerfiles');}
        $("#divTablaPerfiles").show();
        $("#tablaPerfiles").dataTable({ 
            "aLengthMenu": DataTableLengthMenu,
            'bSort': false,
            "scrollCollapse": false,
            "paging": false,
            "searching": false,
            "columnDefs": [
            {
                "targets": [ 1 ],
                "searchable": false
            }],
            "data": data,
            "columns":[
            {"title": "Id","data": "IdUser",visible:0},
            {"title": "Nombres","data": "usrNombreFull"},
            {"title": "Login","data": "usrUserName"},
            {"title": "idPerfil","data": "idPerfil",visible:0},
            {"title": "Perfíl","data": "des_perfil"},
            {"title": "Estado","data": "estado_perfil"},
            ],
        });
        limpiarPerfiles=1;
    if (data.length>0){seleccionarTablaPerfiles();}   
};

var seleccionarTablaPerfiles = function(data){
    var tableC = $('#tablaPerfiles').dataTable();
    $('#tablaPerfiles tbody').on('click', 'tr', function (e) {
        tableC.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        RegistroPerfiles = TablaTraerCampo('tablaPerfiles',this);
    });
    tableC.on('dblclick', 'tr', function () {
        $('#close').trigger('click');
    });
     $(function() {
        $.contextMenu({
            selector: '#tablaPerfiles',
            // selector: '.dataTable tbody tr',
            callback: function(key, options) {
                switch(key) {
                    case "1":
                        cambiarEstatusPerfil(RegistroPerfiles);
                        // cambiarEstatusUsuario(RegistroUsuario);
                    break;
                }
            },
            items: {
                "1": {name: "Activar / Desactivar", icon: "fa-toggle-on"},
            }
        });
    });
};     
var crearallcombos = function(data){
    crearcombo('#idPerfil',data.v_perfiles);
    crearcombo('#usrEstado',data.v_estados);
}

var cargarFormulario= function(){
    $(".divForm").toggle();
}

var volverPerfiles = function(){
    $("#spanTitulo").text("Usuarios registrados");
    if (manejoRefresh==1){
        cambiarSalir();
        location.reload();
    }else{
        $(".divPerfiles").toggle();
        $("#spanAlert").text("");
        $("#divTablaPerfiles").hide();
        $(".comboclear").val('').trigger("change");  
        $("#idUser2").val("")
    }
}

var administrarPerfiles= function(data){
    $("#spanTitulo").text("Administrar Perfiles de usuario");
    manejoRefresh=0;
    $("#idUser2").val(data.idUser)
    buscarPerfiles(data);
    $(".divPerfiles").toggle();
}

var pintarDatosActualizar= function(data){
    $("#spanTitulo").text("Editar Usuario");
    $("#perfiles").text("N/A o Inactivo")
    $('#divConsulta').show();
    $('#divSpanPerfiles').show();
    $("#idUser").val(data.idUser);
    $("#usrUserName").val(data.usrUserName);
    $("#usrEmail").val(data.usrEmail);
    $("#usrNombreFull").val(data.usrNombreFull);
    if(data.des_Perfil!=null){
        var res = data.des_Perfil.split(",");
        var des='';
        res.length>1 ? des="Perfiles" : des="Perfil"
        $("#labelPerfil").text(des);
        $("#perfiles").val(res);
    }
    $("#usrEstado").val(data.usrEstado).trigger("change");
    if(data.usrUltimaVisita!=null){
        $("#usrUltimaVisita").val(data.usrUltimaVisita);
    }else{
        $("#usrUltimaVisita").val("Desconocido");

    }
    if(data.auCreadoEl!=null){
        $("#auCreadoEl").val(data.auCreadoEl);
    }else{
        $("#auCreadoEl").val("Desconocido");
    }
    if(data.creador!=null){
        $("#creador").val(data.creador);
    }else{
        $("#creador").val("Desconocido");
    }
    if(data.auModificadoEl!=null){
        $("#auModificadoEl").val(data.auModificadoEl);
    }else{
        $("#auModificadoEl").val("Desconocido");
    }
    if(data.modificador!=null){$("#modificador").val(data.modificador);}
}

var BotonVolver = function(){
    if (manejoRefresh==1){location.reload();}else{
        $("#spanTitulo").text("Usuarios registrados");
        $(".divForm").toggle();    
        $('#divConsulta').hide();
        $('#FormUsuario')[0].reset();
        $("#idUser").val("");
        $('#divSpanPerfiles').hide();
        // mostrarDesconocidos();
        $(".input").prop('readonly', true);
        $(".comboclear").prop('disabled', true);
    }
}
var BotonCancelar = function(){
    // if (volverNuevo==1){
    //     BotonVolver();   
    // }
    // $("#btn-volver").show();
    // $("#divBtnAdmin").show();
    // $("#divBtnModificar").show();
    $(".divForm").toggle();
    // $(".divBotonera").toggle();
    $(".input").prop('readonly', true);
    $(".comboclear").prop('disabled', true);

}

var mostrarDesconocidos = function(){
    $("#usrUltimaVisita").text("Desconocido");
    $("#auCreadoEl").text("Desconocido");
    $("#creador").text("Desconocido");
    $("#auModificadoEl").text("Desconocido");
    $("#modificador").text("Desconocido");
}

var BotonAgregar = function(){
    $(".divBotonera").toggle(); 
    $(".input").prop('readonly', false);
    $(".comboclear").prop('disabled', false);
    $("#spanTitulo").text("Registrar Usuario");
    cargarFormulario();
    mostrarDesconocidos();
    $("#divConsulta").hide();
    $("#divSpanPerfiles").hide();
    $("#idUser").val("");
    $(".comboclear").val('').trigger("change");
    $('#FormUsuario')[0].reset();
}

var BotonAgregarPerfil = function(){
    var data = {'idPerfil': $('#idPerfil').val(),'idUser': $('#idUser2').val()};
    parametroAjax.ruta = rutaP;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarPerfil(respuesta);
}


var ProcesarUsuario = function(){
    if (errorRut==0){
        var camposNuevo = {'usrEstado': $('#usrEstado').val()}
        parametroAjax.ruta=ruta;
        parametroAjax.data = $("#FormUsuario").serialize() + '&' + $.param(camposNuevo);
        respuesta=procesarajax(parametroAjax);
        ManejoRespuestaProcesar(respuesta);
    }
};

var buscarPerfiles = function(data){
    parametroAjaxGet.ruta=rutaP;
    parametroAjaxGet.data = data;
    respuesta=procesarajax(parametroAjaxGet);
    ManejoRespuestaProcesarP(respuesta);
};

var reiniciarClave = function(idUser){
    parametroAjax.ruta=rutaR;
    parametroAjax.data = {idUser:idUser};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarR(respuesta);
}

var validador = function(){
    $('#FormUsuario').formValidation('validate');
};

var validadorPerfil = function(){
    $('#FormPerfil').formValidation('validate');
};

var cambiarEstatusUsuario = function(idUser){
    parametroAjax.ruta=rutaA;
    parametroAjax.data = {idUser:idUser};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarI(respuesta);
}

var desbloquearCuenta = function(idUser){
    parametroAjax.ruta=rutaDC;
    parametroAjax.data = {idUser:idUser};
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaDesbloquearcuenta(respuesta);
}


var cambiarEstatusPerfil = function(data){
    manejoRefresh=1;
    parametroAjax.ruta=rutaAP;
    parametroAjax.data = data;
    respuesta=procesarajax(parametroAjax);
    ManejoRespuestaProcesarP(respuesta);
}

var verificarRut = function(control){
    var res = Valida_Rut(control);
    var format = formateaRut(control.val(), res);
    if (format != false){
        errorRut = 0;       
        $("#ErrorRut").text("");
        return format;
    }else{
        errorRut = 1;       
        $("#ErrorRut").text("Rut invalido");
        return control.val();
    }
}

var desbloquearInputs = function(){
    $(".divBotonera").toggle();
    $(".input").prop('readonly', false);
    $(".comboclear").prop('disabled', false);
}

$(document).ready(function(){
    $("#spanTitulo").text("Usuarios registrados");
    $("#usrUserName").focusout(function() {
        var valid = $("#usrUserName").val();
        if (valid.length > 0){
            var res = verificarRut($("#usrUserName"));
            $("#usrUserName").val(res);
        }else{$("#ErrorRut").text("");}
    });
	cargarTablaUsuarios(d.v_usuarios);
    crearallcombos(d);    
    $(document).on('click','#guardar',validador);
    $(document).on('click','#cancelar',BotonCancelar);
    $(document).on('click','#agregar',BotonAgregar);
    $(document).on('click','#btn-volver',BotonVolver);
    $(document).on('click','#agregarP',validadorPerfil);
    $(document).on('click','#volverPerfiles',volverPerfiles);
    $(document).on('click','#modificar',desbloquearInputs);
    $('#FormUsuario').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'usrUserName': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            }, 
            'usrNombreFull': {
                verbose: false,
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                }
            },            
            'usrEmail': {
                validators: {
                    notEmpty: {
                        message: 'El campo es requerido.'
                    },
                    emailAddress: {
                        message: 'Ingrese una dirección de correo valida'
                    }
                }
            },
            'usrEstado': {
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
        ProcesarUsuario();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });

    
    $('#FormPerfil').formValidation({
        excluded:[':disabled'],
        // message: 'El módulo le falta un campo para ser completado',
        fields: {
            'idPerfil': {
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
        BotonAgregarPerfil();
    })
    .on('status.field.fv', function(e, data){
        data.element.parents('.form-group').removeClass('has-success');
    });
});