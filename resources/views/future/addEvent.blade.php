@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<form method='post' action='{{route('addFuture')}}'>
		{{ csrf_field()}}
		<input type="hidden" name="group" value="{{$id}}">
		<div id="day0" class="well">
			Date
			<input type="date" name="date[]" class="form-control">
			<br/>
			From
			<input type="time" name="start[]" class="form-control">
			<br/>
			To
			<input type="time" name="end[]" class="form-control">
		</div>
		<button type="button" class="btn btn-primary" onclick="counter = addDay(counter)">Add Day</button>
		<button type="button" class="btn btn-primary" onclick="counter = removeDay(counter)">Remove Day</button>
		<br/>
		Event Name
		<input type="text" name="name" class="form-control">
		<br>
		Event Description
		<textarea name="description" class="form-control"></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Add Event</button>
	</form>
	<br/>
	<br/>
	<br/>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection