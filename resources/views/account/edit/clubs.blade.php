@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<form action="{{route('clubs')}}" method="post">
		@if(session('semester') == 'fall')
			<?php $s = $schedule->fallclubs;?>
		@elseif(session('semester') == 'spring')
			<?php $s = $schedule->springclubs;?>
		@endif
		{{ csrf_field()}}
		@if($s != "")
			<script>counter = -1;</script>
			<?php $counter = 0;?>
			@foreach(explode('|', $s) as $club)
				<?php
					if($club != ""){
						$split = explode('/', $club);
						$days = explode(',', $split[0]);
						$info = explode(',', $split[1]);
					}
					else{
						$days = array();
						$info = array("", "", "", "");
					}
				?>
				<div id="club{{$counter}}" class="well">
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

					<br/>
					Club Name
					<input type="text" name="name[]" class="form-control" value="{{$info[0]}}">
					<br/>

					<div class="form-group">
						<div class="row">
							<div class="col-sm-2">
								<label>*Start Time</label>
							</div>
							<div class="col-sm-2">
								<input type="time" class="form-control" name="starttime[]" value="{{$info[1]}}">
							</div>
							<div class="col-sm-2">
								<label>*End Time</label>
							</div>
							<div class="col-sm-2">
								<input type="time" class="form-control" name="endtime[]" value="{{$info[2]}}">
							</div>
						</div>
					</div>
					<input type="hidden" name="color[]" value="Yellow">
				</div>
				<?php $counter++; ?>
				<script>
					counter++;
				</script>
			@endforeach
		@else
			<div id="club0" class="well">
				<label>*Days:</label>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="sunday">Sunday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="monday">Monday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="tuesday">Tuesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="wednesday">Wednesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="thursday">Thursday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="friday">Friday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="saturday">Saturday</label></div>
				<br/>
				Club Name
				<input type="text" name="name[]" class="form-control">
				<br/>
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
				<input type="hidden" name="color[]" value="Yellow">
			</div>
		@endif
		<button type="button" class="btn btn-primary" onclick="counter=addClub(counter);">Add Meeting</button>
		<button type="button" class="btn btn-warning" onclick="counter=removeClub(counter);">Remove Meeting</button>
		<button type="submit" class="btn btn-success">Done</button>
	</form>
	
	<br/>
	<br/>
	<br/>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection