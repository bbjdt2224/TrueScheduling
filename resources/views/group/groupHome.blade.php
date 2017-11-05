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
	?>
	<div class="jumbotron">
		<h1>{{$group->name}}</h1>
		@if($group->open == 1 || $group->lead == Auth::id())
			<h3>Group Code: <span style="color:red">{{$group->code}}</span></h3>
		@endif
	</div>
	<br/>
	@if($group->open == 1 || $group->lead == Auth::id())
		<a href="{{route('addFutureEvent', ['id' => $group->id])}}" class="btn btn-primary">Plan Event</a>
		<a href="{{route('addEvent', ['id' => $group->id])}}" class="btn btn-primary">Add Event</a>
		<a href="{{route('addVoulenteer', ['id' => $group->id])}}" class="btn btn-primary">Ask for Voulenteers</a>
	@endif
	<br/>
	<br/>
	<ul class="nav nav-tabs">
		@if($page == "message")
			<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
		@elseif($page == "pending")
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
	    @elseif($page == "voulenteer")
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
			<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
		@elseif($page == "upcoming")
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
			<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
	    @elseif($page == "calendar")
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
	    @elseif($page == "group")
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Pending Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
	    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
	    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
	    @endif
	  </ul>
	  <br/>
	  @if($page == "message")
	  	<form method="post">
	  		<textarea name="message" class="form-control"></textarea>
	  		<input type="hidden" name="group" value="{{$group->id}}">
	  		<input type="hidden" name="id" value="{{Auth::id()}}">
	  		<button type="submit" class="btn btn-primary">Post</button>
	  	</form>
	  	@foreach($messages->message as $message)

	  	@endforeach
	  @elseif($page == "pending")
	  	<ul class="list-group">
	  		@if(isset($futureevents->name))
				<li class="list-group-item">
					There are no upcoming events
				</li>
			@else
				@foreach($futureevents as $event)
					<li class="list-group-item" style="height: 60px;">
						{{$event->name}}
						@if($group->open == 1 || $group->lead == Auth::id())
							<a href="{{route('viewResults', ['id' => $event->id])}}" class="btn btn-primary" style="float:right;">View Results</a>
						@endif
						@if(!in_array(Auth::id(), explode(',', $event->responded)))
							<a href="{{route('openEvent', ['id' => $event->id])}}" class="btn btn-primary" style="float:right; width: 100px;">Open</a>
						@else
							<a href="{{route('editEvent', ['id' => $event->id])}}" class="btn btn-primary" style="float:right; width: 100px;">Edit</a>
						@endif
					</li>
				@endforeach
			@endif
		</ul>
	  @elseif($page == "voulenteer")
	  	<ul class="list-group">
	  		@if(isset($voulenteers->name))
				<li class="list-group-item">
					There are no voulenteering opportunities
				</li>
			@else
				@foreach($voulenteers as $event)
					<li class="list-group-item" style="height: 60px;">
						{{$event->name}}
							<a href="{{route('openVoulenteer', ['id' => $event->id])}}" class="btn btn-primary" style="float:right; width: 100px;">
								Open
							</a>
					</li>
				@endforeach
			@endif
		</ul>
	  @elseif($page == "upcoming")
			<div class="panel-group">
				@if(isset($events->name))
					<div class="panel panel-default">
						There are no upcoming events
					</div>
				@else
					@foreach($events as $event)
						@if(strtotime($event->date) >= time());
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#{{$event->id}}">{{$event->name}}<span style="float: right;"> {{date('m/d',strtotime($event->date))." | ".to12($event->starttime)}}</span></a>
									</h4>
								</div>
								<div class="panel-collapse collapse" id="{{$event->id}}">
									{{$event->description}}
								</div>
							</div>
						@endif
					@endforeach
				@endif
			</div>
		@elseif($page == 'calendar')
			<?php
				$startdayofweek = date('w', strtotime(date('01-m-Y', time())));
				$daysinmonth = date('t', time());
				$endofdate = date('Y-m-', time());
				$month = date('m', time());
				$year = date('Y', time());
				$dates = array();
				$names = array();
				$descriptions = array();
				foreach($events as $event){
					$dates[] = $event->date;
					$names[] = $event->name;
					$times[] = $event->starttime;
					$descriptions[] = $event->description;
					$j = 0;
				}
			?>
			<script type="text/javascript">
				var month = {{$month}}-1;
				var year = {{$year}};
				var dates = "{{implode(',',$dates)}}";
				dates = dates.split(',');
				var names = "{{implode(',', $names)}}";
				names = names.split(',');
				console.log(names);
				var descriptions = "{{implode(',', $descriptions)}}";
				descriptions = descriptions.split(',');
			</script>
			<table class="table">
				<caption style="text-align: center;">
					<span style="float: left" class="btn btn-default" id="prevMonth"> << </span>
					<span style="font-size: 20px;" id="title">{{date('F Y', time())}}</span>
					<span style="float: right;" class="btn btn-default" id="nextMonth"> >> </span>
				</caption>
				<thead>
					<th>Sunday</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
				</thead>
				<tbody>
					<tr>
						@for($i = 0; $i < $startdayofweek; $i ++)
							<td id="{{$i}}"></td>
						@endfor
						@for($i = 1; $i <= $daysinmonth; $i ++)
							@if($index = array_search(($endofdate.sprintf('%02d', $i)), $dates))
								<td style="background-color: cyan;" id="{{($startdayofweek + $i - 1)}}">
									<a href="#" data-toggle="popover" title="{{$names[$index]." | ".to12($times[$index])}}" data-content="{{$descriptions[$index]}}">
										{{sprintf('%02d', $i)}}
									</a>
								</td>
								<?php $j++; ?>
							@else
								<td id="{{($startdayofweek + $i - 1)}}">{{sprintf('%02d', $i)}}</td>
							@endif
							@if( (($i + $startdayofweek) % 7) == 0 )
								</tr><tr>
							@endif
						@endfor
						@for($i = 0; $i < (7-(($startdayofweek+$daysinmonth)%7)); $i++)
							<td id="{{$startdayofweek+$daysinmonth+$i}}"></td>
						@endfor
					</tr>
				</tbody>
			</table>
		@elseif($page == 'group')
			<form action="{{ route('groupHome', ['id' => $group->id, 'page' => 'group'])}}" method="post" class="form-inline" id="groupschedule">
				{{ csrf_field()}}
				<select name='day' class="form-control" onchange="$('#groupschedule').submit()">
					@if($day == "Sunday")
						<option selected="selected">Sunday</option>
					@else
						<option>Sunday</option>
					@endif
					@if($day == "Monday")
						<option selected="selected">Monday</option>
					@else
						<option>Monday</option>
					@endif
					@if($day == "Tuesday")
						<option selected="selected">Tuesday</option>
					@else
						<option>Tuesday</option>
					@endif
					@if($day == "Wednesday")
						<option selected="selected">Wednesday</option>
					@else
						<option>Wednesday</option>
					@endif
					@if($day == "Thursday")
						<option selected="selected">Thursday</option>
					@else
						<option>Thursday</option>
					@endif
					@if($day == "Friday")
						<option selected="selected">Friday</option>
					@else
						<option>Friday</option>
					@endif
					@if($day == "Saturday")
						<option selected="selected">Saturday</option>
					@else
						<option>Saturday</option>
					@endif
				</select>
			</form>
			<?php
				$memberarray = array();
				$counter = 0;
				foreach($members as $member){
					$memberarray[$counter]["name"] = $member->name;
					if(session('semester') == 'fall'){
						$classSchedule = explode('|', $member->fallclasses);
					}
					elseif(session('semester') == 'spring'){
						$classSchedule = explode('|', $member->springclasses);
					}
					
			        for($i = 0; $i < count($classSchedule); $i ++){
			        	$split = explode('/', $classSchedule[$i]);
			        	$days = explode(',', $split[0]);
			        	$info = explode(',', $split[1]);
			        	if(in_array(strtolower($day), $days)){
			        		$memberarray[$counter][$i][] = $info[0];//start time
				        	$memberarray[$counter][$i][] = $info[1];//end time
			        	}
			        }
			        $counter++;
				}
			?>
			<table class="table">
				<thead>
					<th>Time</th>
					@foreach($memberarray as $member)
						<th>{{$member["name"]}}</th>
					@endforeach
				</thead>
				<tbody>
					@for($i = 8; $i < 22; $i += 0.5)
						<tr>
							<td>{{to12(numberToTime($i))}}</td>
							@foreach($memberarray as $member)
								<?php $isclass = 0;?>
								@foreach($member as $class)
									@if(!is_string($class))
										<?php
											$start = timeToNumber($class[0]);
				    						$end = timeToNumber($class[1]);
				    					?>
										@if($start <= $i && $i <= $end)
											<td>x</td>
											<?php $isclass = 1; ?>
										@endif
									@endif
								@endforeach
								@if($isclass == 0)
									<td></td>
								@endif
							@endforeach
						</tr>
					@endfor
				</tbody>
			</table>
		@endif
		<script src="{{asset('js/calendar.js')}}"></script>
@endsection