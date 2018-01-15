<a href="/users/{{$notification->data['user']['my_id']}}">
	
	<?php if(!empty($notification->read_at) != 1) { ?>
		<i><h5>Risposta alla di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}</h5></i> 
	<?php } else { ?>
		<h5>Risposta alla di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}</h5>
	<?php } ?>

</a>