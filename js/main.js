

(function ($, window){
	
	$('#main-container').waitForImages(
    function()
    {
    	//Load complete
    	$("body").css({opacity: 1});
    	$("#loading").hide();    
    
	    $('#us').cycle({
	    
	    	delay: 1000,
	    	speed: 2000,
			fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			
		});

    	
    },
    function(loaded, count, success)
    {
    	//Console log
    	console.log(loaded + ' of ' + count + ' images has ' + (success ? 'loaded' : 'failed to load') +  '.');
    	
    	//Loading bar
    	$('#loading').stop().animate({
            width: ((loaded / count) * 100) + '%',
            minWidth: ((loaded / count) * 100) + '%'
        }, 200);
    });
	
	
	//$("#header").slabText();
	
	skrollr.init({
	    
	});
	
	if(!Modernizr.touch){
		$("html").niceScroll();	
	}


	
	/*** MAPS ***/

	var styles = 
		[
		{
		"featureType": "water",
		"stylers": [
		  { "color": "#dfe0ff" }
		]
		},{
		"featureType": "road.arterial",
		"elementType": "geometry.fill",
		"stylers": [
		  { "color": "#CDCDCD" }
		]
		},{
		"featureType": "road.highway",
		"elementType": "geometry.fill",
		"stylers": [
		  { "color": "#CDCDCD" }
		]
		},{
		"featureType": "road.highway",
		"elementType": "geometry.stroke",
		"stylers": [
		  { "color": "#CDCDCD" }
		]
		},{
		"featureType": "road.arterial",
		"elementType": "geometry.stroke",
		"stylers": [
		  { "color": "#CDCDCD" }
		]
		},{
		"featureType": "road.highway",
		"elementType": "labels.text.stroke",
		"stylers": [
		  { "color": "#ffffff" }
		]
		},{
		"featureType": "road.arterial",
		"elementType": "labels.text.stroke",
		"stylers": [
		  { "color": "#ffffff" }
		]
		},{
		}
		]	

	var map,
		route,
		styledMap = {styles: styles,name: "Styled Map", mapTypeId: "map_style"};
				
	var start = {lat: 14.437, lng: 121.046}
    var ibaan = {lat: 13.840, lng: 121.121};    
    var acquatico = {lat: 13.67747,  lng: 121.38902};
	
	
	map = new GMaps({
		div: '#map',
		lat: acquatico.lat,
		lng: acquatico.lng,
		zoom: 10,
		scrollwheel: false,			    
	});
	
	var pinColor = "8503ac";
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0,0),
        new google.maps.Point(10, 34));
    var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
        new google.maps.Size(40, 37),
        new google.maps.Point(0, 0),
        new google.maps.Point(12, 35));
        

	var startMarker = new google.maps.Marker({
		    //position: new google.maps.LatLng(14.437,121.046), 
		    position: new google.maps.LatLng(14.4026, 121.0394), 		    
		    //map: map,
		    icon: pinImage,
		    shadow: pinShadow
		});      
	var ibaanMarker = new google.maps.Marker({
		    position: new google.maps.LatLng(13.8419, 121.1212), 
		    //map: map,
		    icon: pinImage,
		    shadow: pinShadow
		});	
		
	var waypoints = new Array();
	//waypoint[0] = new google.maps.LatLng(13.8419, 121.1212);
	
	waypoints.push({
      location: 'Ibaan',
      stopover: false
    });
	
    var acquaticoMarker = new google.maps.Marker({
		    position: new google.maps.LatLng(13.67747, 121.38902), 
		    //map: map,
		    icon: pinImage,
		    shadow: pinShadow
		}); 		
		
	
	map.addMarker(startMarker);
	//map.addMarker(ibaanMarker);	
	map.addMarker(acquaticoMarker);

    /*    
	map.addMarker({
		lat: acquatico.lat,
		lng: acquatico.lng,
		title: "WEDDING HERE!",
		click: function(e) {			
		}
	});
	
	map.addMarker({
		lat: start.lat,
		lng: start.lng,
		title: "SLEX",
		click: function(e) {			
		}
	});
	*/	  
	
	origin = map.markers[0].getPosition();
    destination = map.markers[map.markers.length-1].getPosition();

    console.log(origin.lat());

    map.getRoutes({
      origin: [origin.lat(), origin.lng()],
      destination: [destination.lat(), destination.lng()],
      travelMode: 'driving',
      
      //waypoints=Charlestown,MA|via:Lexington
      waypoints: waypoints,
      callback: function(e){
        route = new GMaps.Route({
          map: map,
          route: e[0],
          strokeColor: '#8503ac',
          strokeOpacity: 0.5,
          strokeWeight: 10
        });
        
        $('#next').removeAttr('disabled');
        $('#prev').removeAttr('disabled');
      }
    });

    $('#next').click(function(e){
      e.preventDefault();
      route.forward();

      if(route.step_count < route.steps_length){
      	var lat = route.steps[route.step_count].path[0].lat(),
      		lng = route.steps[route.step_count].path[0].lng();
      	map.setCenter(lat, lng);
          //console.log("STEP: "+route.steps[route.step_count].path[0].lat());
          $('#steps').append('<li>'+route.steps[route.step_count].instructions+'</li>');
      }

        
    });
    $('#prev').click(function(e){
      e.preventDefault();
      route.back();

      if(route.step_count >= 0)
        $('#steps').find('li').last().remove();
    });

	
	
	map.addStyle(styledMap);
	map.setStyle("map_style");  
	
	
	$("#header-menu li").bind("click",function(){
		var to = $(this).attr("data-to");
		$("#"+to).ScrollTo({offsetTop: 70});
	});
	
	$("#gototop-button").bind("click",function(){
		$("#invitation-header").ScrollTo({offsetTop: 10});
	});
	
	var deg = 180;
	
	$("#ambigram").click(function(){
		
		$(this).stop().animate(
			{rotation: deg},
			{
			duration: 1000,
			step: function(now, fx) {
			  $(this).css({"transform": "rotate("+now+"deg)"});
			  if (deg == 180) deg = 0; else deg = 180;
			}
		});
	});
	
	
	$("#alt-dir").click(function(){
		
		$("#directions").removeClass("hidden");
		
	});
		
	
	var pwin;
	function printImg(printOption) {
	    var imageToPrint = "http://www.acuaticoresort.com.ph/images/map.jpg";
	    var html = imageToPrint;
	    if (printOption == 'option2') {
	        html = '<html><head><style type="text/css">img { float: left; margin: 0; padding: 0;}</style></head><body>';
	        html += '<img src="' + imageToPrint + '" alt="">';
	       
	        html += '</body></html>';
	        pwin = window.open('', "_blank");
	        pwin.document.write(html);
	        pwin.document.close();
	    } else {
	        pwin = window.open(html, "_blank");
	    }
	    setTimeout("pwin.print()" ,20);
	}
	
	$("#print-dir").click(function(){
		printImg('option2');
	});
	
	
	$(".rsvp-button").click(function(){
		
		
		if ( $(this).hasClass("going") ) {
			$(this).removeClass("going").addClass("not-going");
		} else if ( $(this).hasClass("not-going") ) {
			$(this).removeClass("not-going").addClass("going");			
		} else {
			$(this).addClass("going");			
		}
		
		
		var name = $(this).attr("data-name");
		
		if ( $(this).hasClass("going") ) {
			
			var url = "rsvp.php?name="+name+"&rsvp=going";
			
			console.log("URL: "+url);

			//ajax update to going
			$.ajax({url:url,
			success:function(result){
				console.log("RESULT:"+result);
			},
			error:function(xhr,status,error){
				$(this).removeClass("not-going").removeClass("going");
			}});
			

		} else if ( $(this).hasClass("not-going") ) {

			//ajax update to notgoing
			var url = "rsvp.php?name="+name+"&rsvp=notgoing";
			
			console.log("URL: "+url);

			//ajax update to going
			$.ajax({url:url,
			success:function(result){
				console.log("RESULT:"+result);
			},
			error:function(xhr,status,error){
				$(this).removeClass("not-going").removeClass("going");
			}});

		} else {
			//Assumed Di pa na click
			return;
		}
		
		
	});
	
	$("#yes-button").click(function(){
		var id = $(this).attr("data-id");
		var url = "book.php?id="+id+"&book=YES";
			
			console.log("URL: "+url);
		$.ajax({url:url,
		success:function(result){
			$("#book-confirm").removeClass("hidden");
		},
		error:function(xhr,status,error){
			
		}});
		
	});
	
	
})(jQuery, window);

















