function addCls(counter){
	counter++;
	var newClass = "<div id='class"+counter+"' class='well'><label>*Days:</label><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='monday'>Monday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='tuesday'>Tuesday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='wednesday'>Wednesday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='thursday'>Thursday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='friday'>Friday</label></div><div class='form-group'><div class='row'><div class='col-sm-2'><label>*Start Time</label></div><div class='col-sm-2'><input type='time' class='form-control' name='starttime[]'></div><div class='col-sm-2'><label>*End Time</label></div><div class='col-sm-2'><input type='time' class='form-control' name='endtime[]'></div></div></div><div class='form-group'><label>Course Title</label><input type='text' class='form-control' name='title[]'></div><div class='form-group'><label>Building</label><input type='text' class='form-control' name='building[]'></div><div class='form-group'><label>Room</label><input type='text' class='form-control' name='rooms[]'></div><input type='hidden' name='color[]' value='{{$colors["+counter+"]}}''></div>"
	$(newClass).insertAfter($("#class"+(counter-1)));
	return counter;
}

function removeCls(counter){
	if(counter == 0){
		return counter;
	}
	$('#class'+counter).remove();
	counter--;
	return counter;
}

function addDay(counter){
	counter++;
	var newDay = "<div id='day"+counter+"'  class='well'>Date<input type='date' name='date[]' class='form-control'><br/>From<input type='time' name='start[]' class='form-control'><br/>To<input type='time' name='end[]' class='form-control'></div>";
	$(newDay).insertAfter($("#day"+(counter-1)));
	console.log(counter);
	return counter;
}

function removeDay(counter){
	if(counter == 0){
		return counter;
	}
	$('#day'+counter).remove();
	counter--;
	return counter;
}

function addShift(counter){
	counter++;
	var newClass = "<div id='shift"+counter+"' class='well'><label>*Days:</label><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='sunday'>Sunday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='monday'>Monday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='tuesday'>Tuesday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='wednesday'>Wednesday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='thursday'>Thursday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='friday'>Friday</label></div><div class='checkbox'><label><input type='checkbox' name='days["+counter+"][]' value='saturday'>Saturday</label></div><div class='form-group'><div class='row'><div class='col-sm-2'><label>*Start Time</label></div><div class='col-sm-2'><input type='time' class='form-control' name='starttime[]'></div><div class='col-sm-2'><label>*End Time</label></div><div class='col-sm-2'><input type='time' class='form-control' name='endtime[]'></div></div></div><input type='hidden' name='color[]' value='Grey'></div>";
	$(newClass).insertAfter($("#shift"+(counter-1)));
	return counter;
}

function removeShift(counter){
	if(counter == 0){
		return counter;
	}
	$('#shift'+counter).remove();
	counter--;
	return counter;
}