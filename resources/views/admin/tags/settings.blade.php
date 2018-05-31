@extends('layouts.app')



@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
	
	<div class="panel-heading">
		
		Edit blog settings

	</div>

	<div class="panel-body">
		
		<form action="{{ route('settings.update') }}" method="post">
			
			{{ csrf_field() }}


		

		<div class="form_group">
			
			<label for="name">Site name</label>

			<input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control">

		</div>
		<br>
		<div class="form_group">
			
			<label for="name">Address</label>

			<input type="text" name="address" class="form-control" value="{{ $settings->address }}">

		</div>
		<br>

		<div class="form_group">
			
			<label for="name">Contact phone</label>

			<input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number }}">

		</div>
		<br>

		<div class="form_group">
			
			<label for="name">Contact email</label>

			<input type="text" name="contact_email" class="form-control" value="{{ $settings->contact_email }}">

		</div>
		<br>


		

		<div class="form_group">
			
			
				
				<button class="btn btn-success" type="submit">
					
					Update settings 

				</button>

			

		</div>
	</form>

	</div>
</div>




@stop