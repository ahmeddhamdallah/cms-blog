@extends('layouts.app')



@section('content')

@include('admin.includes.errors')

<div class="panel panel-default">
	
	<div class="panel-heading">
		
		Edit post: {{ $post->title }}

	</div>

	<div class="panel-body">
		
		<form action="{{ route('post.update', ['id' => $post->id ]) }}" method="post" enctype="multipart/form-data">
			
			{{ csrf_field() }}


		

		<div class="form_group">
			
			<label for="title">Title</label>

			<input type="text" name="title" class="form-control" value="{{ $post->title }}">

		</div>
		<hr>


		<div class="form_group">
			
			<label for="featured">Featured Image</label>

			<input type="file" name="featured" class="form-control">

		</div>
		<hr>

		<div class="form_group">
			
			<label for="category">Select a Category</label>

			<select name="category_id" id="category" class="form-control">

				<option>Select</option>
				
				@foreach($categories as $category)

				    <option value="{{ $category->id }}"


				    	@if($post->category->id == $category->id)


				    	    selected



				    	    @endif





				    	>{{ $category->name }}</option>


				@endforeach


			</select>

		</div>

		<hr>

		<div class="form-group">

			<label for="tags">	Select Tags</label>

		@foreach($tags as $tag)

		  <div class="form-group form-check">

		    <label class="form-check-label">
		      <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" 

		      @foreach($post->tags as $t)

		          @if($tag->id == $t->id)


		            checked

		          @endif


		      @endforeach 
		      	
		      
		      >{{ $tag->tag }}</label>

		      
		  </div>
		  @endforeach

		  <hr>


		<div class="form_group">
			
			<label for="content">Content</label>

			<textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>

		</div>

		<div class="form_group">
			
			<div class="text-center">
				
				<button class="btn btn-success" type="submit">
					
					Update Post

				</button>

			</div>

		</div>
	</form>

	</div>
</div>




@stop