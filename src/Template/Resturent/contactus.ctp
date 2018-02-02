<!--Start Sub Banner-->
   <div class="sub-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="detail">
						<h1>contact us</h1>
						<span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a class="select">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-img"></div>
   </div>
   <div class="wave"></div>
   
   <!--End Sub Banner-->
   
   
   
   <!--Start Content-->
	<div class="content">
	
		<div class="contact-page">
		
		<!--Start Get in Touch-->
				<div class="get-in-touch">
					<div class="container">
					<div class="row">
						
						<div class="col-md-6">
							
							<div class="get-touch-detail">
								<h3>Get in Touch</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac tortor at tellus feugiat congue quis ut nunc. Semper ac dolor vitae accumsan. interdum hendrerit lacinia. Semper ac dolor vitae accumsan. interdum hendrerit lacinia.
								<br/><br/>
								f you have questions or comments, please get a hold of us in whichever way is most convenient. Ask away.</p>
							</div>
							
							<div class="social-icons">
								<h5>Follow Along</h5>
								<ul>
									<li><a href="#."><i class="icon-facebook-1"></i></a></li>
									<li><a href="#."><i class="icon-twitter-1"></i></a></li>
									<li><a href="#."><i class="icon-google"></i></a></li>
									<li><a href="#."><i class="icon-pinterest-p"></i></a></li>
									<li><a href="#."><i class="icon-instagram"></i></a></li>
								</ul>
							</div>
							
						</div>
						
						<div class="col-md-6">
							<div class="get-touch-form">
                            <p class="success_msg" id="success_msg" style="display:none">Thank You! We will contact you shortly.</p>
								<form name="contact_form" id="contact_form" method="post" onSubmit="return false">
                                <input name="name" id="name" type="text" onKeyPress="remove_contact_errors();" onblur="if(this.value == '') { this.value='Your Name'}" onfocus="if (this.value == 'Your Name') {this.value=''}" value="Your Name">
								<input class="last" name="email_address" id="email_address" onKeyPress="remove_contact_errors();" type="text" onblur="if(this.value == '') { this.value='E-mail Address'}" onfocus="if (this.value == 'E-mail Address') {this.value=''}" value="E-mail Address">
								<textarea name="msg" id="msg" cols="1" onKeyPress="remove_contact_errors();" rows="1" onblur="if(this.value == '') { this.value='Message'}" onfocus="if (this.value == 'Message') {this.value=''}" value="Message">Message</textarea>
								<input type="submit" name=" " value="send message" onClick="validateContact();">
                                </form>
							</div>
						</div>
						
					</div>
					</div>
					
					
				</div>
		<!--End Get in Touch-->
		
		
		<!--Start Map-->
			<div id='map'>
				<div id='find-us'></div>
			</div>
		<!--End Map-->
					
		
		</div>
		
	</div>	
   <!--End Content-->

<script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script> 
 
<script> 
    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(-37.812433,144.954019),
            zoom: 19,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        var mapElement = document.getElementById('find-us');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
['Your Company', 'Envato, King Street, Melbourne, Victoria, Australia', '+123 55 33 444 888', 'help@pearl.com', 'www.pearl.com', -37.8124755, 144.953892, 'http://wahabali.com/themeforest_images/pearl-map.png']
        ];
        for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
link = '';            bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web, link);
     }
 function bindInfoWindow(marker, map, title, desc, telephone, email, web, link) {
      var infoWindowVisible = (function () {
              var currentlyVisible = false;
              return function (visible) {
                  if (visible !== undefined) {
                      currentlyVisible = visible;
                  }
                  return currentlyVisible;
               };
           }());
           iw = new google.maps.InfoWindow();
           google.maps.event.addListener(marker, 'click', function() {
               if (infoWindowVisible()) {
                   iw.close();
                   infoWindowVisible(false);
               } else {
                   var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+title+"</h4><p>"+desc+"<p><p>"+telephone+"<p><a href='mailto:"+email+"' >"+email+"<a></div>";
                   iw = new google.maps.InfoWindow({content:html});
                   iw.open(map,marker);
                   infoWindowVisible(true);
               }
        });
        google.maps.event.addListener(iw, 'closeclick', function () {
            infoWindowVisible(false);
        });
 }
}
</script>