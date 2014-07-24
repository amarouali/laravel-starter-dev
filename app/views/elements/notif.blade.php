@if (Session::has('notif'))
  
		<div class="alert alert-{{Session::get('notif.type')}} alert-dismissible" role="alert">
		      <button type="button" class="close" data-dismiss="alert">
		      		<span aria-hidden="true">×</span><span class="sr-only">Close</span>
		      </button>
		      {{Session::get('notif.message')}}
		</div>

@endif

