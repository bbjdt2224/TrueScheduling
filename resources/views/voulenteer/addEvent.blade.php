@extends('layouts.app')

@section('content')
	<script>
		var counter = 0;
	</script>
	<style>
		.check{
			background-color: #1E90FF;
		}
	</style>
	<?php
		$g = "";
		foreach($groups as $gr){
			if($gr->id == $id){
				$g = $gr;
			}
		}
	?>
	<h3>
    	<a href='{{route('groupHome', ['id' => $id, 'page' => "voulenteer"])}}'>
    		<span class="glyphicon glyphicon-arrow-left"></span>
    		{{$g->name}}
    	</a>
    </h3>
	<form method='post' action='{{route('addVoulenteerEvent')}}' class="form-horizontal" id="form">
		{{ csrf_field()}}
		<div class="row">
			<div class="col-md-8">
				<?php
					$month = date('m', time());
					$year = date('Y', time());
				?>
				<script type="text/javascript">
					var month = {{$month}}-1;
					var year = {{$year}};
					var v = 1;
				</script>
				<table class='table'>
					<caption style="text-align: center;">
						<span style="float: left;" class="btn btn-default" id="prevMonth"> << </span>
						<span id="title" style="font-size: 20px;">{{date('F', time())}} {{$year}}</span>
						<span style="float: right;" class="btn btn-default" id="nextMonth"> >> </span>
					</caption>
					<thead>
						<th>S</th>
						<th>M</th>
						<th>T</th>
						<th>W</th>
						<th>Th</th>
						<th>F</th>
						<th>S</th>
					</thead>
					<tbody>
						<?php
							$firstday = date('w', strtotime('1-'.date('m-Y', time())));
						?>
						<tr>
							@for($i = 0; $i < $firstday; $i ++)
								<td>
									<label id="{{$i}}" onclick="addCheck(this, month, year);" class="btn"></label>
								</td>
							@endfor
							@for($i = 1; $i <= date('t', time()); $i ++)
								<td>
									<label id="{{$i+$firstday-1}}" onclick="addCheck(this, month, year);" class="btn btn-default" style="font-size: 8pt;">{{sprintf("%02d", $i)}}</label>
								</td>
								@if( ($i+$firstday)%7 == 0)
									</tr><tr>
								@endif
							@endfor
							@for($i = 0; $i < (7-((date('t', time())+$firstday)%7)); $i ++)
								<td>
									<label id="{{(date('t', time())+$firstday)+$i}}" onclick="addCheck(this, month, year); " class="btn"></label>
								</td>
							@endfor
						</tr>
						<tr>
							@for($i = 35; $i < 42 ; $i ++)
								<td>
									<label id="{{$i}}" onclick="addCheck(this, month, year);" class="btn"></label>
								</td>
							@endfor
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4 well" id="dates"  style="text-align: center;">
				<h3>Dates</h3>
				<hr/>
			</div>
		</div>
		<input type="hidden" name="group" value="{{$id}}">
		<input type="hidden" name="dates" id="d" value=" ">
		<input type="hidden" name="numofshifts" id="s" value=" ">
		Number of People Per Time Slot
		<input type="number" name="number" class="form-control" required>
		Event Name
		<input type="text" name="name" class="form-control" required>
		<br>
		Event Description
		<textarea name="description" class="form-control"></textarea>
		<br/>
		<button type="button" onclick="insertDates();" class="btn btn-primary">Add Event</button>
	</form>
	<br/>
	<br/>
	<br/>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection