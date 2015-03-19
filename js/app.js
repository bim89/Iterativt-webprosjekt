$("document").ready(function() {
		
	var json = jsonData();

	var rooms = json.room,
		bookings = json.Booking;


		if ($("#booking").is(":visible")) {
			$('html').click(function() {
				$("#booking").hide();
			});
		}

		console.log(weeknumber);
		$(".weeknumber").html(weeknumber);	
		$("td").each(function() {	
			$(this).attr("data-week", weeknumber);
		});
		
		
		$("#nextweek").click(function(e) {
			
			e.preventDefault();
			
			weeknumber = weeknumber + 1;
			$(".weeknumber").html(weeknumber);	
			$("td").each(function() {	
				$(this).attr("data-week", weeknumber);
				$(this).removeClass("booked");
				$(".innhold h4", this).html("");
				$(".innhold h5", this).html("");
				$("div", this).removeClass("addBgTop addBgBetween addBgBottom useraddBgTop useraddBgBetween useraddBgBottom");
			});
			
			var json = jsonData(),
				rooms = json.room,
				bookings = json.Booking;
			
				getBookings(bookings);
		});
		
		$("#lastweek").click(function(e) {
			
			e.preventDefault();
			
			weeknumber = weeknumber - 1;
			$(".weeknumber").html(weeknumber);	
			
			$("td").each(function() {	
				$(this).attr("data-week", weeknumber);
				$(this).removeClass("booked");
				$(".innhold h4", this).html("");
				$(".innhold h5", this).html("");
				$("div", this).removeClass("addBgTop addBgBetween addBgBottom useraddBgTop useraddBgBetween useraddBgBottom");
			});
			
			var json = jsonData(),
				rooms = json.room,
				bookings = json.Booking;
			
				getBookings(bookings);
		});
		
		
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
				
				rooms.forEach(function(room) {
					if (antPersoner <= room["room_size"] && prosjektor == 0 && whiteboard == 0) {
						$("select[name='romnr']").append("<option value='" + room['id'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if (antPersoner <= room["room_size"] && prosjektor == room['projector'] && whiteboard == room["whiteboard"]) {
						
						$("select[name='romnr']").append("<option value='" + room['id'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if (antPersoner <= room["room_size"] && prosjektor == room['projector'] && whiteboard != room["whiteboard"] && prosjektor == 1 && whiteboard == 0) {
						
						$("select[name='romnr']").append("<option value='" + room['id'] + "'>Rom " + room['room_number'] + "</option>");
						
					} else if(antPersoner <= room["room_size"] && prosjektor != room['id'] && whiteboard == room["whiteboard"] && whiteboard == 1 && prosjektor == 0) {
						
						$("select[name='romnr']").append("<option value='" + room['id'] + "'>Rom " + room['room_number'] + "</option>");
						
					} 
				});
		});
		
		$("td div").click(function(e) {
				
				var bookId = $(this).attr("data-bookid");
				console.log(bookId);

			if ($(this).hasClass("useraddBgTop")) {
				var relX = e.pageX;
				var relY = e.pageY;
				
				var data = {bookId: bookId, cancel: "cancel"};
				
				
				
				$('#userBooking').show().css({
					'top' : relY - 100,
					'left' : relX + 10
				});
				
				$(".cancel").click(function() {
					$.ajax({
						type: "POST",
						url: "index.php",
						data: data,
						success: function(data) {
							$("#userBooking").hide();
							
							$("td").each(function(td) {
								console.log(this);
								$(this).removeClass("booked");
								$(td).removeClass("booked");
								$(".innhold h4", td).html("");
								$(".innhold h5", td).html("");
								$("div", td).removeClass("addBgTop addBgBetween addBgBottom useraddBgTop useraddBgBetween useraddBgBottom");
							});
			
							var json = jsonData(),
								rooms = json.room,
								bookings = json.Booking;
			
								getBookings(bookings);
						}
					});
				});
				
			} else {
				console.log(this);
			}
		});
		
		$("select[name='romnr']").change(function() {
			var romid = $(this).val();
			
			$("select option[value='" + romid + "']").attr("selected","selected");
			
			$("td").each(function() {
				$(this).attr("data-room", romid);
				$(this).removeClass("booked");
				$(".innhold h4", this).html("");
				$(".innhold h5", this).html("");
				$("div", this).removeClass("addBgTop addBgBetween addBgBottom useraddBgTop useraddBgBetween useraddBgBottom");
			});
			
			var json = jsonData(),
				rooms = json.room,
				bookings = json.Booking;
			
				getBookings(bookings);
		});
		
	
		
		$("td").on("click", function(e) {
			
			
			
			elem = this;
			
			changeBg();

			
			if($(elem).hasClass("booked") == false) {
			$(elem).css("background-color", "#e8e8e8");

			var hour = $(elem).data("clock");
			$("[name=from]").val(hour);
			$("[name=to]").val(hour + 2);
			
			var relX = e.pageX;
			var relY = e.pageY;
			
			if ($(elem).attr("data-room")) {
				$('#booking').show().css({
					'top' : relY,
					'left' : relX + 10
				});
			} else {
				alert("Ingen rom valgt, velg ett rom!");
				changeBg();
			}
			
			$(".avbryt").click(function(elem) {
				$("#booking").hide();
				changeBg();
			});

			$('#booking').click(function(event){
				    event.stopPropagation();
			});
			}
			
			
			$(".reserver").on("click", function(e) {
				
				var roomId = $(elem).attr("data-room");
				var fromHour = $("select[name='from']").val();
				var toHour = $("select[name='to']").val();
				var day = $(elem).attr("data-day");
				var week = $(elem).attr("data-week");
				
				var data = {"roomId": roomId, "fromHour": fromHour, "toHour": toHour, "day": day, "week": week}
				
				$.ajax({
					type: "POST",
					url: "index.php",
					data: data,
					success: function(data) {
						console.log(data);
						$("#booking").hide();
						var book = jsonData();
						$(elem).css("background-color", "#fff");

						getBookings(book.Booking);
					}
				});
				
				
				
			});
			
		});
			
		
		function roomBook(elem, e) {

			
		}
		
		function jsonData() {
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
					roomid = $(this).attr("data-room"),
					td = this;
				
					bookings.forEach(function(book) {

						if (book["week"] == week && book["weekday"] == day && book["room_id"] == roomid) {
							// console.log(book["start_time"] + " " + clock);
							
							if(book["start_time"] == clock) {
								if (!$(td).hasClass("booked")) {
									$(td).addClass("booked");
									if (book["username"] == username) {
										$(".innhold", td).addClass("useraddBgTop").show();
										$(".innhold", td).attr("data-bookid", book["book_id"]);
										$(".useraddBgTop h4", td).html("Din Reservering:");
										$(".useraddBgTop h5", td).html(book["username"] + " " + book["start_time"] + ":00-" + book["stop_time"] + ":00");
										
									} else {
									$(".innhold", td).addClass("addBgTop").show();
									$(".innhold", td).attr("data-bookid", book["book_id"]);
									$(".addBgTop h4", td).html("Reservert av:");
									$(".addBgTop h5", td).html(book["username"] + " " + book["start_time"] + ":00-" + book["stop_time"] + ":00");
									}
								}
								
								clock++;
								
								while(clock < book["stop_time"]) {
									if (clock == book["stop_time"] - 1) {
										var tcell = $("td[data-week='" + book["week"] + "'][data-day='" + book["weekday"] + "'][data-clock='" + clock + "']");
										$(tcell).addClass("booked");
									
										if (book["username"] == username) {
											$(".innhold", tcell).addClass("useraddBgBottom").show();
											$(".innhold", tcell).attr("data-bookid", book["book_id"]);
										} else {
											$(".innhold", tcell).addClass("addBgBottom").show();
											$(".innhold", tcell).attr("data-bookid", book["book_id"]);
										}
									} else {
										
										var tcell = $("td[data-week='" + book["week"] + "'][data-day='" + book["weekday"] + "'][data-clock='" + clock + "']");
										$(tcell).addClass("booked");
										
										if (book["username"] == username) {
											$(".innhold", tcell).addClass("useraddBgBetween").show();
											$(".innhold", tcell).attr("data-bookid", book["book_id"]);
										} else {
										$(".innhold", tcell).addClass("addBgBetween").show();
										$(".innhold", tcell).attr("data-bookid", book["book_id"]);
										}
									}
									clock++;
								}	
								
							}
							
						}
					});
					
			});
		}
	

});
		
