@extends('layouts.app')

@section('content')
    <style>
        .selected{
            background-color: #1E90FF;
        }
    </style>
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
                @if(is_numeric($time))
                    <?php
                        ${$dayArray[$i]}[$time*10]++;
                    ?>
                @endif
            @endforeach
        @endfor
    @endforeach
    <table class="table">
        <thead>
            <th>Time</th>
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
                    <td>{{to12(numberToTime($i))}}</td>
                    @foreach($dayArray as $day)
                        @if(${$day}[$i*10] > 0)
                            <td><label onclick="selectDate(this, '{{$day}}', '{{(numberToTime($i))}}');" class="btn btn-default">{{${$day}[$i*10]}}</label></td>
                        @else
                            <td>{{${$day}[$i*10]}}</td>
                        @endif
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
    <form class="form-horizontal" action="{{route('add')}}" method="post">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="date">Date: </label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="time">Time: </label>
            <input type="time" class="form-control" id="time" name="time">
        </div>
        <input type="hidden" name="id" value="{{$event->id}}">
        <input type="hidden" name="group" value="{{$event->group}}">
        <input type="hidden" name="name" value="{{$event->name}}">
        <input type="hidden" name="description" value="{{$event->description}}">
        <input type="hidden" name="future" value="1">
        <button type="submit" class="btn btn-default">Set Event</button>
    </form>
    <script type="text/javascript" src="{{asset('js/edit.js')}}"></script>
@endsection