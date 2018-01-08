@if(count($errors))
	<div class = "row">
		<div class ="col-sm-6 col-md-offset-3">
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>	
@endif