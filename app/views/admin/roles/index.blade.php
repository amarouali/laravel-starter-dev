	@section('title')
	Liste des roles :: @parent 
	@stop

	@section('title-header')
    	<h3>Gestion <small>des roles</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/roles/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Créer</a>
			</div> 
		</h3>  
	@stop

    
    <table class="table table-striped">
    	<thead>
    		<tr>
    			<th>Pseudo</th>
    			<th># Utilisateurs</th>
    			<th>Date de création</th>
    			<th>Action</th>
    		</tr>
    	</thead>
		<tbody>
			
			@foreach ($roles as $role)
				<tr>
					<td>{{$role->name}}</td>
					<td>{{$role->users->count()}}</td>
					<td>{{Carbon::parse($role->created_at)->format('d-m-Y H:i:s')}}</td>
					<td>
						<a href='{{URL::route("admin.roles.edit",$role->id)}}' class=" btn btn-xs btn-default  pull-left ">Edit</a>
						{{BootForm::open(['route'=>['admin.roles.delete',$role->id],'class'=>'delete-form'])}}
							<button type="submit" class="btn btn-danger btn-xs">supprimer</button>
						{{BootForm::close()}}
						
					</td>
				</tr>			
			@endforeach

		</tbody>

	</table>

@section('script')
	<script>
		$(document).on('submit', '.delete-form', function(){
		    return confirm('Vous étes sur ?');
		});
	</script>
@stop