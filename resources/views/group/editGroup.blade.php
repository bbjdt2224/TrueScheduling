@extends('layouts.app')

@section('content')
	<br/>
	<br/>
		<form method="post" action="{{route('groupEdit')}}">
			{{ csrf_field()}}
			<input type="hidden" name="id" value="{{$group->id}}">
			Group name
			<input type="text" name="groupname" class="form-control" value="{{$group->name}}">
			<br/>
			<div class="radio">
				@if($group->open == 1)
					<label><input type="radio" name="open" value="yes" checked="checked">Allow anyone to create events</label>
				@else
					<label><input type="radio" name="open" value="yes">Allow anyone to create events</label>
				@endif
			</div>
			<div class="radio">
				@if($group->open == 0)
					<label><input type="radio" name="open" value="no" checked="checked">Only let me create events</label>
				@else
					<label><input type="radio" name="open" value="no">Only let me create events</label>
				@endif
			</div>
			<br/>
			<a href="{{route('deleteGroup', ['id'=>$group->id])}}" class="btn btn-danger">Delete Group</a>
			<button type="submit" class="btn btn-primary">Edit</button>
		</form>
		<br/>
		<table class="table">
			<thead>
				<th>Group Members</th>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>
						<td>
							{{$member->name}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@endsection