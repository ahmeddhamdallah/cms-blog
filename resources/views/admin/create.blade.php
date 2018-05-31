@extends('layouts.app')



@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
	
	<div class="panel-heading">
		
		Create New User

	</div>

	<div class="panel-body">
		
		<form action="{{ route('user.store') }}" method="post">
			
			{{ csrf_field() }}


		

		<div class="form_group">
			
			<label for="name">User</label>

			<input type="text" name="name" class="form-control">

		</div>
		<br>
		<div class="form_group">
			
			<label for="name">Email</label>

			<input type="email" name="email" class="form-control">

		</div>
		<br>


		

		<div class="form_group">
			
			
				
				<button class="btn btn-success" type="submit">
					
					Add User 

				</button>

			

		</div>
	</form>

	</div>
</div>




@stop