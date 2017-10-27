@extends('layouts.app')

@section('content')
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
