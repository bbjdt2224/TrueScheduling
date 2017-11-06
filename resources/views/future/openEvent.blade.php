@extends('layouts.app')

@section('content')
	<?php

		function getDecimal($n){
        	$whole = floor($n);
        	return $n - $whole;
        }

        function timeToNumber($time){
	       	$t = explode(':', $time);
	       	$number = $t[0]+($t[1]/60);
	       	return $number;
	    }

        function numberToTime($number){
       		$hour = floor($number);
       		$minute = (getDecimal($number)*60);
       		if($minute == 0){
       			$minute = "00";
       		}
       		$time = $hour.":".$minute;
       		return $time;
       }

       function to12($n){
       		$newtime = date("g:i a", strtotime($n));
       		return $newtime;
       }

		$dates = array();
		$starts = array();
		$ends = array();
		$earlystart = 24;
		$lateend = 0;
		foreach(explode('|', $event->times) as $day){
			$split = explode(',', $day);
			$starts[] = $split[0];
			$ends[] = $split[1];
		}
		for($i = 0; $i < count($starts); $i ++){
			if(timeToNumber($starts[$i]) < $earlystart){
				$earlystart = timeToNumber($starts[$i]);
			}
			if(timeToNumber($ends[$i]) > $lateend){
				$lateend = timeToNumber($ends[$i]);
			}
		}
		$g = "";
		foreach($groups as $gr){
			if($gr->id == $event->group){
				$g = $gr;
			}
		}
	?>
	<h3>
    	<a href='{{route('groupHome', ['id' => $event->group, 'page' => "pending"])}}'>
    		<span class="glyphicon glyphicon-arrow-left"></span>
    		{{$g->name}}
    	</a>
    </h3>
	<form method="post" action="{{route('save')}}">
		{{ csrf_field()}}
		<input type="hidden" value="{{$event->days}}" name="dates">
		<input type="hidden" value="{{$event->id}}" name="id">
		<input type="hidden" value="{{$event->group}}" name="group">
		<table class="table">
			<thead>
					<th></th>
				@foreach(explode(',', $event->days) as $day)
					<th>
						{{date('l', strtotime($day))}}
						<br/>
						{{date('m-d-y', strtotime($day))}}
						<?php
							$dates[] = $day;
							${$day} = array();
						?>
					</th>
				@endforeach
			</thead>
			<tbody>
				@if(date('m', strtotime($day)) < 6)
					<?php
						$semester = 'springclasses';
					?>
				@else
					<?php
						$semester = 'fallclasses';
					?>
				@endif
				@foreach(explode('|', Auth::user()->$semester) as $class)
					<?php
						if($class != ""){
							$split = explode('/', $class);
				        	$days = explode(',', $split[0]);
				        	$info = explode(',', $split[1]);
						}
						else{
							$days = array();
							$info = array("","","","","");
						}
			        	for($i = 0; $i < count($dates); $i ++){
			        		$lower = strtolower(date('l', strtotime($dates[$i])));
			        		if(in_array($lower, $days)){
			        			${$dates[$i]}[] = array($info[0], $info[1]);
			        		}
			        	}
					?>
				@endforeach
				@if(date('m', strtotime($day)) < 6)
					<?php
						$semester = 'springwork';
					?>
				@else
					<?php
						$semester = 'fallwork';
					?>
				@endif
				@foreach(explode('|', Auth::user()->$semester) as $work)
					<?php
						if($work != ""){
							$split = explode('/', $work);
				        	$days = explode(',', $split[0]);
				        	$info = explode(',', $split[1]);
						}
						else{
							$days = array();
							$info = array("", "");
						}
						
			        	for($i = 0; $i < count($dates); $i ++){
			        		$lower = strtolower(date('l', strtotime($dates[$i])));
			        		if(in_array($lower, $days)){
			        			if($info[1] < $info[0]){
			        				$info[1] = numberToTime(timeToNumber($info[1]) + 24);
			        			}
			        			${$dates[$i]}[] = array($info[0], $info[1]);
			        		}
			        	}
					?>
				@endforeach
				@for($i = $earlystart; $i <= $lateend; $i+= 0.5)
					<tr>
						<td>{{to12(numberToTime($i))}}</td>
						<?php $counter = 0;?>
						@foreach(explode(',', $event->days) as $day)
							<?php $inclass = 0?>
							@for($j = 0; $j < count(${$day}); $j ++)
								<?php
									$start = timeToNumber(${$day}[$j][0]);
									$end = timeToNumber(${$day}[$j][1]);
								?>
								@if($start <= $i && $i <= $end)
									<?php
										$inclass = 1;
									?>
								@endif
							@endfor
							@if(timeToNumber($starts[$counter]) <= $i && $i <= timeToNumber($ends[$counter]) && $inclass == 0)
								<td>
									<div class="checkbox">
										<label><input type="checkbox" value="{{$i}}" name="{{$day}}[]"></label>
									</div>
								</td>
							@else
								<td></td>
							@endif
							<?php $counter++;?>
						@endforeach
					</tr>
				@endfor
			</tbody>
		</table>
		<button time="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection