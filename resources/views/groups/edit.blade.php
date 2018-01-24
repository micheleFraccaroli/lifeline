@extends('layouts.app')
@section('content')
@include('layouts.error')

<?php if(Auth::check()) { ?>

	<div class="panel-body">
		<div class = "row">
			<div class ="col-sm-6 col-md-offset-3">
				<div class="alert alert-info">
					<form method="POST" action="<?php echo "/groups/{$gruppo->id}"; ?>" enctype="multipart/form-data" onSubmit="return check_create_group()">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="Nome gruppo">Name *</label>
							<input type="text" class="form-control" placeholder="Insert a name for the group" name = "name_group" value = "<?php echo $gruppo->name ?>">
						</div>
						<div class="form-group">
							<label for="Descrizione gruppo">Description *</label>
							<textarea class="form-control" name="description_group" placeholder="Insert a short description" rows="3"><?php echo $gruppo->description ?></textarea>
						</div>
						<div class="form-group">
							<input type="file" id="group_pic" name="group_pic" style="display: none;"/>
			                <button type="button" class="btn btn-info" onclick="document.getElementById('group_pic').click();">
			                <span class="glyphicon glyphicon-picture"></span>
			                    Share a pic
			                </button>
						</div>
						<div id = "pic_space">
							
							<button type='button' class='btn btn-info' id="discard_pic_group">
		                    <span class="glyphicon glyphicon-trash"></span>
		                    Discard pic
		                    </button>

		                    <br>
							<br>

							<img class = "img-thumbnail" src="<?php echo $gruppo->image ?>" height="200" width="200"/>

							<br>
							<br>
		                    
	                	</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-lg btn-block" name="button_create_group">Save changes</button>
						</div>
					</form>
					<form method = "GET" action = "<?php echo "/groups/index/{$gruppo->id}"; ?>">
						<div class="form-group">
							<button type="submit" class="btn btn-secondary btn-lg btn-block">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<?php } else {
	header('Location: ' . route('login'));
    die();
} ?>
@endsection