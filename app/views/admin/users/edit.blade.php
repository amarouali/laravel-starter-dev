	@section('title')
	Modifier @parent 
	@stop

	@section('title-header')
    	<h3>Modifier <small>un utilisateur</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/users') }}}" class="btn btn-small btn-default "><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour</a>
			</div> 
		</h3>  
	@stop

	{{BootForm::model($user)}}
	{{BootForm::text('username')}}
	{{BootForm::email('email')}}
	{{BootForm::password('password')}}
	{{BootForm::password('password_confirmation')}}
	{{BootForm::select('role_id','Role',$user->role->id,$roles)}}
	{{BootForm::select('confirmed',"Activer l'utilisateur ?",[1=>'Oui',0=>'Non'])}}
	{{BootForm::submit()}}
	{{BootForm::close()}}
