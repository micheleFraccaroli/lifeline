@extends('layouts.app')
@section('content')
<br><br>
<?php echo $user->id . '  ' . $user->name. ' - ' .$user->surname . ' - ' . $user->email . "<br>";?>
<br><br>
@endsection