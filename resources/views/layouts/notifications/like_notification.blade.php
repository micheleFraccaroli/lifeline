<?php if($notification->data['like']['group_name'] == null) { ?>

	<a href="/post/{{$notification->data['like']['id_post']}}">

		
			<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} <img src="{{asset('/green-dot.svg')}}" height="25" width="35"></h5>  
		

	</a>

<?php } else { ?>
	
	<a href="/post/{{$notification->data['like']['id_post']}}">

		
			<h5>Mi piace ad un tuo post da {{ $notification->data['like']['name'] }} {{ $notification->data['like']['surname'] }} sul gruppo {{  $notification->data['like']['group_name'] }}<img src="{{asset('/green-dot.svg')}}" height="25" width="35"></h5>  
		

	</a>

<?php } ?>