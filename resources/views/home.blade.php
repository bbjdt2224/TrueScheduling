@extends('layouts.app')

@section('content')
    <?php
        $sunday = array();
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $saturday = array();
        $begin = 24; 
        $end = 0;
        $classSchedule = explode('|', $schedule->classes);
        $workSchedule = explode('|', $schedule->work);
        $dayArray = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
        for($i = 0; $i < count($classSchedule); $i ++){
        	$split = explode('/', $classSchedule[$i]);
        	$days = explode(',', $split[0]);
        	$info = explode(',', $split[1]); 
          for($j = 0; $j < 7; $j ++){
            if(in_array($dayArray[$j], $days)){
              if($info[1] < $info[0]){
                $info[1] = numberToTime(timeToNumber($info[1]) + 24);
              }
              ${$dayArray[$j]}[$i][] = $info[0];//start time
              ${$dayArray[$j]}[$i][] = $info[1];//end time
              ${$dayArray[$j]}[$i][] = $info[2];//title
              ${$dayArray[$j]}[$i][] = $info[3];//building
              ${$dayArray[$j]}[$i][] = $info[4];//room
              ${$dayArray[$j]}[$i][] = $info[5];//color
              if(timeToNumber($info[0]) < $begin){
                $begin = timeToNumber($info[0]);
              }
              if(timeToNumber($info[1]) > $end){
                $end = timeToNumber($info[1]);
              }
            }
          }
        }
        for($i = 0; $i < count($workSchedule); $i ++){
          $split = explode('/', $workSchedule[$i]);
          $days = explode(',', $split[0]);
          $info = explode(',', $split[1]); 
          for($j = 0; $j < 7; $j ++){
            if(in_array($dayArray[$j], $days)){
              if($info[1] < $info[0]){
                $info[1] = numberToTime(timeToNumber($info[1]) + 24);
              }
              ${$dayArray[$j]}[$i][] = $info[0];//start time
              ${$dayArray[$j]}[$i][] = $info[1];//end time
              ${$dayArray[$j]}[$i][] = "Work";//title
              ${$dayArray[$j]}[$i][] = " ";//building
              ${$dayArray[$j]}[$i][] = " ";//room
              ${$dayArray[$j]}[$i][] = $info[2];//color
              if(timeToNumber($info[0]) < $begin){
                $begin = timeToNumber($info[0]);
              }
              if(timeToNumber($info[1]) > $end){
                $end = timeToNumber($info[1]);
              }
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
        if(timeToNumber($n) >= 24){
          $n = numberToTime(timeToNumber($n) - 24);
        }
       		$newtime = date("g:i a", strtotime($n));
       		return $newtime;
       }
    ?>
    <table class="table">
    	<thead>
    		<th></th>
        <th>Sunday</th>
    		<th>Monday</th>
    		<th>Tuesday</th>
    		<th>Wednesday</th>
    		<th>Thursday</th>
    		<th>Friday</th>
        <th>Saturday</th>
    	</thead>
    	<tbody>
    		@for($i = $begin; $i <= $end; $i+= 0.5)
    			<tr>
    				<td>{{to12(numberToTime($i))}}</td>
    				<?php
						$week = array("sunday","monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
    				?>
					@for($j = 0; $j < 7; $j ++)
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
    							<td style="background-color:{{$times[5]}}; border-top: none;"></td>
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
