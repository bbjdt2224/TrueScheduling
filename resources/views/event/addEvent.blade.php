@extends('layouts.app')

@section('content')
	<?php
		$g = "";
		foreach($groups as $gr){
			if($gr->id == $event->group){
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
		<input type="date" name="date" class="form-control">
		<br/>
		Time
		<input type="time" name="time" class="form-control">
		<br/>
		Event Name
		<input type="text" name="name" class="form-control">
		<br>
		Event Description
		<textarea name="description" class="form-control"></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Add Event</button>
	</form>
@endsection
