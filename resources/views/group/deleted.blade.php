@extends('layouts.app')

@section('content')
	<ul class="list-group">
		@foreach($deleted as $group)
			<li class="list-group-item" style="height: 60px;">
				{{$group->name}}
				<a href="{{route('revive', ['id'=>$group->id])}}" class="btn btn-default" style="float: right;">Re-open Group</a>
			</li>
		@endforeach
	</ul>
@endsection