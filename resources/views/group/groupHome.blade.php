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
			@if($group->lead == Auth::id())
				<a href="{{route('editGroup', ['id'=>$group->id])}}" class="btn btn-warning" style="float: right;">Edit Group</a>
			@endif
		@endif
		@if($group->lead != Auth::id())
			<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#leave" style="float: right;">Leave Group</a>
			<div id="leave" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Are you sure you want to be removed from the group?</h4>
						</div>
						<div class="modal-body">
							<a href="{{route('leaveGroup', ['id'=>$group->id])}}" class="btn btn-default">Yes</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	<br/>
	@if($group->open == 1 || $group->lead == Auth::id())
		<div class="btn-group btn-group-justified">
			<a href="{{route('addFutureEvent', ['id' => $group->id])}}" class="btn btn-primary">Ask for Times</a>
			<a href="{{route('addEvent', ['id' => $group->id])}}" class="btn btn-primary">Add Event</a>
			<a href="{{route('addVoulenteer', ['id' => $group->id])}}" class="btn btn-primary">Ask for Voulenteers</a>
		</div>
	@endif
	<br/>
	<br/>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#tabs">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>
		</div>
		<div class="collapse navbar-collapse" id="tabs">
			<ul class="nav navbar-nav">
				@if($page == "message")
					<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
				@elseif($page == "pending")
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
					<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
			    @elseif($page == "voulenteer")
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
					<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
				@elseif($page == "upcoming")
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
					<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
			    @elseif($page == "calendar")
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
			    @elseif($page == "group")
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "message"])}}">Messages</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "pending"])}}">Asking for Times</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "voulenteer"])}}">Voulenteering</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "upcoming"])}}">Upcoming Events</a></li>
			    	<li><a href="{{route('groupHome', ['id' => $group->id, 'page' => "calendar"])}}">Calendar</a></li>
			    	<li class="active"><a href="{{route('groupHome', ['id' => $group->id, 'page' => "group"])}}">Group Schedule</a></li>
			    @endif
			  </ul>
		</div>
	</div>
</nav>
	
	  <br/>
	  @if($page == "message")
	  	<h1>Messages</h1>
	  	<form method="post" action="{{route('addMessage')}}">
	  		{{ csrf_field()}}
	  		<textarea name="message" class="form-control"></textarea>
	  		<input type="hidden" name="group" value="{{$group->id}}">
	  		<input type="hidden" name="id" value="{{Auth::id()}}">
	  		<br/>
	  		<button type="submit" class="btn btn-primary">Post</button>
	  		<br/>
	  		<br/>
	  	</form>
	  	@if(isset($messages[0]->message))
		  	@foreach($messages as $message)
		  		<div class="well">
		  			<h3>
		  				{{$users[$message->user]}} 
		  				<span style="font-size: 12pt;">Posted</span>
		  				<span style="color: LightGray; font-size: 12pt;"><i>{{date('m/d/y', strtotime($message->created_at))}}</i></span>
		  				<span style="color: LightGray; font-size: 12pt;"><i>{{date('g:m a', strtotime($message->created_at))}}</i></span>
		  			</h3>
		  			
		  			<hr/>
		  			<p>{{$message->message}}</p>
		  		</div>
		  	@endforeach
		@else
			<h3>There are no messages</h3>
		@endif
	  @elseif($page == "pending")
	 	 <h1>Asking for Times</h1>
	  	<ul class="list-group">
	  		@if(!isset($futureevents[0]->name))
				<li class="list-group-item">
					There is no one asking for times
				</li>
			@else
				@foreach($futureevents as $event)
					<li class="list-group-item" style="height: 60px;">
						{{$event->name}}
						@if($event->creator == Auth::id())
							<a href="{{route('deleteFuture', ['id' => $event->id, 'group' => $group->id])}}" style="float: right;">
								<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete Event">
									<span class="glyphicon glyphicon-remove"></span>
								</button>
							</a>
							<a href="{{route('viewResults', ['id' => $event->id])}}" style="float:right;">
								<button type="button" class="btn btn-primary" data-toggle="tooltip" title="View Responses">
									<span class="glyphicon glyphicon-eye-open"></span>
								</button>
							</a>
							
						@endif
						@if(!in_array(Auth::id(), explode(',', $event->responded)))
							<a href="{{route('openEvent', ['id' => $event->id])}}" style="float:right;">
								<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Respond">
									<span class="glyphicon glyphicon-folder-open"></span>
								</button>
							</a>
						@else
							<a href="{{route('editEvent', ['id' => $event->id])}}" style="float:right;">
								<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Edit Response">
									<span class="glyphicon glyphicon-pencil"></span>
								</button>
							</a>
						@endif
					</li>
				@endforeach
			@endif
		</ul>
	  @elseif($page == "voulenteer")
	  	<h1>Voulenteering</h1>
	  	<ul class="list-group">
	  		@if(!isset($voulenteers[0]->name))
				<li class="list-group-item">
					There are no voulenteering opportunities
				</li>
			@else
				@foreach($voulenteers as $event)
					<li class="list-group-item" style="height: 60px;">
						{{$event->name}}
							@if($event->creator == Auth::id())
								<a href="{{route('deleteVoulenteer', ['id' => $event->id , 'group' => $group->id])}}" style="float: right;">
									<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete Event">
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</a>
							@endif
							<a href="{{route('openVoulenteer', ['id' => $event->id])}}" style="float:right;">
								<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Sign Up">
									<span class="glyphicon glyphicon-folder-open"></span>
								</button>
							</a>
					</li>
				@endforeach
			@endif
		</ul>
	  @elseif($page == "upcoming")
	  	<h1>Upcoming Events</h1>
			<div class="panel-group">
				@if(!isset($events[0]->name))
					<div class="panel panel-default">
						<div class="panel-heading">
							There are no upcoming events
						</div>
					</div>
				@else
					@foreach($events as $event)
						@if(strtotime($event->date) >= time());
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title" style="height: 40px;">
										<a data-toggle="collapse" href="#{{$event->id}}">
											{{$event->name}}
											@if($event->creator == Auth::id())
												<a href="{{route('deleteEvent', ['id' => $event->id, 'group' => $group->id])}}" style="float: right;">
													<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Delete Event">
														<span class="glyphicon glyphicon-remove"></span>
													</button>
												</a>
												<a href="{{route('editSetEvent', ['id'=>$event->id])}}" style="float: right;">
													<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Edit Response">
														<span class="glyphicon glyphicon-pencil"></span>
													</button>
												</a>
											@endif
											<span style="float: right; margin-right: 1em;"> 
												{{date('m/d',strtotime($event->date))." | ".to12($event->starttime)."  "}}
											</span>
										</a>
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
			<h1>Calendar</h1>
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
					<th>Su</th>
					<th>M</th>
					<th>T</th>
					<th>W</th>
					<th>Th</th>
					<th>F</th>
					<th>Sa</th>
				</thead>
				<tbody>
					<tr>
						@for($i = 0; $i < $startdayofweek; $i ++)
							<td id="{{$i}}"></td>
						@endfor
						@for($i = 1; $i <= $daysinmonth; $i ++)
							@if(array_search(($endofdate.sprintf('%02d', $i)), $dates) !== false)
								<?php
									$index = array_search(($endofdate.sprintf('%02d', $i)), $dates);
								?>
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
			<h1>Group Schedule</h1>
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
						$workSchedule = explode('|', $member->fallwork);
						$clubSchedule = explode('|', $member->fallclubs);
					}
					elseif(session('semester') == 'spring'){
						$classSchedule = explode('|', $member->springclasses);
						$workSchedule = explode('|', $member->springwork);
						$clubSchedule = explode('|', $member->springclubs);
					}
					
			        for($i = 0; $i < count($classSchedule); $i ++){
			        	if($classSchedule[$i] != ""){
							$split = explode('/', $classSchedule[$i]);
				        	$days = explode(',', $split[0]);
				        	$info = explode(',', $split[1]);
						}
						else{
							$days = array();
							$info = array("","","","","");
						}
			        	if(in_array(strtolower($day), $days)){
			        		$memberarray[$counter][$i][] = $info[0];//start time
				        	$memberarray[$counter][$i][] = $info[1];//end time
			        	}
			        }
			        for($i = 0; $i < count($workSchedule); $i ++){
			        	if($workSchedule[$i] != ""){
							$split = explode('/', $workSchedule[$i]);
				        	$days = explode(',', $split[0]);
				        	$info = explode(',', $split[1]);
						}
						else{
							$days = array();
							$info = array("","","","","");
						}
			        	if(in_array(strtolower($day), $days)){
			        		if($info[1] < $info[0]){
								$info[1] = numberToTime(timeToNumber($info[1]) + 24);
							}
			        		$memberarray[$counter][$i+count($classSchedule)][] = $info[0];//start time
				        	$memberarray[$counter][$i+count($classSchedule)][] = $info[1];//end time
			        	}
			        }
			        for($i = 0; $i < count($clubSchedule); $i ++){
			        	if($clubSchedule[$i] != ""){
							$split = explode('/', $clubSchedule[$i]);
				        	$days = explode(',', $split[0]);
				        	$info = explode(',', $split[1]);
						}
						else{
							$days = array();
							$info = array("","","","","");
						}
			        	if(in_array(strtolower($day), $days)){
			        		if($info[2] < $info[1]){
								$info[2] = numberToTime(timeToNumber($info[2]) + 24);
							}
			        		$memberarray[$counter][$i+count($classSchedule)+count($workSchedule)][] = $info[1];//start time
				        	$memberarray[$counter][$i+count($classSchedule)+count($workSchedule)][] = $info[2];//end time
			        	}
			        }
			        $counter++;
				}
			?>
			<div class="table-responsive">
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
			</div>
		@endif
		<script src="{{asset('js/calendar.js')}}"></script>
@endsection