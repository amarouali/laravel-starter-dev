	@section('title')
	Mot de passe oublié :: @parent 
	@stop

	@section('title-header')
    	<h3>Mot de passe oublié</small></h3>  
	@stop

{{BootForm::open(['route'=>'remind'])}}
{{BootForm::email('email','Votre adresse Email')}}
{{BootForm::submit("Réinsialiser le mot de passe")}}
{{BootForm::close()}}