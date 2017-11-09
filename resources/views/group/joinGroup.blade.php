@extends('layouts.app')

@section('content')
	<br/>
	<br/>
	@if($error != null)
		<h3>{{$error}}</h3>
	@else
		<form method="post" action="{{route('join')}}">
			{{ csrf_field()}}
			Enter the group number
			<input type="text" name="group" class="form-control" required>
			<br/>
			<button type="submit" class="btn btn-primary">Join</button>
		</form>
	@endif
@endsection