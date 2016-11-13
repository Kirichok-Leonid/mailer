$(function(){
	/*setInterval(function(){	
	
		$(function(){

			$("#animat__mail").fadeIn(1000)
			.animate({
				"top": "-=78px"
			}, 1000)
			.animate({
				"left": "-=295px"
			}, 1000)
			.fadeOut(1500)
			.css({
			"top" : "132px",
			"left" : "425px"
			});
		});
		
		$(function(){
			$("#animat__mail_two").fadeIn(1000)
			.animate({
				"top": "-=78px"
			}, 1000).animate({
				"right": "-=295px"
			}, 1000)
			.fadeOut(1500)
			.css({
				"top" : "132px",
				"right" : "425px"
			});
		});
		
		$(function(){
			$("#animat__mail_three").fadeIn(1000)
			.animate({
				"bottom": "-=58px"
			}, 1000).animate({
				"left": "-=295px"
			}, 1000)
			.fadeOut(1500)
			.css({
			"bottom" : "130px",
			"left" : "425px"
			});
		});
		
		$(function(){
			$("#animat__mail_four").fadeIn(1000)
			.animate({
				"bottom": "-=58px"
			}, 1000).animate({
				"right": "-=295px"
			}, 1000)
			.fadeOut(1500)
			.css({
			"bottom" : "130px",
			"right" : "425px"
			});
		});
	}, 5000)*/


	
	(function myloop(element){
		element.fadeIn(1000)
		.animate({"top": "-=78px"}, 1000)
		.animate({"left": "-=295px"}, 1000, function(){
			element.fadeOut(1500);
			setTimeout(function(){
				element.css({
					"top" : "132px",
					"left" : "425px"
				})
				myloop(element);
			},4000)
		})
	})($("#animat__mail"));

	(function myloop(element){
		element.fadeIn(1000)
		.animate({"top": "-=78px"}, 1000)
		.animate({"right": "-=295px"}, 1000, function(){
			element.fadeOut(1500);
			setTimeout(function(){
				element.css({
					"top" : "132px",
					"right" : "425px"
				})
				myloop(element);
			},4000)
		})
	})($("#animat__mail_two"));

	(function myloop(element){
		element.fadeIn(1000)
		.animate({"bottom": "-=47px"}, 1000)
		.animate({"left": "-=295px"}, 1000, function(){
			element.fadeOut(1500);
			setTimeout(function(){
				element.css({
					"bottom" : "120px",
					"left" : "425px"
				})
				myloop(element);
			},4000)
		})
	})($("#animat__mail_three"));

	(function myloop(element){
		element.fadeIn(1000)
		.animate({"bottom": "-=47px"}, 1000)
		.animate({"right": "-=295px"}, 1000, function(){
			element.fadeOut(1500);
			setTimeout(function(){
				element.css({
					"bottom" : "120px",
					"right" : "425px"
				})
				myloop(element);
			},4000)
		})
	})($("#animat__mail_four"));
});