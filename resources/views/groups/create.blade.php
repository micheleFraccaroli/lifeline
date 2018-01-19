@extends('layouts.app')
@section('content')
@include('layouts.error')
	<div class = "row">
		<div class ="col-sm-6 col-md-offset-3">

			<?php if(Auth::check()) { ?>
				<form method="POST" action="/groups" enctype="multipart/form-data">

					{{ csrf_field() }}

					<div class="form-group">
						<label for="Nome gruppo">Nome Gruppo *</label>
						<input type="text" class="form-control" placeholder="Inserisci il nome del gruppo..." name = "name_group">
					</div>
					<div class="form-group">
						<label for="Descrizio gruppo">Descrizione *</label>
						<textarea class="form-control" name="description_group" placeholder="Inserisci una breve descrizione del gruppo..." rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="Immagine gruppo">Modifica immagine gruppo</label>
						<br>
						<input type="file" name="new_group_pic" id="group_pic"/>
					</div>
					<div class="form-group">
						<img id="show_group_pic" class ="img-responsive img-circle" src="#" height="200" width="200"/>
	  					<span class="custom-file-control"></span>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg btn-block">Crea Gruppo</button>
						<button type="button" class="btn btn-danger btn-lg btn-block">Annulla</button>
					</div>
				</form>
			<?php } else {
				header('Location: ' . route('login'));
    			die();
			} ?>
		</div>
	</div>
@endsection