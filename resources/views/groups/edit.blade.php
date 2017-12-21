@extends('layouts.app')
@section('content')
@include('layouts.error')
	<div class = "row">
		<div class ="col-sm-6 col-md-offset-3">
			<form method="POST" action=<?php echo "/groups/{$gruppo->id}" ?>>

				{{ csrf_field() }}

				<div class="form-group">
					<label for="exampleInputEmail1">Nome Gruppo:</label>
					<input type="text" class="form-control" name = "name_group" value = "<?php echo $gruppo->name ?>">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Descrizzione:</label>
					<textarea class="form-control" name="description_group" rows="3"><?php echo $gruppo->description ?></textarea>
				</div>
				<div class="form-group">
					<label for="Immagine gruppo">Modifica immagine gruppo</label>
					<br>
					<input type="file" id="group_pic"/>
				</div>
				<div class="form-group">
					<img id="show_group_pic" class = "img-responsive img-circle" src="<?php echo $gruppo->image ?>" height="200" width="200"/>
  					<span class="custom-file-control"></span>
  					<input type="hidden" name="group_pic_value" value="">
				</div>
				<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg btn-block">Salva Modifiche</button>
				<button type="button" class="btn btn-danger btn-lg btn-block">Annulla</button>
				</div>
			</form>
		</div>
	</div>
@endsection