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
        $dayArray = explode(',', $event->days);
    ?>
    @foreach($dayArray as $day)
        <?php
            ${$day} = array();
            for($i = $earlystart; $i <= $lateend; $i+=0.5){
                ${$day}[$i*10] = 0;
            }
        ?>
    @endforeach
    @foreach(explode('|', $event->results) as $user)
        <?php
            $days = explode('/', $user);
        ?>
        @for($i = 0; $i < count($days); $i ++)
            @foreach(explode(',', $days[$i]) as $time)
                <?php
                    ${$dayArray[$i]}[$time*10]++;
                ?>
            @endforeach
        @endfor
    @endforeach
    <table class="table">
        <thead>
            @foreach($dayArray as $day)
                <th>
                    {{date('l', strtotime($day))}}
                    <br/>
                    {{date('m-d-y', strtotime($day))}}
                </th>
            @endforeach
        </thead>
        <tbody>
            @for($i = $earlystart; $i <= $lateend; $i+=0.5)
                <tr>
                    @foreach($dayArray as $day)
                        <td>{{${$day}[$i*10]}}</td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
@endsection