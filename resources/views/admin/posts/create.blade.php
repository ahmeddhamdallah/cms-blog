@extends('layouts.app')



@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
	
	<div class="panel-heading">
		
		Create New Post

	</div>

	<div class="panel-body">
		
		<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
			
			{{ csrf_field() }}


		

		<div class="form_group">
			
			<label for="title">Title</label>

			<input type="text" name="title" class="form-control">

		</div>
		<hr>


		<div class="form_group">
			
			<label for="featured">Featured Image</label>

			<input type="file" name="featured" class="form-control-ms">

		</div>
		<hr>

		<div class="form_group">
			
			<label for="category">Select a Category</label>

			<select name="category_id" id="category" class="form-control">

				<option>Select</option>
				
				@foreach($categories as $category)

				    <option value="{{ $category->id }}">{{ $category->name }}</option>


				@endforeach


			</select>

		</div>
		<hr>

		<div class="form-group form-check">

			<label for="tags">Select Tags</label>

		@foreach($tags as $tag)

		  <div class="form-group">

		    <label class="form-check-label">
		      <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}">{{ $tag->tag }}</label>

		      
		  </div>

		  @endforeach

		  <hr>


		<div class="form_group">
			
			<label for="content">Content</label>

			<textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>

		</div>

		<hr>

		<div class="form_group">
			
			<div class="text-center">
				
				<button class="btn btn-success" type="submit">
					
					Store Post

				</button>

			</div>

		</div>
	</form>

	</div>
</div>




@stop