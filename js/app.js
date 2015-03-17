$("document").ready(function() {
	
	var jsonData = function () {
	    var json = null;
	    $.ajax({
	        'async': false,
	        'global': false,
	        'url': "data.json",
	        'dataType': "json",
	        'success': function (data) {
	            json = data;
	        }
	    });
	    return json;
	} 
	
	var json = jsonData();
	
	var rooms = json.room;
	var bookings = json.Booking;
	
	getBookings(bookings);
	
		
		if ($("#booking").is(":visible")) {
			$('html').click(function() {
				$("#booking").hide();
			});
		}

		var weeknumber = 11;
		$(".weeknumber").html(weeknumber);	
		
		$("#findRoom").change(function() {	
			var prosjektor = 0,
				whiteboard = 0,
				antPersoner = $("select[name$='personer']").val(),
				rom = $("select[name$='romnr']").val();
				
				if ($("input[name$='prosejktor']").prop('checked')) {
					prosjektor = $("input[name$='prosejktor']").val();
					
				}
				
				if ($("input[name$='whiteboard']").prop('checked')) {
					whiteboard = $("input[name$='whiteboard']").val();
					
				}
				
				$("select[name='romnr']").html("");
				$("select[name='romnr']").append("<option>Velg Rom</option>");
				
				
				console.log(prosjektor + " " + whiteboard);
				rooms.forEach(function(room) {
					if (antPersoner <= room["room_size"] && prosjektor == 0 && whiteboard == 0) {
						$("select[name='romnr']").append("<option value='" + room['room_number'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if (antPersoner <= room["room_size"] && prosjektor == room['projector'] && whiteboard == room["whiteboard"]) {
						
						$("select[name='romnr']").append("<option value='" + room['room_number'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if (antPersoner <= room["room_size"] && prosjektor == room['projector'] && whiteboard != room["whiteboard"] && prosjektor == 1 && whiteboard == 0) {
						
						$("select[name='romnr']").append("<option value='" + room['room_number'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if(antPersoner <= room["room_size"] && prosjektor != room['projector'] && whiteboard == room["whiteboard"] && whiteboard == 1 && prosjektor == 0) {
						
						$("select[name='romnr']").append("<option value='" + room['room_number'] + "'>Rom " + room['room_number'] + "</option>");
						
					} 
				});
		});
		
		$("select[name='']").change(function() {
			
		});
		
		$("#cal").on("click", "td", function(e) {
			//weeknumber = weeknumber + 1;
			//$(".weeknumber").html(weeknumber);	
			//var week = weeknumber;	
			//$("td").each(function() {
					
				//$(this).attr("data-week", week);
			//});
			var elem  = "";
			roomBook(this, e);
			
			elem = this;
			console.log(elem);
			
			$(".reserver").on("click", function(e) {
				
				var roomId = 1;
				var fromHour = $("select[name='from']").val();
				var toHour = $("select[name='to']").val();
				var day = $(elem).attr("data-day");
				var week = $(elem).attr("data-week");
				
				var data = {"roomId": roomId, "fromHour": fromHour, "toHour": toHour, "day": day, "week": week}
				
				$.ajax({
					type: "POST",
					url: "v2.php",
					data: data,
					success: function(data) {
						$("#booking").hide();
						var book = jsonData();
						console.log(book.Booking);
						$(elem).css("background-color", "#fff");
						getBookings(book.Booking);
						elem = "";
					}
				})
				
				console.log(roomId, fromHour, toHour,day, week);
				
			});
			
		});
			
		
		function roomBook(elem, e) {
			
			console.log(elem)
	

			changeBg();

			
			if($(elem).hasClass("booked") == false) {
			$(elem).css("background-color", "#e8e8e8");

			var hour = $(elem).data("clock");
			$("[name=from]").val(hour);
			$("[name=to]").val(hour + 2);
			
			console.log(hour);
			
			var relX = e.pageX;
			var relY = e.pageY;

			$('#booking').show().css({
				'top' : relY,
				'left' : relX + 10
			});
			
			$(".avbryt").click(function(elem) {
				$("#booking").hide();
				elem = ""
				changeBg();
			});

			$('#booking').click(function(event){
				    event.stopPropagation();
			});
			}

			
		}
		
		function changeBg()  {

			$("td").each(function() {
				if ($(this).hasClass("booked") == false) {
					$(this).css("background-color", "#fff");
				}
			});
		}
		
		function getBookings(bookings) {

			
			$("td").each(function() {
				var week = $(this).attr("data-week"),
					day = $(this).attr("data-day"),
					clock = $(this).attr("data-clock"),
					td = this;
					
					bookings.forEach(function(book) {

						if (book["week"] == week && book["weekday"] == day) {
							// console.log(book["start_time"] + " " + clock);
							
							if(book["start_time"] == clock) {
								console.log(book["weekday"]);
								if (!$(td).hasClass("booked")) {
									$(td).addClass("booked");
									$(".innhold", td).addClass("addBgTop").show();
									$(".innhold h4", td).html("Reservert av:");
									console.log($(".innhold h4", td));
									$(".innhold h5", td).html(book["user_id"] + " " + book["start_time"] + ":00-" + book["stop_time"] + ":00");
								}
								
								clock++;
								
								while(clock < book["stop_time"]) {
									if (clock == book["stop_time"] - 1) {
										var tcell = $("td[data-week='" + book["week"] + "'][data-day='" + book["weekday"] + "'][data-clock='" + clock + "']");
										$(tcell).addClass("booked");
									
										$(".innhold", tcell).addClass("addBgBottom").show();
									} else {
										
										var tcell = $("td[data-week='" + book["week"] + "'][data-day='" + book["weekday"] + "'][data-clock='" + clock + "']");
										$(tcell).addClass("booked");
									
										$(".innhold", tcell).addClass("addBgBetween").show();
									}
									clock++;
								}	
								
							}
							
						}
					});
					
			});
		}
		

		});
