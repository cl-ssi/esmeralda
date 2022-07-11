@php
	$user = auth()->user();
	$establishments = App\Establishment::whereIn('commune_id',explode(",",env('COMUNAS')))->orderBy('alias')->pluck('alias','id');
@endphp

<div class="alert alert-info" role="alert">
	<h4 class="alert-heading">Regularizar datos de la cuenta</h4>

	<p>Estimado usuario, para continuar utilizando el sistema es necesario regularizar los datos que nos faltan de su cuenta.</p>
	<p class="mb-0"><strong>Debe proporcionar información fidedigna, de lo contrario, su cuenta podría ser deshabilitada.</strong></p>
	<hr>


	<form method="POST" class="form-horizontal" action="{{ route('users.self-update',$user) }}">
		@csrf
		@method('PUT')

		<div class="form-row">

			@if( is_null($user->run) OR is_null($user->dv) )
			<fieldset class="form-group col-8 col-md-2">
				<label for="for_run">Run</label>
				<input type="number" class="form-control" name="run" id="for_run"
					value="{{ $user->run }}" required>
			</fieldset>

			<fieldset class="form-group col-4 col-md-1">
				<label for="for_dv">Dígito</label>
				<input type="text" class="form-control" name="dv" id="for_dv"
					value="{{ $user->dv }}" required>
			</fieldset>
			@endif

			@if(!$user->name OR count(preg_split('/\W+/u', $user->name, -1, PREG_SPLIT_NO_EMPTY)) <= 2)
			<fieldset class="form-group col-12 col-md-4">
				<label for="for_name">Nombre completo (nombre y apellidos)</label>
				<input type="text" class="form-control" name="name" id="for_name" pattern=".+?(?:[\s'].+?){2,}"
					value="" required>
			</fieldset>
			@endif

			@if(is_null($user->email))
			<fieldset class="form-group col-12 col-md-3">
				<label for="for_email">Email</label>
				<input type="email" class="form-control" name="email" id="for_email"
					value="{{ $user->email }}" required style="text-transform: lowercase;">
			</fieldset>
			@endif

			@if(is_null($user->telephone))
			<fieldset class="form-group col-6 col-md-2">
				<label for="for_telephone">Teléfono de contacto*</label>
				<input type="tel" class="form-control" name="telephone" id="for_telephone" pattern="[0-9]{9}" placeholder="ej: 912345678"
					value="{{ $user->telephone }}" required>
			</fieldset>
			@endif
		</div>

		<div class="form-row">
			@if(is_null($user->establishment_id))
			<fieldset class="form-group col-12 col-md-6">
				<label for="for_establishment_id">Establecimiento al que pertenece*</label>
				<select name="establishment_id" id="establishment_id" class="form-control" required>
					<option value=""></option>
					@foreach($establishments as $id => $establishment)
						<option value="{{ $id }}" {{ ($user->establishment_id == $id) ? 'selected' : '' }}>{{ $establishment }}</option>
					@endforeach
				</select>
			</fieldset>
			@endif

			@if(is_null($user->function))
			<fieldset class="form-group col-12 col-md-6">
				<label for="for_function">Función que cumple*</label>
				<input type="text" class="form-control" name="function" id="for_function"
					value="{{ $user->function }}" required>
			</fieldset>
			@endif

			<button type="submit" class="btn btn-primary mt-3">Actualizar datos</button>
		</div>
	</form>
</div>
