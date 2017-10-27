@extends('layouts.app')

@section('content')
	<br/>
	<br/>
		<form method="post" action="{{route('start')}}">
			{{ csrf_field()}}
			Group name
			<input type="text" name="groupname" class="form-control">
			<br/>
			<div class="radio">
				<label><input type="radio" name="open" value="yes">Allow anyone to create events</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="open" value="no" checked>Only let me create events</label>
			</div>
			<br/>
			<button type="submit" class="btn btn-primary">Create</button>
		</form>
@endsection