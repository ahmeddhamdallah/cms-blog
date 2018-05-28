@extends('layouts.app')



@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
	
	<div class="panel-heading">
		
		Create New Tag

	</div>

	<div class="panel-body">
		
		<form action="{{ route('tag.store') }}" method="post">
			
			{{ csrf_field() }}


		

		<div class="form_group">
			
			<label for="name">Tag</label>

			<input type="text" name="tag" class="form-control">

		</div>
		<br>


		

		<div class="form_group">
			
			
				
				<button class="btn btn-success" type="submit">
					
					Store Tag

				</button>

			

		</div>
	</form>

	</div>
</div>




@stop