<?php if($notification->data['comment']['group_name'] == null) { ?>

	<a href="/post/{{$notification->data['comment']['id_post']}}">

		
			<h5>Commento ad un tuo post da {{ $notification->data['comment']['name'] }} {{ $notification->data['comment']['surname'] }}<img src="{{asset('/green-dot.svg')}}" height="25" width="35"></h5>
		

	</a>

<?php } else { ?>
	
	<a href="/post/{{$notification->data['comment']['id_post']}}">

		
			<h5>Commento ad un tuo post da {{ $notification->data['comment']['name'] }} {{ $notification->data['comment']['surname'] }} sul gruppo {{  $notification->data['comment']['group_name'] }}<img src="{{asset('/green-dot.svg')}}" height="25" width="35"></h5>
		

	</a>

<?php } ?>