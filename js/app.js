$("document").ready(function() {

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
		});
			
		
		function roomBook(elem, e) {
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
