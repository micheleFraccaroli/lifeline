@extends('layouts.app')

@section('content')

<?php echo "$gruppo->name<br>";

foreach ($posts_group as $post_group) {
	
	echo "$post_group->body<br>";

}

?>

@endsection