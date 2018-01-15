<a href="/post/{{$notification->data['like']['id_post']}}">

	<?php if(!empty($notification->read_at) != 1) { ?>
		<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} <img src="green-dot.svg" height="25" width="28"></h5>  
	<?php } else { ?>
		<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} </h5>
	<?php } ?>

</a>