@extends('layouts.app')

@section('content')
	<form method="post" action="{{route('addVoulenteers')}}" id="form">
		{{ csrf_field()}}
		<?php
			$daytimes = explode('|', $event->times);
			$days = explode(',', $event->days);
			$voulenteersdays = explode('|',$event->voulenteers);


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
		<script type="text/javascript">
			var days = "{{$event->days}}";
			days = days.split(',');
			var times = "{{$event->times}}";
			times = times.split('|');
			var voulenteer = "{{$event->voulenteers}}";
			voulenteer = voulenteer.split('|');
			var voulenteers = [];
			var removearr = [];
			var i = 0;
			var j = 0;
			for(i; i < days.length; i++){
				var time = times[i].split('/');
				var varray = [];
				var rarray = [];
				for(j; j < time.length; j++){
					varray.push(" ");
					rarray.push(" ");
				}
				voulenteers.push(varray);
				removearr.push(rarray);
			}
		</script>
		@for($i = 0; $i < count($days); $i ++)
			<?php
				$shiftCounter = 0;
				$voulenteershifts = explode('/', $voulenteersdays[$i]);
			?>
			@foreach(explode('/', $daytimes[$i]) as $shift)
				<?php
					$vlntrs = explode(',', $voulenteershifts[$shiftCounter]);
					$split = explode(',', $shift);
					$start = $split[0];
					$end = $split[1];
				?>
				{{$days[$i]}}
				<br/>
				{{to12($start)."-".to12($end)}}
				<br/>
				<div class="list-group">
					<?php $taken = 0;?>
					@for($j = 0; $j < $event->number; $j ++)
						@if(sizeof($vlntrs) > $j && $vlntrs[$j] != " " && $vlntrs[$j] != "")
							@if(str_replace(' ', '', Auth::user()->name) == str_replace(' ', '', $vlntrs[$j]))
								<a href="#" class="list-group-item active" class="list-group-item {{$i.$shiftCounter}}" id="shift{{$i.$shiftCounter.$j}}" onclick="selectVoulenteering({{$i}}, {{$shiftCounter}}, 'shift{{$i.$shiftCounter.$j}}', '{{Auth::user()->name}}');">
									{{$vlntrs[$j]}}
								</a>
								<?php $taken = 1;?>
							@else
								<a href="#" class="list-group-item disabled">{{$vlntrs[$j]}}</a>
							@endif
						@else
							@if($taken == 1)
								<a href="#" class="list-group-item disabled"></a>
							@else
								<a href="#" class="list-group-item {{$i.$shiftCounter}}" id="shift{{$i.$shiftCounter.$j}}" onclick="selectVoulenteering({{$i}}, {{$shiftCounter}}, 'shift{{$i.$shiftCounter.$j}}', '{{Auth::user()->name}}');"></a>
							@endif
						@endif
					@endfor
				</div>
				<?php
					$shiftCounter++;
				?>
			@endforeach
		@endfor
		<input type="hidden" name="id" value="{{$event->id}}">
		<input type="hidden" name="voulenteers" id="voulenteers" value=" ">
		<input type="hidden" name="remove" id="remove" value=" ">
		<input type="hidden" name="group" value="{{$event->group}}">
		<button type="button" class="btn btn-primary" onclick="insertVoulenteers();">Submit</button>
	</form>
	<script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection