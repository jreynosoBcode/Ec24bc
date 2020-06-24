
$(document).ready(function(){    
 		$('#taxistas').click(function(){
 			if($("#panel-taxistas").is(":visible")) {
    			console.log("visible");
    				$( "#mapa" ).css({
						  'right':'0px',
						 });
    		}
    		if ($("#panel-taxistas").is(":hidden")) {
    			console.log("invisible");
    				$( "#mapa" ).css({
						  'right':'16.6666666667%',
						 });
    		}
    	$("#panel-taxistas").animate({width:'toggle'},1);
    		
    });
});