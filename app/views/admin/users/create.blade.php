	@section('title')
	Créer un utilisateur @parent 
	@stop

	@section('title-header')
    	<h3>Création <small>d'un utilisateur</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/users') }}}" class="btn btn-small btn-default "><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour</a>
			</div> 
		</h3>  
	@stop

	
	{{BootForm::open(['url'=>'admin/users/create'])}}
	{{BootForm::text('username')}}
	{{BootForm::email('email')}}
	{{BootForm::password('password')}}
	{{BootForm::password('password_confirmation')}}
	{{BootForm::select('role_id','Role',$roles)}}
	{{BootForm::select('confirmed',"Activer l'utilisateur ?",[1=>'Oui',0=>'Non'])}}
	{{BootForm::submit()}}
	{{BootForm::close()}}
</div>

	

