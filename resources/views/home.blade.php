@extends('layouts.app')

@section('content')
    <?php
        if(session('semester') == null){
            if(date('m', time()) < 6){
                session(['semester' => 'spring']);
            }
            else{
                session(['semester' => 'fall']);
            }
        }
        $sunday = array();
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $saturday = array();
        $begin = 24; 
        $end = 0;
        if(session('semester') == 'fall'){
          $classSchedule = explode('|', $schedule->fallclasses);
          $workSchedule = explode('|', $schedule->fallwork);
          $clubSchedule = explode('|', $schedule->fallclubs);
          echo "<h1>Fall</h1>";
        }
        elseif(session('semester') == 'spring'){
          $classSchedule = explode('|', $schedule->springclasses);
          $workSchedule = explode('|', $schedule->springwork);
          $clubSchedule = explode('|', $schedule->springclubs);
          echo "<h1>Spring</h1>";
        }
        $dayArray = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
        for($i = 0; $i < count($classSchedule); $i ++){
          if($classSchedule[0] == ""){
            break;
          }
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
          if($workSchedule[0] == ""){
            break;
          }
          $split = explode('/', $workSchedule[$i]);
          $days = explode(',', $split[0]);
          $info = explode(',', $split[1]); 
          for($j = 0; $j < 7; $j ++){
            if(in_array($dayArray[$j], $days)){
              if($info[1] < $info[0]){
                $info[1] = numberToTime(timeToNumber($info[1]) + 24);
              }
              ${$dayArray[$j]}[$i+count($classSchedule)][] = $info[0];//start time
              ${$dayArray[$j]}[$i+count($classSchedule)][] = $info[1];//end time
              ${$dayArray[$j]}[$i+count($classSchedule)][] = "Work";//title
              ${$dayArray[$j]}[$i+count($classSchedule)][] = " ";//building
              ${$dayArray[$j]}[$i+count($classSchedule)][] = " ";//room
              ${$dayArray[$j]}[$i+count($classSchedule)][] = $info[2];//color
              if(timeToNumber($info[0]) < $begin){
                $begin = timeToNumber($info[0]);
              }
              if(timeToNumber($info[1]) > $end){
                $end = timeToNumber($info[1]);
              }
            }
          }
        }
        for($i = 0; $i < count($clubSchedule); $i ++){
          if($clubSchedule[0] == ""){
            break;
          }
          $split = explode('/', $clubSchedule[$i]);
          $days = explode(',', $split[0]);
          $info = explode(',', $split[1]); 
          for($j = 0; $j < 7; $j ++){
            if(in_array($dayArray[$j], $days)){
              if($info[2] < $info[1]){
                $info[2] = numberToTime(timeToNumber($info[2]) + 24);
              }
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = $info[1];//start time
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = $info[2];//end time
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = $info[0];//title
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = " ";//building
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = " ";//room
              ${$dayArray[$j]}[$i+count($classSchedule)+count($workSchedule)][] = $info[3];//color
              if(timeToNumber($info[1]) < $begin){
                $begin = timeToNumber($info[1]);
              }
              if(timeToNumber($info[2]) > $end){
                $end = timeToNumber($info[2]);
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

    <a href="{{route('editClasses')}}" class="btn btn-primary">Edit Classes</a>
    <a href="{{route('editWork')}}" class="btn btn-primary">Edit Work</a>
    <a href="{{route('editClubs')}}" class="btn btn-primary">Edit Clubs</a>

    <table class="table">
    	<thead>
    		<th></th>
        <th>Su</th>
    		<th>M</th>
    		<th>T</th>
    		<th>W</th>
    		<th>Th</th>
    		<th>F</th>
        <th>Sa</th>
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
	    						$finish = timeToNumber($times[1]);
	    					?>
    						@if($start == $i && $isclass == 0)
    							<td style="background-color:{{$times[5]}};"><a href="#" data-toggle="modal" data-target="#{{$week[$j].floor($start)}}" style="color: black;">{{to12(numberToTime($start))."-".to12(numberToTime($finish))}}</a></td>
    							<div id="{{$week[$j].floor($start)}}" class="modal fade" role="dialog">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header" style="background-color:{{$times[5]}};">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">{{$times[2]}}</h4>
								      </div>
								      <div class="modal-body">
								        <p>{{$times[2]}}</p>
								        <p>{{to12(numberToTime($start))."-".to12(numberToTime($finish))}}</p>
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
    						@elseif($start < $i && $i <= $finish && $isclass == 0)
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
@endsection
