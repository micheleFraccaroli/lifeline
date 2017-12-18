@extends('layouts.app')

@section('content')

<div class = "container-fluid">
	<div class = "row">
		<div class ="col-sm-6">
			<form method="POST" action=<?php echo "/groups/{$gruppo->id}" ?>>

				{{ csrf_field() }}

				<div class="form-group">
					<label for="exampleInputEmail1">Nome Gruppo(*):</label>
					<input type="text" class="form-control" name = "name_group" value = "<?php echo $gruppo->name ?>">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Descrizzione(*):</label>
					<textarea class="form-control" name="description_group" rows="3"><?php echo $gruppo->description ?></textarea>
				</div>
				<button type="submit" class="btn btn-outline-primary btn-lg btn-block">Salva Modifiche</button>
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