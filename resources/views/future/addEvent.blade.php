@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<form method='post' action='{{route('addFuture')}}'>
		{{ csrf_field()}}
		<input type="hidden" name="group" value="{{$id}}">
		<select name="time" class="form-control" id="times" onchange="changeTimes(counter)">
			<option value="0">Same Time</option>
			<option value="1">Diffrent Times</option>
		</select>
		<br/>
		<div id="day0" class="well">
			<div id="start0">
				From
				<input type="time" name="start[]" class="form-control">
				<br/>
			</div>
			<div id="end0">
				To
				<input type="time" name="end[]" class="form-control">
				<br/>
			</div>
			Date
			<input type="date" name="date[]" class="form-control">
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