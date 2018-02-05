@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row" style="margin-top: 15%">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="sign-in-up">
                <div class="sign-in-up-left"><i class="icofont icofont-users f-64" aria-hidden="true"></i></div>
                <div class="sign-in-up-right">
                    <div class="row divLogin">
                        <div class="text-center">
                            <p class="SpanTitulo">
                                Inicio de sesión
                            </p>
                            <br>
                        </div>
                        <div>
                            <form id="FormLogin" class="form-horizontal" novalidate>
                                <div class="md-input-wrapper form-group">
                                    <input type="text" class="md-form-control md-static" name="usrUserName" id="usrUserName" value="25834147-3" />
                                    <label>Login</label>
                                </div>
                                <div class="md-input-wrapper form-group">
                                    <input type="password" class="md-form-control md-static" name="usrPassword" id="usrPassword" value="123456" />
                                    <label>Password</label>
                                </div>
                                <div class="md-float-group b-none m-b-20">
                                    <div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
                                        <label class="input-checkbox checkbox-primary">
                                            <input type="checkbox" id="checkbox1">
                                            <span class="checkbox"></span>
                                        </label>
                                        <label for="checkbox" class="captions">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center m-b-20">
                                    <button id="EnviarLogin" type="button" class="btn btn-primary waves-effect">
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </form>

                            <div class="text-center">
                                <p>
                                    <a href="#" id="LinkForgot">
                                        Olvido su contraseña?
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row divLogin" style="display:none;">
                        <div>
                            <form id="FormPasswd" class="form-horizontal" novalidate>
                                <div class="md-input-wrapper form-group">
                                    <input type="email" name="usrEmail" id="usrEmail" class="md-form-control md-static" />
                                    <label>Email</label>
                                </div>
                                <div class="text-center m-b-20">
                                    <button type="button" id="VolverLogin" class="btn btn-default waves-effect">Cancelar</button>
                                    <button type="button" id="EnviarPasswd" class="btn btn-primary waves-effect">Enviar</button>
                                </div>
                            </form>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/login/login.js') }}"></script>
@endsection
