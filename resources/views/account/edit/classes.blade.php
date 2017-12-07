@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<?php
		$colors = array("Tomato", "DodgerBlue", "Violet", "MediumSeaGreen", "LightGray", "Orange", "SlateBlue", "Gray");
	?>
	<form action="{{route('classes')}}" method="post">
		@if(session('semester') == 'fall')
			<?php $s = $schedule->fallclasses;?>
			<h1>Fall</h1>
		@elseif(session('semester') == 'spring')
			<?php $s = $schedule->springclasses;?>
			<h1>Spring</h1>
		@endif
		{{ csrf_field()}}
		@if($s != "")
			<script>counter = -1;</script>
			<?php $counter = 0;?>
			@foreach(explode('|', $s) as $class)
				<?php
						$split = explode('/', $class);
						$days = explode(',', $split[0]);
						$info = explode(',', $split[1]);
				?>
				<h4>No class location information will be shared with anyone other than you</h4>
				<div id="class{{$counter}}" class="well">
					<label>*Days:</label>
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

					<div class="form-group">
						<div class="row">
							<div class="col-sm-2">
								<label>*Start Time</label>
							</div>
							<div class="col-sm-4">
								<input type="time" class="form-control" name="starttime[]" value="{{$info[0]}}">
							</div>
							<div class="col-sm-2">
								<label>*End Time</label>
							</div>
							<div class="col-sm-4">
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
					<input type="hidden" name="color[]" value="{{$colors[$counter]}}">
				</div>
				<?php $counter++; ?>
				<script>
					counter++;
				</script>
			@endforeach
		@else
			<h4>No class location information will be shared with anyone other than you</h4>
			<div id="class0" class="well">
				<label>*Days:</label>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="monday">Monday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="tuesday">Tuesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="wednesday">Wednesday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="thursday">Thursday</label></div>
				<div class="checkbox"><label><input type="checkbox" name="days[0][]" value="friday">Friday</label></div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-2" style="text-align: right;">
							<label>*Start Time:</label>
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" name="starttime[]">
						</div>
						<div class="col-sm-2" style="text-align: right;">
							<label>*End Time: </label>
						</div>
						<div class="col-sm-4">
							<input type="time" class="form-control" name="endtime[]">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Course Title</label>
					<input type="text" class="form-control" name="title[]">
				</div>
				<div class="form-group">
					<label>Building</label>
					<input type="text" class="form-control" name="building[]">
				</div>
				<div class="form-group">
					<label>Room</label>
					<input type="text" class="form-control" name="rooms[]">
				</div>
				<input type="hidden" name="color[]" value="{{$colors[0]}}">
			</div>
		@endif
		<button type="button" class="btn btn-primary" onclick="counter=addCls(counter);">Add Class</button>
		<button type="button" class="btn btn-warning" onclick="counter=removeCls(counter);">Remove Class</button>
		<button type="submit" class="btn btn-success">Done</button>
	</form>
	
	<br/>
	<br/>
	<br/>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection