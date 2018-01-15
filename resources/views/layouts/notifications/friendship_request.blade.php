<a href="/users/{{$notification->data['user']['my_id']}}">

	<?php if(!empty($notification->read_at) != 1) { ?>
		<i><h5>Richiesta di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}</h5></i> 
	<?php } else { ?>
		<h5 style="color: #00ff00;">Richiesta di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}</h5>
	<?php } ?>

</a>