@extends('layouts.app')

@section('content')
	<form method="post" >
		{{ csrf_field()}}
		<?php
			$daytimes = explode('|', $event->times);
			$days = explode(',', $event->days);


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
		?>
		@for($i = 0; $i < count($days); $i ++)
			@foreach(explode('/', $daytimes[$i]) as $shift)
				<?php
					$split = explode(',', $shift);
					$start = $split[0];
					$end = $split[1];
				?>
				{{$days[$i]}}
				<br/>
				{{to12($start)."-".to12($end)}}
				<br/>
			@endforeach
		@endfor
		<button time="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection