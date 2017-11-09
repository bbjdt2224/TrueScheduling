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
    	<a href='{{route('groupHome', ['id' => $event->group, 'page' => "upcoming"])}}'>
    		<span class="glyphicon glyphicon-arrow-left"></span>
    		{{$g->name}}
    	</a>
    </h3>
	<form method='post' action='{{route('setEventEdit')}}'>
		{{ csrf_field()}}
		<input type="hidden" name="id" value="{{$event->id}}">
		<input type="hidden" name="group" value="{{$event->group}}">
		Date
		<input type="date" name="date" class="form-control" value="{{$event->date}}">
		<br/>
		Time
		<input type="time" name="time" class="form-control" value="{{$event->starttime}}">
		<br/>
		Event Name
		<input type="text" name="name" class="form-control" value="{{$event->name}}">
		<br>
		Event Description
		<textarea name="description" class="form-control">{{$event->descrtiption}}</textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Edit Event</button>
	</form>
@endsection
