@extends('menu.index')
@section('content')
<style type="text/css" media="screen">
	.nav-tabs .slide{
		 width: calc(100% / 2)!important;
	}
</style>
<div class="row">
	<div class="col-md-12 divDetalles">
	    <div class="card">
	        <div class="card-header">
	        	<center>
	        		<h5 id="spanTitulo" class="card-header-text"></h5>
                </center>
	        </div>
	        <div class="card-block">
				<div class="col-md-12 divForm">
					<div class="row">
						<div class="col-md-12">
							<button style="float:right;" name="agregar" id="agregar" type="button" class="btn btn-primary waves-effect waves-light">
								<span>Agregar</span>
                			</button>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table id="tablaEmpresas" class="table table-striped dt-responsive nowrap table-hover" cellspacing="0" width="100%"></table>
						</div>
					</div>
		        </div>
				<div style="display:none;" class="col-md-12 divForm">
					<div class="row">
						<div id="divVolver" class="col-md-12">
							<a style="float:right;" id="volverAct" href="#"><u>volver</u></a>
						</div>
					</div>
					{!! Form::open(['id'=>'FormEmpresa','autocomplete' => 'off']) !!}
					{!! Form::hidden('IdEmpresa', '', [
					'id'            => 'IdEmpresa',
					'class'         => 'form-control'])!!}
					<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
					<div class="row">
						<div class="col-sm-4">
	                        <div class="md-input-wrapper">
                                <input id="RUT" name="RUT" type="text" class="md-form-control" maxlength="12" readonly />
	                            <label for="RUT">RUT</label>
		                        <small id="ErrorRut" class="rut-error"></small>
	                        </div>
						</div>
	                    <div class="col-sm-4">
	                        <div class="md-input-wrapper">
	                        	<input id="RazonSocial" name="RazonSocial" type="text" class="md-form-control" maxlength="250" readonly />
	                            <label for="RazonSocial">Razon Social</label>
	                        </div>
	                    </div>
	                    <div class="col-sm-4">
	                        <div class="md-input-wrapper">
								<input id="NombreFantasia" name="NombreFantasia" type="text" class="md-form-control" maxlength="250" readonly />
								<label for="NombreFantasia">Nombre Fantasia:</label>
							</div>
	                    </div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							<div class="md-input-wrapper">
								<div class="md-input-wrapper">
									<input id="Giro" name="Giro" type="text" class="md-form-control" maxlength="250" readonly />
									<label for="Giro">Giro:</label>
								</div>
                            </div>
						</div>
						<div class="col-sm-4">
							<div class="md-input-wrapper">
	                         	<select name="IdRepresentanteLegal" id="IdRepresentanteLegal" class="md-disable md-valid" disabled>
                                    <option>Seleccione...</option>
                                    <option value="1">Representante 1</option>
                                    <option value="2">Representante 2</option>
                                </select>
                                <label for="IdRepresentanteLegal">Representante Legal</label>
							</div>
						</div>
						<div class="col-sm-4">
	                        <div class="md-input-wrapper">
	                         	<select name="EstadoEmpresa" id="EstadoEmpresa" class="md-disable md-valid" disabled>
                                    <option>Seleccione...</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                                <label for="EstadoEmpresa">Estado</label>
							</div>
						</div>
					</div>
					<br>
					<div align="center">
						<div class="pull-rigth">
							<div id="divBtnModificar">
								<button id="modificar" type="button" class="btn btn-primary waves-effect waves-light">
									Modificar
								</button>
							</div>
							<div id="divBtnAceptar">
								<button id="cancelar" type="button" class="btn btn-inverse-primary waves-effect waves-light">
									Cancelar
								</button> 
	                			<button id="guardar"  type="button" class="btn btn-primary waves-effect waves-light">
									Guardar
	                			</button>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
				</div>            
	        </div>
	    </div>
	</div>
	<div class="col-md-12 divDetalles" style="display:none;">
		<div class="card">
		    <div class="card-header">
		    	<center>
			    	<h5 class="card-header-text">Product Edit</h5>
		    	</center>
		    </div>
		    <div class="card-block">
		        <div class="row">
		            <div class="col-sm-12">
		                <div class="product-edit">
		                    <ul class="nav nav-tabs nav-justified md-tabs " role="tablist">
		                        <li class="nav-item">
		                            <a class="nav-link active" data-toggle="tab" href="#detalles" role="tab">
		                                <div class="f-26">
		                                    <i class="icofont icofont-document-search"></i>
		                                </div>
		                                Detalles de Empresa
		                            </a>
		                            <div class="slide"></div>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" data-toggle="tab" href="#locales" role="tab">
		                                <div class="f-26">
		                                    <i class="icofont icofont-document-search"></i>
		                                </div>
		                                Locales Asociados
		                           	</a>
		                            <div class="slide"></div>
		                        </li>
		                    </ul>
		                    <!-- Tab panes -->
		                    <div class="tab-content">
		                        <div class="tab-pane active" id="detalles" role="tabpanel">
		                            <form class="md-float-material card-block">
		                                <div class="row">
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="RUTd" type="text" class="md-form-control md-valid" maxlength="50" readonly />
		                                            <label>RUT</label>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="RazonSociald" type="text" class="md-form-control md-valid" readonly />
		                                            <label>Razon Social</label>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="NombreFantasiad" type="text" class="md-form-control md-valid" readonly />
		                                            <label>Nombre Fantasia</label>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="Girod" type="text" class="md-form-control md-valid" readonly />
		                                            <label>Giro</label>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="IdRepresentanteLegald" type="text" class="md-form-control md-valid" readonly/>
		                                            <label>Representante Legal</label>
		                                        </div>
		                                    </div>
		                                    <div class="col-sm-6">
		                                        <div class="md-input-wrapper">
		                                            <input id="desEstadoEmpresad" type="text" class="md-form-control md-valid" readonly/>
		                                            <label>Estado</label>
		                                        </div>
		                                    </div>
		                                </div>
		                            </form>
		                        </div>
		                        <div class="tab-pane" id="locales" role="tabpanel">
									<div class="row">
										<div class="col-md-12 table-responsive">
											<table id="tablaLocales" class="table table-striped dt-responsive nowrap table-hover" cellspacing="0" width="100%"></table>
										</div>
									</div>
		                        </div>
		                        <div class="text-center">
		                            <button id="btn-volver" type="button" class="btn btn-inverse-primary waves-effect waves-light m-r-10">
		                            	Volver
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('empresas') }}"
	var rutaA = "{{ URL::route('activarE') }}"
	var rutaD = "{{ URL::route('detallesE') }}"
	var d = [];
	d['v_empresas'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_empresas) }}'));
</script>
<script src="{{ asset('js/empresas/empresas.js') }}"></script>
@endsection