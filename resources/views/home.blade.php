@extends('layouts.app')

@section('content')
    <?php
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $begin = 24; 
        $end = 0;
        $classSchedule = explode('|', $schedule->classes);
        for($i = 0; $i < count($classSchedule); $i ++){
        	$split = explode('/', $classSchedule[$i]);
        	$days = explode(',', $split[0]);
        	$info = explode(',', $split[1]); 
        	if(in_array('monday', $days)){
        		$monday[$i][] = $info[0];//start time
	        	$monday[$i][] = $info[1];//end time
	        	$monday[$i][] = $info[2];//title
	        	$monday[$i][] = $info[3];//building
	        	$monday[$i][] = $info[4];//room
	        	$monday[$i][] = $info[5];//color
            if(timeToNumber($info[0]) < $begin){
              $begin = timeToNumber($info[0]);
            }
            if(timeToNumber($info[1]) > $end){
              $end = timeToNumber($info[1]);
            }
        	}
        	if(in_array('tuesday', $days)){
        		$tuesday[$i][] = $info[0];//start time
	        	$tuesday[$i][] = $info[1];//end time
	        	$tuesday[$i][] = $info[2];//title
	        	$tuesday[$i][] = $info[3];//building
	        	$tuesday[$i][] = $info[4];//room
	        	$tuesday[$i][] = $info[5];//color
            if(timeToNumber($info[0]) < $begin){
              $begin = timeToNumber($info[0]);
            }
            if(timeToNumber($info[1]) > $end){
              $end = timeToNumber($info[1]);
            }
        	}
        	if(in_array('wednesday', $days)){
        		$wednesday[$i][] = $info[0];//start time
	        	$wednesday[$i][] = $info[1];//end time
	        	$wednesday[$i][] = $info[2];//title
	        	$wednesday[$i][] = $info[3];//building
	        	$wednesday[$i][] = $info[4];//room
	        	$wednesday[$i][] = $info[5];//color
            if(timeToNumber($info[0]) < $begin){
              $begin = timeToNumber($info[0]);
            }
            if(timeToNumber($info[1]) > $end){
              $end = timeToNumber($info[1]);
            }
        	}
        	if(in_array('thursday', $days)){
        		$thursday[$i][] = $info[0];//start time
	        	$thursday[$i][] = $info[1];//end time
	        	$thursday[$i][] = $info[2];//title
	        	$thursday[$i][] = $info[3];//building
	        	$thursday[$i][] = $info[4];//room
	        	$thursday[$i][] = $info[5];//color
            if(timeToNumber($info[0]) < $begin){
              $begin = timeToNumber($info[0]);
            }
            if(timeToNumber($info[1]) > $end){
              $end = timeToNumber($info[1]);
            }
        	}
        	if(in_array('friday', $days)){
        		$friday[$i][] = $info[0];//start time
	        	$friday[$i][] = $info[1];//end time
	        	$friday[$i][] = $info[2];//title
	        	$friday[$i][] = $info[3];//building
	        	$friday[$i][] = $info[4];//room
	        	$friday[$i][] = $info[5];//color
            if(timeToNumber($info[0]) < $begin){
              $begin = timeToNumber($info[0]);
            }
            if(timeToNumber($info[1]) > $end){
              $end = timeToNumber($info[1]);
            }
        	}
        }

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
    <table class="table">
    	<thead>
    		<th></th>
    		<th>Monday</th>
    		<th>Tuesday</th>
    		<th>Wednesday</th>
    		<th>Thursday</th>
    		<th>Friday</th>
    	</thead>
    	<tbody>
    		@for($i = $begin; $i <= $end; $i+= 0.5)
    			<tr>
    				<td>{{to12(numberToTime($i))}}</td>
    				<?php
						$week = array("monday", "tuesday", "wednesday", "thursday", "friday");
    				?>
					@for($j = 0; $j < 5; $j ++)
						<?php $isclass = 0;?>
						@foreach(${$week[$j]} as $times)
							<?php  
	    						$start = timeToNumber($times[0]);
	    						$end = timeToNumber($times[1]);
	    					?>
    						@if($start == $i)
    							<td style="background-color:{{$times[5]}};"><a href="#" data-toggle="modal" data-target="#{{$week[$j].floor($start)}}" style="color: black;">{{to12(numberToTime($start))."-".to12(numberToTime($end))}}</a></td>
    							<div id="{{$week[$j].floor($start)}}" class="modal fade" role="dialog">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header" style="background-color:{{$times[5]}};">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">{{$times[2]}}</h4>
								      </div>
								      <div class="modal-body">
								        <p>{{$times[2]}}</p>
								        <p>{{to12(numberToTime($start))."-".to12(numberToTime($end))}}</p>
								        <p>{{$times[3]}}</p>
								        <p>{{$times[4]}}</p>
								      </div>
								      <div class="modal-footer" style="background-color:{{$times[5]}};">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div>

								  </div>
								</div>
    							<?php $isclass=1;?>
    						@elseif($start < $i && $i <= $end)
    							<td style="background-color:{{$times[5]}};"></td>
    							<?php $isclass=1;?>
    						@endif
    					@endforeach
    					@if($isclass == 0)
    						<td></td>
    					@endif
					@endfor
    			</tr>
    		@endfor
    	</tbody>
    </table>
    <a href="{{route('editClasses')}}" class="btn btn-primary">Edit Classes</a>
    <a href="{{route('editWork')}}" class="btn btn-primary">Edit Work</a>
@endsection
