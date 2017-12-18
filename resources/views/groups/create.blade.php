@extends('layouts.app')

@section('content')

<div class = "container-fluid">
	<div class = "row">
		<div class ="col-sm-6">
			<form method="POST" action="/groups">

				{{ csrf_field() }}

				<div class="form-group">
					<label for="Nome gruppo">Nome Gruppo *</label>
					<input type="text" class="form-control" placeholder="Inserisci il nome del gruppo..." name = "name_group">
				</div>
				<div class="form-group">
					<label for="Descrizio gruppo">Descrizione *</label>
					<textarea class="form-control" name="description_group" placeholder="Inserisci una breve descrizione del gruppo..." rows="3"></textarea>
				</div>
				<button type="submit" class="btn btn-outline-primary btn-lg btn-block">Crea Gruppo</button>
				<button type="button" class="btn btn-outline-danger btn-lg btn-block">Annulla</button>
				@if(count($errors))
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</form>
		</div>
		<div class = "col-sm-6">

		</div>
	</div>
</div>

@endsection