<a href="/users/{{$notification->data['user']['my_id']}}">

	<?php if(!empty($notification->read_at) != 1) { ?>
		<h5>Richiesta di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}<img src="green-dot.svg" height="25" width="28"></h5>  
	<?php } else { ?>
		<h5>Richiesta di amicizia da {{ $notification->data['user']['name'] }} {{ $notification->data['user']['surname'] }}</h5>
	<?php } ?>

</a>