	@section('title')
	connexion :: @parent 
	@stop

	@section('title-header')
    	<h3>Se connecter à mon compte</small></h3>  
	@stop

	{{BootForm::model($user,array('action'=>'login'))}}
	{{BootForm::text('email','Email ou Pseudo')}}
	{{BootForm::password('password','Mot de passe')}}
	{{BootForm::checkbox('remember','Se souvenir de moi',1)}}
	{{BootForm::submit()}}
	{{HTML::link(URL::route('remind'),'Mot de passe oublié?',['class'=>'btn btn-default'])}}
	{{BootForm::close()}}
<hr>
