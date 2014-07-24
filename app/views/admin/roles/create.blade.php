	@section('title')
	Créer un role @parent 
	@stop

	@section('title-header')
    	<h3>Création <small>d'un role</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/roles') }}}" class="btn btn-small btn-default "><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour</a>
			</div> 
		</h3>  
	@stop

	
	{{BootForm::open(['url'=>'admin/roles/create'])}}
	{{BootForm::text('name')}}
	{{BootForm::submit('Crée le role','btn btn-success')}}
	{{BootForm::reset('Reset','btn btn-default')}}
	{{BootForm::close()}}
</div>

	

