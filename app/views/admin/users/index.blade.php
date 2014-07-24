	@section('title')
	Liste des utilisateurs :: @parent 
	@stop

	@section('title-header')
    	<h3>Gestion <small>des utilisateurs</small>
 
			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Créer</a>
			</div> 
		</h3>  
	@stop

    
    <table class="table table-striped">
    	<thead>
    		<tr>
    			<th>Pseudo</th>
    			<th>Email</th>
    			<th>Roles</th>
    			<th>Active</th>
    			<th>Date de création</th>
    			<th>Action</th>
    		</tr>
    	</thead>
		<tbody>
			
			@foreach ($users as $user)
				<tr>
					<td>{{$user->username}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role->name}}</td>
					<td>{{($user->confirmed)?'yes':'Non'}}</td>
					<td>{{Carbon::parse($user->created_at)->format('d-m-Y H:i:s')}}</td>
					<td>
						@if ($user->role->name =="admin")
							<a href='{{URL::route("admin.users.edit",$user->id)}}' class=" btn btn-xs btn-default ">Edit</a>
						@else
							<a href='{{URL::route("admin.users.edit",$user->id)}}' class=" btn btn-xs btn-default  pull-left ">Edit</a>
							{{BootForm::open(['route'=>['admin.users.delete',$user->id],'class'=>'delete-form'])}}
								<button type="submit" class="btn btn-danger btn-xs">supprimer</button>
							{{BootForm::close()}}
						@endif
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