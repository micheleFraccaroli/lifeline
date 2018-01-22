<a href="/post/{{$notification->data['comment']['id_post']}}">

	<?php if(!empty($notification->read_at) != 1) { ?>
		<h5>Commento ad un tuo post da {{ $notification->data['comment']['name'] }} {{ $notification->data['comment']['surname'] }}<img src="green-dot.svg" height="25" width="28"></h5>
	<?php }?>

</a>