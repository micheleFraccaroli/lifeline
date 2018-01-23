<?php if($notification->data['like']['group_name'] == null) { ?>

	<a href="/post/{{$notification->data['like']['id_post']}}">

		<?php if(!empty($notification->read_at) != 1) { ?>
			<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} <img src="green-dot.svg" height="25" width="28"></h5>  
		<?php } ?>

	</a>

<?php } else { ?>
	
	<a href="/post/{{$notification->data['like']['id_post']}}">

		<?php if(!empty($notification->read_at) != 1) { ?>
			<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} sul gruppo {{  $notification->data['like']['group_name'] }}<img src="green-dot.svg" height="25" width="28"></h5>  
		<?php } ?>

	</a>

<?php } ?>