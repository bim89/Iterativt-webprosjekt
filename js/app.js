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
	
	rooms.forEach(function(room) {
		console.log(room["id"]);
	});
		
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
				var user = "";
				
				var data = {"roomId": roomId, "fromHour": fromHour, "toHour": toHour, "day": day, "week": week, "user": user}
				
				$.ajax({
					type: "POST",
					url: "v2.php",
					data: data,
					success: function(data) {
						$("#booking").hide();
						console.log(data);
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

		});
