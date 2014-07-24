	@section('title')
	Mot de passe oublié :: @parent 
	@stop

	@section('title-header')
    	<h3>Réinsialiser le mot de passe</small></h3>  
	@stop

	{{BootForm::open(['url'=>'password/reset'])}}
	{{BootForm::email('email','Votre adresse Email')}}
	{{Form::hidden('token',$token)}}
	{{BootForm::password('password','Nouveau mot de passe')}}
	{{BootForm::password('password_confirmation','Confirmer à nouveau')}}
	{{BootForm::submit("Réinsialiser le mot de passe")}}
	{{BootForm::close()}}


