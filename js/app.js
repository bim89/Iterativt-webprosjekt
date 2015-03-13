$("document").ready(function() {
	
	var json = (function () {
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
	})(); 
	
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
		
		$("#cal").on("click", "td", function(e) {
			//weeknumber = weeknumber + 1;
			//$(".weeknumber").html(weeknumber);	
			//var week = weeknumber;	
			//$("td").each(function() {
					
				//$(this).attr("data-week", week);
			//});
			roomBook(this, e);
			
			var elem = this;
			console.log(elem);
			$(".reserver").on("click", function(e) {
				console.log(elem);
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
						console.log(data);
						getBookings(bookings);
					}
				})
				
				console.log(roomId, fromHour, toHour,day, week, user);
				
			});
			
		});
			
		
		function roomBook(elem, e) {
			
			console.log(elem)
			
			$(".innhold h4", elem).html("");
			$(".innhold h5", elem).html("");	

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
			
			$(".reserver").click(function(elem) {
					
			});
				
			$(".avbryt").click(function(elem) {
				$("#booking").hide();
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
					fromHour = $(this).attr("data-clock");
					td = this;
					
					bookings.forEach(function(book) {
						console.log(book);
						if(book["week"] == week && book["weekday"] == day) {
							if(book["start_time"] == fromHour) {
								console.log(td);
								$(td).css({
									"background-color": "#c48c7f",
									"border-bottom": "#c48c7f",
								});
								$(td).addClass("booked");
								$(".innhold", td).show
								$(".innhold h4", td).html("Reservert av:");
								$(".innhold h5", td).html(book["user_id"] + " " + book["start_time"] + "-" + book["stop_time"]);	
								
							}
							
							else if (book["start_time"] > fromHour && fromHour < book["stop_time"]) {
								$(td).css({
									"background-color": "#c48c7f",
									"border-bottom": "#c48c7f",
								});
								$(td).addClass("booked");
							}
						}
					});
					
			});
		}
		

		});
