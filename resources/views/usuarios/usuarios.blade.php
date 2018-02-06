@extends('menu.index')
@section('content')
<div class="row">
	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	        	<center>
	        		<h5 id="spanTitulo" class="card-header-text"></h5>
                </center>
	        </div>
	        <div class="card-block">
				<div class="col-md-12 divForm">
			        <div class="divPerfiles">	
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
								<table id="tablaUsuarios" class="table table-striped dt-responsive nowrap table-hover" cellspacing="0" width="100%"></table>
							</div>
						</div>
					</div>
					<div class="divPerfiles" style="display:none;">
						<br>
						<div class="row">
							<div class="col-md-12">
						        <button style="float:right;" id="volverPerfiles" type="button" class="btn btn-inverse-primary waves-effect waves-light">
									Volver
								</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-7">
										<form id="FormPerfil" method="POST">
											<input type="hidden" id="idUser2">
											<select class="comboclear form-control m-select2" id="idPerfil" name="idPerfil" style="width:100%;">
												<option value="">Seleccione..</option>
											</select>
										</form>
									</div>
									
									<div class="col-md-3">
			                			<button name="agregarP" id="agregarP" type="button" class="btn btn-primary waves-effect waves-light">
											Agregar
			                			</button>
									</div>
									<div class="col-md-1"></div>
								</div>
								<div class="table-responsive" id="divTablaPerfiles" style="display:none;">
									<table id="tablaPerfiles" class="table compact table-striped dt-responsive nowrap table-hover" cellspacing="0" width="100%"></table>
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>
					</div>
		        </div>
				<div style="display:none;" class="col-md-12 divForm">
					{!! Form::open(['id'=>'FormUsuario','autocomplete' => 'off']) !!}
					{!! Form::hidden('idUser', '', [
					'id'            => 'idUser',
					'class'         => 'form-control'])!!}
					<input type="hidden" name="idProveedor" id="idProveedor" value="0">
					<input type="hidden" name="_token" id="_token" value="{!! csrf_token() !!}">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<label for="usrUserName">Login:</label>
							{!! Form::text('usrUserName', '', [
							'id'            => 'usrUserName',
							'class'         => 'form-control',
							'placeholder'   => 'Login',
							'style'         => 'width:100%;height:35px',
							'maxlength'     => '12'])!!}
	                        <small id="ErrorRut" class="rut-error"></small>
						</div>
						<div class="col-md-4"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<label for="usrNombreFull">Nombres:</label>
							{!! Form::text('usrNombreFull', '', [
							'id'            => 'usrNombreFull',
							'class'         => 'form-control',
							'placeholder'   => 'Nombres',
							'style'         => 'width:100%;height:35px',
							'maxlength'     => '50'])!!}
						</div>
						<div class="col-md-4"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4 form-group">
							<label for="usrEmail">Email:</label>
							{!! Form::text('usrEmail', '', [
							'id'            => 'usrEmail',
							'class'         => 'form-control',
							'placeholder'   => 'Email',
							'style'         => 'width:100%;height:35px'])!!}
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row" id="divSpanPerfiles" style="display:none;">
					<br>
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<label id="labelPerfil" for="perfiles">Perfiles:</label>
							<span id="perfiles" class="form-control"></span>
						</div>
						<div class="col-md-4"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							{!! Field::select('usrEstado', null, null,
							[ 'label' => 'Estado', 
							'style' => 'width:100%;height:35px;',
							'placeholder' => 'Seleccione...',
							'class' => 'form-control comboclear']) !!}
						</div>
						<div class="col-md-4"></div>
					</div>
					<div id="divConsulta" style="display:none;">
						<br>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label for="usrUltimaVisita">Última visita:</label>
								<span id="usrUltimaVisita" class="form-control">Desconocido</span>
							</div>
							<div class="col-md-4"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label for="auCreadoEl">Creado el:</label>
								<span id="auCreadoEl" class="form-control">Desconocido</span>
							</div>
							<div class="col-md-4"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label for="creador">Creado por:</label>
								<span id="creador" class="form-control">Desconocido</span>
							</div>
							<div class="col-md-4"></div>
						</div>
						<br>			
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label for="auModificadoEl">modificado el:</label>
								<span id="auModificadoEl" class="form-control">Desconocido</span>
							</div>
							<div class="col-md-4"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<label for="modificador">Modificado por:</label>
								<span id="modificador" class="form-control">Desconocido</span>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>
					<br>
					<div align="center">
						<div class="pull-rigth">
							<button name="cancelar" id="cancelar" type="button" class="btn btn-inverse-primary waves-effect waves-light">
								Cancelar
							</button>
                			<button name="guardar" id="guardar"  type="button" class="btn btn-primary waves-effect waves-light">
								Guardar
                			</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>            
	        </div>
	    </div>
	</div>
</div>
<script Language="Javascript">
	var ruta = "{{ URL::route('usuarios') }}"
	var rutaR = "{{ URL::route('reiniciar') }}"
	var rutaA = "{{ URL::route('activar') }}"
	var rutaP = "{{ URL::route('perfiles') }}"
	var rutaAP = "{{ URL::route('activarP') }}"
	var rutaDC = "{{ URL::route('desbloquearC') }}"
	var d = [];
	d['v_usuarios'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_usuarios) }}'));
	d['v_perfiles'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_perfiles) }}'));
	d['v_estados'] = JSON.parse(rhtmlspecialchars('{{ json_encode($v_estados) }}'));
	d['v_perfil'] = JSON.parse(rhtmlspecialchars('{{ $v_perfil }}'));
</script>
<script src="{{ asset('js/usuarios/usuarios.js') }}"></script>
@endsection