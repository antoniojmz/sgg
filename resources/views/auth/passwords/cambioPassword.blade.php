@extends('menu.index')
@section('content')
<div class="row"> 
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <center>
                    <h5 id="spanTitulo" class="card-header-text">Cambio de contraseña</h5>
                </center>
            </div>
            <div class="m-portlet__body">
                {!! Form::open(['id'=>'Formclave','autocomplete' => 'off']) !!}
                    <input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label class="control-label">Contraseña actual:</label>
                            <input type="password" class="form-control inputClear" id="password_old" name="password_old" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label class="control-label">Contraseña nueva:</label>
                            <input type="password" class="form-control inputClear" id="password" name="password" data-fv-different="true" data-fv-different-field="password_old" data-fv-different-message="Las contraseñas no pueden ser iguales" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label class="control-label">Confirme nueva contraseña:</label>
                            <input type="password" class="form-control inputClear" id="password_confirmation" name="password_confirmation" data-fv-identical="true" data-fv-identical-field="password" data-fv-identical-message="Las contraseñas no coinciden" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <button name="cancelar" id="cancelar" type="button" class="btn btn-inverse-primary waves-effect waves-light">
                                Cancelar
                            </button>
                            <button name="aceptar" id="aceptar"  type="button" class="btn btn-primary waves-effect waves-light">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <br>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var ruta = "{{ URL::route('password') }}"
</script>
<script src="/js/cambioPassword/cambioPassword.js"></script>
@endsection
