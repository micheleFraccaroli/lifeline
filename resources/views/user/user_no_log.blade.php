@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default homeImage"> 
                <?php if($user['image'] == '0' && $user['sex'] == 'M') { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{URL::asset('/default-profile-image-M.png')}}" alt="Profile Image"></a>
                <?php } elseif ($user['image'] == '0' && $user['sex'] == 'F') { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{URL::asset('/default-profile-image-F.png')}}" alt="Profile Image"></a>
                <?php } else { ?>
                    <a href="/users/{{ $user['id'] }}"><img class="photo" src="{{asset($user['image'])}}" alt="Profile Image"></a>
                <?php } ?>
                <hr>

                {{ $user['name'] }}    
                {{ $user['surname'] }} <br>
                
	    		<button type="button" class="btn btn-info" data-container="body" data-toggle="popover" title="<B>{{$user['name']}} {{$user['surname']}}</B>" data-content="<B>Name:</B> {{$user['name']}}<br><B>Surname:</B> {{$user['surname']}}<br><B>Sex:</B> {{$user['sex']}}<br><B>Born:</B> {{$user['born']}}<br><B>Job:</B> {{$user['job']}}<br><B>Relathionship:</B> {{$user['relation']}}<br><B>E-mail:</B> {{$user['email']}}">
      			<span class=' glyphicon glyphicon-info-sign'></span> Info</button>

            </div>
		</div>

		 
		<div class="col-md-6 col-md-offset-1">
			<div class="alert alert-info" id="all_groups">
		        <div id="bacheca_posts">
		            <?php 
		            foreach ($all_posts as $post){

		                echo "<div id='post_{$post->id}'>";

		                if ($post->photo != NULL) {

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> posted a photo:<br><br>";

		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";
		                    echo "<img src='".asset($post->photo)."' class='img-thumbnail' height='200' width='200'/><br><br>";

		                }else{

		                    echo "<img src='".$user_io[$post->id]->image."' class='img-circle' height='30' width='30'/><B> ".$post->created_at." ".$user_io[$post->id]->name." ".$user_io[$post->id]->surname."</B> said:<br><br>";
		                    echo $post->body."<br>";
		                    echo "<a href='".$post->link."' target='_blank'>".$post->link."</a><br><br>";

		                }} ?>
		        </div>
		    </div>
		</div>

	</div>
</div>

@endsection