$(document).ready(function(){
	$('[data-toggle="popover"]').popover();

	var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"];

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
    		$("#"+((i+startDay)-1)).css('background-color', '');
    		if(i < 10){
    			$("#"+((i+startDay)-1)).text("0"+i);
    			var index = 0;
    			if((index = dates.indexOf(year+'-'+(month+1)+"-0"+i)) >= 0){
	    			$("#"+((i+startDay)-1)).css('background-color', 'cyan');
	    			$("#"+((i+startDay)-1)).html('<a href="#" data-toggle="popover" title="'+names[index]+'" data-content=" '+descriptions[index]+'">0'+i+'</a>');
	    		}
    		}
    		else{
    			$("#"+((i+startDay)-1)).text(i);
    			var index = 0;
    			if((index = dates.indexOf(year+'-'+(month+1)+"-"+i)) >= 0){
	    			$("#"+((i+startDay)-1)).css('background-color', 'cyan');
	    			$("#"+((i+startDay)-1)).html('<a href="#" data-toggle="popover" title="'+names[index]+'" data-content="'+descriptions[index]+'">'+i+'</a>');
	    		}
    		}
    	}
    	$('#title').text(monthNames[month]+" "+year);
    	for(var i = 0; i < startDay; i ++){
    		$("#"+i).text("");
    		$("#"+((i+startDay)-1)).css('background-color', '');
    	}
    	for(var i = (startDay+daysInMonth); i <= 42; i++){
    		$("#"+i).text("");
    		$("#"+((i+startDay)-1)).css('background-color', '');
    	}
    	$('[data-toggle="popover"]').popover();
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
    		$("#"+((i+startDay)-1)).css('background-color', '');
    		if(i < 10){
    			$("#"+((i+startDay)-1)).text("0"+i);
    			var index = 0;
    			if((index = dates.indexOf(year+'-'+(month+1)+"-0"+i)) >= 0){
	    			$("#"+((i+startDay)-1)).css('background-color', 'cyan');
	    			$("#"+((i+startDay)-1)).html('<a href="#" data-toggle="popover" title="'+names[index]+'" data-content="'+descriptions[index]+'">0'+i+'</a>');
	    		}
    		}
    		else{
    			$("#"+((i+startDay)-1)).text(i);
                var index = 0;
                if((index = dates.indexOf(year+'-'+(month+1)+"-"+i)) >= 0){
                    $("#"+((i+startDay)-1)).css('background-color', 'cyan');
                    $("#"+((i+startDay)-1)).html('<a href="#" data-toggle="popover" title="'+names[index]+'" data-content="'+descriptions[index]+'">'+i+'</a>');
                }
    		}
    	}
    	$('#title').text(monthNames[month]+" "+year);
    	for(var i = 0; i < startDay; i ++){
    		$("#"+i).text("");
    		$("#"+((i+startDay)-1)).css('background-color', '');
    	}
    	for(var i = (startDay+daysInMonth); i <= 42; i++){
    		$("#"+i).text("");
    		$("#"+((i+startDay)-1)).css('background-color', '');
    	}
    	$('[data-toggle="popover"]').popover();
	});
});