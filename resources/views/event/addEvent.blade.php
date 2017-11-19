@extends('layouts.app')

@section('content')
	@if($errors->any())
        <h4 style="color: red;">{{$errors->first()}}</h4>
    @endif
	<?php
		$g = "";
		foreach($groups as $gr){
			if($gr->id == $id){
				$g = $gr;
			}
		}
	?>

	<h3>
    	<a href='{{route('groupHome', ['id' => $id, 'page' => "message"])}}'>
    		<span class="glyphicon glyphicon-arrow-left"></span>
    		{{$g->name}}
    	</a>
    </h3>
	<form method='post' action='{{route('add')}}'>
		{{ csrf_field()}}
		<input type="hidden" name="group" value="{{$id}}">
		Date
		<input type="date" name="date" class="form-control" required>
		<br/>
		Time
		<input type="time" name="time" class="form-control" required>
		<br/>
		Event Name
		<input type="text" name="name" class="form-control" required>
		<br>
		Event Description
		<textarea name="description" class="form-control"></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Add Event</button>
	</form>
@endsection
