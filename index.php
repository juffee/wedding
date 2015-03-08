<?php 

include('edb.class.php');
$db = new edb('localhost','root','strip','wedding');

/*



rsvp
id | greeting | accomodation | accomodation_fee

rsvp_items
id | name | rsvp



*/


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
		
        <link href='http://fonts.googleapis.com/css?family=Alfa+Slab+One|Arbutus+Slab|Combo|Source+Code+Pro|Griffy|Rye' rel='stylesheet' type='text/css'>
		
		<link rel="stylesheet/less" href="css/less/main.less">
		<!--<link rel="stylesheet" href="css/less/main.css">-->
		
		<script src="js/lib/less-1.3.0.min.js"></script>	
        <script src="js/lib/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        
        <div id="loading">
        	
        </div>

        <div id="header-container" data-0="background-color: rgba(255,255,255,0); color: rgba(0,0,0,0.1)" data-300="background-color: rgba(255,255,255,0.9); color: rgba(0,0,0,0.9)" >
        	<nav>
	        	<ul id="header-menu">
		        	<li data-to="RSVP">
		        		RSVP
		        	</li>
		        	<li data-to="the-place">
			        	Map
		        	</li>		        
		        	<li data-to="attire">
			        	Attire
		        	</li>
		        	<!--

		        	<li data-to="registry">
			        	Registry
		        	</li>
		        	
		        	-->
		        	<li data-to="std">
			        	SaveTheDate
		        	</li>
	        	</ul>
        	</nav>
        </div>
        
        <div id="gototop-button" data-0="display: none" data-800="opacity: 0; display: block" data-1000="opacity:1; display: block" >
        	^<br>
        	back to top
        </div>

        <div id="main-container">
            
            <div id="invitation-container">
            	<h1 id="invitation-header"> 
	            	~Juf&Kai~
            	</h1>
            	<h3 id="invitation-header-wedding">wedding</h3>
            	<hr class="wed-hr">
            	<!--
            	
            	Pebrero 16, 2013. Sabado.
            	Sana po makapunta kayo sa aming pagiisang dibdib!
            	Makisalo sa aming 
            	
            	-->
            	<h2 id="invitation-text">
	            	<span id="greetings">Hi 
	            	
	            		<?php  
		            		
		            		$id = $_GET["i"];
		            				            		
		            		$greeting = $db->one("select greeting from `rsvp` where id = '".$id."' limit 1");

	            		?>
	            	
	            		<?php echo $greeting; ?>!
	            		
	            	</span>	
	     
	            	<span id="invitation">Inaanyayahan po namin kayong, <br> samahan kaming ipagdiwang<br> ang ika-10 anibersaryo ng aming pagsasama, <br>at ang unang araw <br>ng bagong yugto sa aming buhay! </span>
	            
            	</h2>
            	
            	<hr class="wed-hr">
            	
            	<h2 id="invitation-date" title="Dapat Feb 18 kaso monday e. :p">February 16, 2013<br>Sabado</h2>
            	
            	<hr class="wed-hr semi">
            	
            	<h2 id="invitation-place" title="Maganda dito!">Acquatico Beach Resort, <br>San Juan Batangas</h2>
            	
            	<hr class="wed-hr semi">
            	
            	<h2 id="invitation-place" title="!">4pm Ceremony<br>Cocktails after ceremony<br>Reception to follow at 7pm</h2>
            	
            	<hr class="wed-hr semi">
            	
            	<h2 id="invitation-attire" title="!">Beach Attire! :p<br>White/Purple Motif</h2>
            	
            	<hr class="wed-hr semi">
            	<!--
            	<div id="RSVP-button" class="button" title="répondez s'il vous plaît">RSVP</div>
            	
            	<h2 id="invitation-rsvp" title="Maganda dito!">Please click here to RSVP :)</h2>     
            	-->
            	
            	<h1 id="RSVP">RSVP</h1>     
            	
            	
            	<h4> <?php echo $greeting; ?> </h4>
            	<h4> We have reserved 
            		<?php 

            		$count = $db->one("SELECT COUNT(".$id.") FROM rsvp_items");
            		echo $count;            		            		
            		
            		?> 
            		seats for you :) </h4>            	

            	<hr class="wed-hr semi">

            	<h2 id="invitation-rsvp">Please click here to RSVP :)</h2>     
            	<ul id="rsvp-list">
            	
            	<?php 
	            	
	            	$result = $db->q("select * from `rsvp_items` ");
					
					foreach($result as $r){
					        
					        $r = (object) $r;					        
	            	
					        $rsvp = $r->rsvp;
					        if (is_null($rsvp)){
						        //print no class
						        $rsvpClass = "";
					        } else if ( $rsvp == "going" ) {
						        //print class going
						        $rsvpClass = "going";
					        } else if ( $rsvp == "notgoing" ) {
						        //print class not going
						        $rsvpClass = "not-going";
					        }
					        
					        $name = $r->name;
            	?>
            	
	            	<li>
		            	<span class="rsvp-name">
		            		
		            		<?php echo $name; ?>

		            	</span>
		            	<div class="rsvp-button-container">
			            	<div class="rsvp-button <?php echo $rsvpClass; ?>" data-name="<?php echo $name; ?>"></div>	
		            	</div>
		            			            	
	            	</li>
	            	
	            <?php 
		            // end for each
		            }
	            ?>	            		            	
	            	
            	</ul>
            	<hr class="wed-hr semi">            	            	            	
            	<?php 
	            		            
	            $accom = $db->one("select accommodation from `rsvp` where id = '".$id."' limit 1");
            		
        		$accomFee = $db->one("select accom_fee from `rsvp` where id = '".$id."' limit 1");		            
        		
	            if (!is_null($accom) || $accom != ""){		            	            
            	?>            	
            	
            		<h4> You are booked at <?php echo $accom; ?> </h4>
            		<?php if ($accomFee != "FREE"){ ?>
            			<h6 class=""> Please pay upon arrival PHP <?php echo $accomFee; ?>. Collector: TBA </h6>
            		<?php } ?>
            	
            	<?php 
	            } else if (!is_null($accomFee)  || $accomFee != ""){
		        ?>
		        
		        	<h6>Would you like us to assist you in booking in their sister resort (3mins walk via shore) 
		        		<a href="http://www.acuaverderesort.com.ph/" id="acua-link">Acuaverde?</a>
		        		<br> (<?php echo $accomFee; ?>) | Subject to Availability		        		
		        		<br>
		        		<div id="yes-button" data-id="<?php echo $id;?>">
		        			YES PLEASE!
		        		</div>
		        		<div id="book-confirm" class="hidden" >
		        			<h2>Ok, we'll try to get back to you as soon as we can =)</h2>
		        		</div>
		        	</h6>
	            <?php
	            }
            	?>
            	<hr class="wed-hr semi">
            	
            </div>
            
            <img src="img/ambigram.png" width="218px" id="ambigram">
            
            <hr class="wed-hr">
            
            <div id="car" class="full-width-images">
            	<div class="filter" data-top-top="opacity: 0" data-50-bottom-bottom="opacity: 1">
            		
            	</div>
            </div>
           
            <div id="the-place">
            
            	<h1 class="section-header">- The Place -</h1>             
            
            	<h2 class="">Acquatico Beach Resort, Laiya Batangas</h2>             
            
            	<div id="map">
            		<!-- <iframe width="425" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ph/maps/ms?msa=0&amp;msid=211382407486759869128.0004d1ecb21e59ecb0743&amp;hl=en&amp;ie=UTF8&amp;ll=14.054752,121.217175&amp;spn=0.754813,0.343674&amp;t=m&amp;output=embed"></iframe> -->
            	</div>
            	
            	<a id="map-link" href="https://maps.google.com.ph/maps/ms?msa=0&amp;msid=211382407486759869128.0004d1ecb21e59ecb0743&amp;hl=en&amp;ie=UTF8&amp;ll=14.054752,121.217175&amp;spn=0.754813,0.343674&amp;t=m&amp;source=embed">
            		View in Google Maps
            	</a>
            	<!-- -->            	
            	<h3>Directions<br><small>(from SLEX alabang)</small></h3>
            	
            	<div id="prev">
            		Prev Step
            	</div>
            	
            	<div id="next">
            		Next Step
            	</div>
            	            	
            	<ul id="steps">
	            	
            	</ul>
            	<!-- -->
            	<h4 id="alt-dir">Alternative Directions</h4>
            	
            	<ul id="directions" class="hidden">
	            	<li>About 45 kilometers drive on the Star Toll way (STAR), you will see San Jose-Ibaan Exit (after the Lipa exit).</li>
	            	<li> After passing the tollbooth, turn left and drive 2.5 kilometers. </li>
	            	<li>You will reach an intersection with a sign pointing to Rosario, please turn left at this intersection. </li>
	            	<li>After turning left, the Municipal Hall of Ibaan will be on your right while a church will be on your left. </li>
	            	<li>After passing the church on your left you will reach a forked road. </li>
	            	<li>Turn right at the road sign pointing to San Juan. </li>
	            	<li>Drive 8 kilometers along this road to Rosario town proper.</li>	            	
	            	<li>
	            	<br>
		            	Once you reach the Rosario town proper, drive past the Jollibee and South Star drug store outlets at your left. </li>
		            	<li>This road leads all the way to San Juan town proper, which is about 23 kilometers away. </li>
		            	<libr>When you see the sign leading to the Batangas Racing Circuit turn left and head straight for San Juan town proper.</li>
	            	<li><br>
		            	After entering San Juan town proper, drive past the Dunkin Donut and Park n’Go stores at your right and head for the Municipal Hall of San Juan. </li>
		            	<li>Turn right immediately after the Municipal Hall of San Juan. </li>
		            	<li>This is the main road of Laiya. </li>
		            	<li>Drive approximately 23.5 kms. (25 minutes).</li>
	            	<li><br>
		            	Drive past Playa Laiya. </li>
		            	<li>This is about 3 km away from Acuatico. </li>
		            	<li>On the left side will be an empty parking lot immediately after which is a narrow access road to Acuatico. </li>
		            	<li>Turn left here. </li>
		            	<li>Follow the road. </li>
		            	<li>About 100 m from the main road is the Acuatico entrance on your right.</li>

	            	</li>
            	</ul>
            
            	<br><h4 id="print-dir">Print Map</h4>
            	

            	
            	
            	<div id="acquatico" class="full-width-images"></div>                        	
            </div>
            
            <div id="attire">
            	<h1 class="section-header">- Attire -</h1>
            </div>

            <!-- --
            <div id="registry">
            	<h1 class="section-header">- Registry -</h1>
            </div>
            <!-- -->

            <div id="std">
            	<h1 class="section-header">- Save The Date! -</h1>
            	
            	<div id="std-video">            		
	            	<iframe src="http://player.vimeo.com/video/50879590?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            	</div>            	
            </div>
            
            
            <div id="overlay">

            <div id="us" class="full-width-images">
            
            	<div id="us1" class="us-images full-width-images">
            		
            	</div>
            	
            	<div id="us2" class="us-images full-width-images">
            		
            	</div>
            	<div id="us3" class="us-images full-width-images">
            		
            	</div>
            	<div id="us4" class="us-images full-width-images">
            		
            	</div>            	            	
            </div>
            	
            </div>
            
            
            
        </div> <!-- #main-container -->

        <!--<div class="footer-container">
             <footer class="wrapper">
                <h3>footer</h3>
            </footer> 
        </div>-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/lib/jquery-1.8.1.min.js"><\/script>')</script>

        
        <!-- <script src="js/lib/jquery.slabtext.min.js"></script> -->
        <script src="js/lib/skrollr.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="js/lib/gmaps.js"></script>
        <script src="js/lib/jquery.cycle.all.js"></script>      
        <script src="js/lib/jquery.waitforimages.js"></script> 
        <script src="js/lib/jquery.scrollto.min.js"></script>                
        <script src="js/lib/jquery.nicescroll.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        
		<script type="text/javascript">
			
			/*
			$(document).ready(function(){
			
			  $('#forward').attr('disabled', 'disabled');
			  $('#back').attr('disabled', 'disabled');
			  $('#get_route').click(function(e){
			    e.preventDefault();
			
			    origin = map.markers[0].getPosition();
			    destination = map.markers[map.markers.length-1].getPosition();
			
			    map.getRoutes({
			      origin: [origin.lat(), origin.lng()],
			      destination: [destination.lat(), destination.lng()],
			      travelMode: 'driving',
			      callback: function(e){
			        route = new GMaps.Route({
			          map: map,
			          route: e[0],
			          strokeColor: '#336699',
			          strokeOpacity: 0.5,
			          strokeWeight: 10
			        });
			        $('#forward').removeAttr('disabled');
			        $('#back').removeAttr('disabled');
			      }
			    });
			    $('#forward').click(function(e){
			      e.preventDefault();
			      route.forward();
			
			      if(route.step_count < route.steps_length)
			        $('#steps').append('<li>'+route.steps[route.step_count].instructions+'</li>');
			    });
			    $('#back').click(function(e){
			      e.preventDefault();
			      route.back();
			
			      if(route.step_count >= 0)
			        $('#steps').find('li').last().remove();
			    });
			  });
			  
			  
			});
			*/
		</script>


<script>

</script>

        <script>
            //var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            //(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            //g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            //s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
