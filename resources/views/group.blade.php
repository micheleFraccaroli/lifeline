@extends('layout')

@section('content')

<?php echo "$gruppo->name";

foreach ($posts_group as $post_group) {
	
	echo "$post_group->body";
}

?>

@endsection