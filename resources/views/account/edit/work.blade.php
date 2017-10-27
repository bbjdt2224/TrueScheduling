@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<form action="{{route('work')}}" method="post">
		{{ csrf_field()}}
		@if($schedule->work != "-")
			<script>counter = -1;</script>
			<?php $counter = 0;?>
			@foreach(explode('|', $schedule->work) as $shift)
				<?php
					$split = explode('/', $shift);
					$days = explode(',', $split[0]);
					$info = explode(',', $split[1]);
				?>
				<div id="shift{{$counter}}" class="well">
					<label>*Days:</label>
					@if(in_array('sunday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="sunday" checked="checked">Sunday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="sunday">Sunday</label></div>
					@endif
					@if(in_array('monday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="monday" checked="checked">Monday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="monday">Monday</label></div>
					@endif
					@if(in_array('tuesday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="tuesday" checked="checked">Tuesday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="tuesday">Tuesday</label></div>
					@endif
					@if(in_array('wednesday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="wednesday" checked="checked">Wednesday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="wednesday">Wednesday</label></div>
					@endif
					@if(in_array('thursday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="thursday" checked="checked">Thursday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="thursday">Thursday</label></div>
					@endif
					@if(in_array('friday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="friday" checked="checked">Friday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="friday">Friday</label></div>
					@endif
					@if(in_array('saturday', $days))
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="saturday" checked="checked">Saturday</label></div>
					@else
						<div class="checkbox"><label><input type="checkbox" name="days[{{$counter}}][]" value="saturday">Saturday</label></div>
					@endif

					<div class="form-group">
						<div class="row">
							<div class="col-sm-2">
								<label>*Start Time</label>
							</div>
							<div class="col-sm-2">
								<input type="time" class="form-control" name="starttime[]" value="{{$info[0]}}">
							</div>
							<div class="col-sm-2">
								<label>*End Time</label>
							</div>
							<div class="col-sm-2">
								<input type="time" class="form-control" name="endtime[]" value="{{$info[1]}}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Course Title</label>
						<input type="text" class="form-control" name="title[]" value="{{$info[2]}}">
					</div>
					<div class="form-group">
						<label>Building</label>
						<input type="text" class="form-control" name="building[]" value="{{$info[3]}}">
					</div>
					<div class="form-group">
						<label>Room</label>
						<input type="text" class="form-control" name="rooms[]" value="{{$info[4]}}">
					</div>
					<input type="hidden" name="color[]" value="Grey">
				</div>
				<?php $counter++; ?>
				<script>
					counter++;
				</script>
			@endforeach
		@else
			<div id="shift0" class="well">
				<label>*Days:</label>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="sunday">Sunday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="monday">Monday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="tuesday">Tuesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="wednesday">Wednesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="thursday">Thursday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="friday">Friday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="saturday">Saturday</label></div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-2">
							<label>*Start Time</label>
						</div>
						<div class="col-sm-2">
							<input type="time" class="form-control" name="starttime[]">
						</div>
						<div class="col-sm-2">
							<label>*End Time</label>
						</div>
						<div class="col-sm-2">
							<input type="time" class="form-control" name="endtime[]">
						</div>
					</div>
				</div>
				<input type="hidden" name="color[]" value="Grey">
			</div>
		@endif
		<button type="button" class="btn btn-primary" onclick="counter=addShift(counter);">Add Shift</button>
		<button type="button" class="btn btn-warning" onclick="counter=removeShift(counter);">Remove Shift</button>
		<button type="submit" class="btn btn-success">Done</button>
	</form>
	
	<br/>
	<br/>
	<br/>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection