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

var selected = [];
var shifts = [];

function insert(item, index){
	var times = '<div class="row" id="day'+item+'"><div class="col-sm-2">From</div><div class="col-sm-10"><input type="time" name="start[]" class="form-control"></div><div class="col-sm-2">To</div><div class="col-sm-10"><input type="time" name="end[]" class="form-control"><br/></div></div';
	$(times).insertAfter($('#'+item));
}

function remove(item, index){
	$('#day'+item).remove();
}

function changeTimes(counter){
	if($('#times').val() == 0){
		selected.forEach(remove);
		var string = '<div class="row" id="same"><div class="col-sm-2">From</div><div class="col-sm-10"><input type="time" name="start[]" class="form-control"></div><div class="col-sm-2">To</div><div class="col-sm-10"><input type="time" name="end[]" class="form-control"><br/></div></div>';
		$(string).insertAfter($("hr"));
	}
	else{
		selected.forEach(insert);
		$('#same').remove();
	}
}

var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function addCheck(cell, month, year){
	month = month + 1;
	if(!$(cell).hasClass('check')){
		selected.push(year+"-"+month+"-"+( $(cell).text()));
        shifts.push(1);
        if(v == 0){
            $('#dates').append("<p id='"+year+"-"+month+"-"+( $(cell).text())+"'>"+$(cell).text()+"/"+month+"/"+year+"</p>");
        }
        else{
            $('#dates').append("<p id='"+year+"-"+month+"-"+( $(cell).text())+"'>"+$(cell).text()+"/"+month+"/"+year+"<span style='float: right;' class='btn btn-default' data-id='day"+year+'-'+month+'-'+( $(cell).text())+"' onclick='removeTimes(this)'>-</span><span style='float: right;' class='btn btn-default' data-id='day"+year+'-'+month+'-'+( $(cell).text())+"' onclick='addTimes(this)'>+</span></p>");
            
        }
		if($('#times').val() != 0){
			$('#dates').append('<div class="row" id="day'+year+"-"+month+"-"+( $(cell).text())+'"><div class="col-sm-2">From</div><div class="col-sm-10"><input type="time" name="start[]" class="form-control"></div><div class="col-sm-2">To</div><div class="col-sm-10"><input type="time" name="end[]" class="form-control"><br/></div></div>');
		}
	}
	else{
		var index = selected.indexOf($(cell).text()+month+year);
		selected.splice(index);
        shifts.splice(index);
		$('#'+year+"-"+month+"-"+( $(cell).text())).remove();
		$('#day'+year+"-"+month+"-"+( $(cell).text())).remove();

	}
	$(cell).toggleClass("check");
}

function addTimes(button){
    var times = '<div class="row" id="'+$(button).attr('data-id')+'"><div class="col-sm-2">From</div><div class="col-sm-10"><input type="time" name="start[]" class="form-control"></div><div class="col-sm-2">To</div><div class="col-sm-10"><input type="time" name="end[]" class="form-control"><br/></div></div>';
    $(times).insertAfter($('#'+ $(button).attr('data-id')));
    var index = selected.indexOf($(button).attr('data-id').substring(3));
    shifts[index]++;
}

function removeTimes(button){
    $('#'+ $(button).attr('data-id')).remove();
    var index = selected.indexOf($(button).attr('data-id').substring(3));
    shifts[index]--;
}

function insertDates(){
	$('#d').val(selected.join(','));
    $('#s').val(shifts.join(','));
	$('#form').submit();
}

function selectDate(day, date, time){
    $('.selected').each(function() {
        $(this).removeClass('selected')
    });
    $(day).addClass('selected');
    $('#date').val(date);
    $('#time').val(time);
}

$( document ).ready(function() {

    $('#prevMonth').click(function() {
    	if(month > 0){
    		month--;
    	}
    	else{
    		month = 11;
    		year--;
    	}
    	var d = new Date(year, month, 0);
    	var daysInMonth = d.getDate();
    	var d = new Date(year, month, 1);
    	var startDay = d.getDay();
    	for(var i = 1; i <= daysInMonth; i ++){
    		$("#"+((i+startDay)-1)).removeClass('check');
    		if(i < 10){
    			$("#"+((i+startDay)-1)).text("0"+i);
    			if(selected.indexOf(year+'-'+(month+1)+"-0"+i) >= 0){
	    			$("#"+((i+startDay)-1)).addClass("check");
	    		}
    		}
    		else{
    			$("#"+((i+startDay)-1)).text(i);
    			if(selected.indexOf(year+'-'+(month+1)+"-"+i) >= 0){
	    			$("#"+((i+startDay)-1)).addClass("check");
	    		}
    		}
    		if(!$("#"+((i+startDay)-1)).hasClass('btn-default')){
    			$("#"+((i+startDay)-1)).addClass('btn-default');
    		}
    	}
    	$('#title').text(monthNames[month]+" "+year);
    	for(var i = 0; i < startDay; i ++){
    		$("#"+i).text("");
    		$("#"+i).removeClass('btn-default');
    		$("#"+i).removeClass('check');
    	}
    	for(var i = (startDay+daysInMonth); i <= 42; i++){
    		$("#"+i).text("");
    		$("#"+i).removeClass('btn-default');
    		$("#"+i).removeClass('check');
    	}
    });

    $('#nextMonth').click(function() {
    	if(month < 11){
    		month++;
    	}
    	else{
    		month = 0;
    		year++;
    	}
    	var d = new Date(year, month, 0);
    	var daysInMonth = d.getDate();
    	var d = new Date(year, month, 1);
    	var startDay = d.getDay();
    	for(var i = 1; i <= daysInMonth; i ++){
    		$("#"+((i+startDay)-1)).removeClass('check');
    		if(i < 10){
    			$("#"+((i+startDay)-1)).text("0"+i);
    			if(selected.indexOf(year+'-'+(month+1)+"-0"+i) >= 0){
	    			$("#"+((i+startDay)-1)).addClass("check");
	    		}
    		}
    		else{
    			$("#"+((i+startDay)-1)).text(i);
    			if(selected.indexOf(year+'-'+(month+1)+"-"+i) >= 0){
	    			$("#"+((i+startDay)-1)).addClass("check");
	    		}
    		}

    		if(!$("#"+((i+startDay)-1)).hasClass('btn-default')){
    			$("#"+((i+startDay)-1)).addClass('btn-default');
    		}
    	}
    	$('#title').text(monthNames[month]+" "+year);
    	for(var i = 0; i < startDay; i ++){
    		$("#"+i).text("");
    		$("#"+i).removeClass('btn-default');
    		$("#"+i).removeClass('check');
    	}
    	for(var i = (startDay+daysInMonth); i <= 42; i++){
    		$("#"+i).text("");
    		$("#"+i).removeClass('btn-default');
    		$("#"+i).removeClass('check');
    	}
    });
});
