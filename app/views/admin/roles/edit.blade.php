	@section('title')
	Modifier un role @parent 
	@stop

	@section('title-header')
    	<h3>Modifier <small>un role</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/roles') }}}" class="btn btn-small btn-default "><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour</a>
			</div> 
		</h3>  
	@stop

	{{BootForm::model($role)}}
	{{BootForm::text('name')}}
	{{BootForm::submit('Modifier')}}
	{{BootForm::close()}}
