@extends('layouts.app')

@section('content')
	<form action="{{route('userEdit')}}" method="post">
		{{ csrf_field()}}
		Name
		<input type="text" class="form-control" name='name' value="{{Auth::user()->name}}">
		<br/>
		Email
		<input type="text" class="form-control" name="email" value="{{Auth::user()->email}}">
		<br/>
		<div class="checkbox">
			@if(Auth::user()->emaillist == 1)
				<label><input type="checkbox" value="email" name="emaillist" checked="checked">Recieve Emails</label>
			@else
				<label><input type="checkbox" value="email" name="emaillist">Recieve Emails</label>
			@endif
		</div>
		<button type="submit" class="btn btn-primary">Submit Changes</button>
	</form>
@endsection