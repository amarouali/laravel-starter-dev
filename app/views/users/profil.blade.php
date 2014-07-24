	@section('title')
	Profil @parent 
	@stop

	@section('title-header')
    	<h3>Mon profil</small></h3>  
	@stop


	{{BootForm::model($user)}}
	{{BootForm::text('username')}}
	{{BootForm::email('email')}}
	{{BootForm::password('password')}}
	{{BootForm::password('password_confirmation')}}
	{{BootForm::submit()}}
	{{BootForm::close()}}