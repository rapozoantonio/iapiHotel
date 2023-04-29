<?php
$alert = null;
if(isset($_POST['send'])=="sendform"){
	
	// Validation Check
	
	$continue = true;
	$validation = "";
	
	if(empty($_POST['contact-name'])){
		$continue = false;
		$validation = "First Name, ";
	}
	if(empty($_POST['contact-email'])){
		$continue = false;
		$validation .= "Email Address, ";
	}
	if(!empty($_POST['contact-email2'])){
		$continue = false;
	}
	
	// Validation OK, send email
	
	if($continue===true){
			
		require 'system/email/phpmailer/PHPMailerAutoload.php';
		
		// Hotel Details
		
		$hotel_name = "Alpha Hotel";
		$hotel_email = "test@klayemorrison.com";
		
		// Send Email to Guest
		
		$message = file_get_contents('system/email/template-guest.php');
		$message = str_replace('[name]', $_POST['contact-name'], $message);
		$message = str_replace('[email]', $_POST['contact-email'], $message);
		$message = str_replace('[phone]', $_POST['contact-phone'], $message);
		$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
		$message = str_replace('[departure]', $_POST['contact-departure'], $message);
		$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
		$message = str_replace('[adults]', $_POST['contact-adults'], $message);
		$message = str_replace('[children]', $_POST['contact-children'], $message);
		$message = str_replace('[message]', $_POST['contact-message'], $message);
		
		$mail = new PHPMailer;
		$mail->setFrom($hotel_email, $hotel_name);
		$mail->addAddress($_POST['contact-email'], $_POST['contact-name']);
		$mail->Subject = $hotel_name.' Booking Request';
		$mail->MsgHTML($message);
		$mail->IsHTML(true);
		$mail->send();
		
		// Send Email to Hotel
	
		$message = file_get_contents('system/email/template-hotel.php');
		$message = str_replace('[name]', $_POST['contact-name'], $message);
		$message = str_replace('[email]', $_POST['contact-email'], $message);
		$message = str_replace('[phone]', $_POST['contact-phone'], $message);
		$message = str_replace('[arrival]', $_POST['contact-arrival'], $message);
		$message = str_replace('[departure]', $_POST['contact-departure'], $message);
		$message = str_replace('[rooms]', $_POST['contact-rooms'], $message);
		$message = str_replace('[adults]', $_POST['contact-adults'], $message);
		$message = str_replace('[children]', $_POST['contact-children'], $message);
		$message = str_replace('[message]', $_POST['contact-message'], $message);
		
		$mail = new PHPMailer;
		$mail->setFrom($_POST['contact-email'], $_POST['contact-name']);
		$mail->addAddress($hotel_email, $hotel_name);
		$mail->Subject = 'Booking Request from '.$_POST['contact-name'];
		$mail->MsgHTML($message);
		
		// Alerts
		
		if (!$mail->send()) {
			$alert = "<p class='alert error fade'><i class='icon ion-ios-close-outline'></i> There was an error, please call us to make a booking</p>";
		}
		else {
			$alert = "<p class='alert success fade'><i class='icon ion-ios-checkmark-outline'></i> Thank you for your booking request, we will get back to you as soon as possible</p>";
		}
	}
	else {
		$alert = "<p class='alert validate fade'><i class='icon ion-ios-information-outline'></i> Please fill out the following fields: ".$validation."</p>";
	}
}
?>
<!doctype html>
<!-- Alpha Hotel: HTML Template by Klaye Morrison (http://klayemorrison.com) -->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact - Alpha Hotel</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
<div class="container">



<!-- ******************** Header | START ******************** -->

<!-- Navigation | START -->
<header>
	<div class="center">
        <a class="logo" href="index.html"><img src="system/images/logo.png" alt=""></a>
        <nav>
            <ul>
                <li class="nav-book"><a href="contact.php">Book</a></li>
                <li><a href="index.html">Home</a>
                	<ul>
                        <li><a href="index.html">Home (Default)</a></li>
                        <li><a href="index-no-booking.html">Home (No Booking)</a></li>
                    </ul>
                </li>
                <li class="drop"><a href="accommodation.html">Accommodation</a>
                    <ul>
                        <li><a href="accommodation.html">Accommodation List</a></li>
                        <li><a href="accommodation-room.html">Room Layout</a></li>
                    </ul>
                </li>
                <li><a href="location.html">Location</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li class="drop"><a href="about.html">More Pages</a>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="packages.html">Packages</a></li>
                        <li><a href="restaurant.html">Restaurant</a></li>
                        <li><a href="testimonials.html">Testimonials</a></li>
                        <li class="drop"><a href="blog.html">Hotel Blog</a>
                            <ul>
                                <li><a href="blog.html">Blog Overview</a></li>
                                <li><a href="blog-post.html">Blog Post</a></li>
                            </ul>
                        </li>
                        <li><a href="shortcodes.html">Shortcodes</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a>
                	<ul>
                        <li><a href="contact.php">Booking Request</a></li>
                        <li><a href="contact-no-booking.php">Make an Enquiry</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="mobilenav"><i class="icon ion-navicon"></i></div>
        <a class="button book-button" href="contact.php">Book</a>
        <div class="header-social">
            <a href="https://www.facebook.com" target="_blank"><i class="icon ion-social-facebook"></i></a>
            <a href="https://www.instagram.com/klayemorrison/" target="_blank"><i class="icon ion-social-instagram-outline"></i></a>
        </div>
    </div>
</header>
<!-- Navigation | END -->

<!-- ******************** Header | END ******************** -->



<!-- ******************** Main | START ******************** -->

<main>



<!-- Form | START -->
<?=$alert;?>
<div class="section form fade">
	<div class="center">
    	<div class="label">Contact Us</div>
        <h1>Book your stay</h1>
        <h5>Please make a booking request using our contact form and we will get back to you as soon as possible.</h5>
        
        <form name="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            
            <div class="col-2">
                
                <!-- Arrival Date -->
                <div class="field calendar">
                	<span class="tag"><i class="icon ion-android-arrow-forward"></i></span>
                	<input name="contact-arrival" class="contact-arrival" type="text" value="<?php if (isset($_POST['arrival']) && !empty($_POST['arrival'])) { echo $_POST['arrival']; } else { echo isset($_POST['contact-arrival'])?$_POST['contact-arrival']:""; } ?>" readonly />
                    <i class="icon ion-ios-calendar-outline"></i>
                </div>
                
                <!-- Departure Date -->
                <div class="field calendar">
                	<span class="tag"><i class="icon ion-android-arrow-back"></i></span>
                    <input name="contact-departure" class="contact-departure" type="text" value="<?php if (isset($_POST['departure']) && !empty($_POST['departure'])) { echo $_POST['departure']; } else { echo isset($_POST['contact-departure'])?$_POST['contact-departure']:""; } ?>" readonly />
                    <i class="icon ion-ios-calendar-outline"></i>
                </div>
                
                <!-- Room Details -->
                <?php (isset($_POST['contact-rooms'])) ? $rooms = $_POST['contact-rooms']:"";
				(isset($_POST['contact-adults'])) ? $adults = $_POST['contact-adults']:"";
				(isset($_POST['contact-children'])) ? $children = $_POST['contact-children']:""; ?>
                
                <div class="field">
                    <select name="contact-rooms" class="infants">
                        <option <?php if ($rooms == 1 ) echo 'selected'; ?> value="1">1 Room</option>
                        <option <?php if ($rooms == 2 ) echo 'selected'; ?> value="2" >2 Rooms</option>
                        <option <?php if ($rooms == 3 ) echo 'selected'; ?> value="3" >3 Rooms</option>
                    </select>
                </div>
                <div class="field">
                    <select name="contact-adults" class="adults">
                        <option <?php if ($adults == 1 ) echo 'selected'; ?> value="1" >1 Adult</option>
                        <option <?php if ($adults == 2 ) echo 'selected'; ?> value="2" >2 Adults</option>
                        <option <?php if ($adults == 3 ) echo 'selected'; ?> value="3" >3 Adults</option>
                        <option <?php if ($adults == 4 ) echo 'selected'; ?> value="4" >4 Adults</option>
                        <option <?php if ($adults == 5 ) echo 'selected'; ?> value="5" >5 Adults</option>
                    </select>
                </div>
                <div class="field">
                    <select name="contact-children" class="children">
                        <option <?php if ($children == 0 ) echo 'selected'; ?> value="0">0 Children</option>
                        <option <?php if ($children == 1 ) echo 'selected'; ?> value="1" >1 Children</option>
                        <option <?php if ($children == 2 ) echo 'selected'; ?> value="2" >2 Children</option>
                        <option <?php if ($children == 3 ) echo 'selected'; ?> value="3" >3 Children</option>
                        <option <?php if ($children == 4 ) echo 'selected'; ?> value="4" >4 Children</option>
                    </select>
                </div>
            </div>
            
            <div class="col-2">
                <div class="field"><input name="contact-name" type="text" placeholder="Your Name" value="<?php echo isset($_POST['contact-name'])?$_POST['contact-name']:""; ?>" required /></div>
                <div class="field"><input name="contact-email" type="text" placeholder="Email Address" value="<?php echo isset($_POST['contact-email'])?$_POST['contact-email']:""; ?>" required /></div>
                <div class="field"><input name="contact-phone" type="text" placeholder="Phone Number" value="<?php echo isset($_POST['contact-phone'])?$_POST['contact-phone']:""; ?>" /></div>
                <div class="field"><textarea name="contact-message" placeholder="Message"><?php echo isset($_POST['contact-message'])?$_POST['contact-message']:""; ?></textarea></div>
            </div>
            
            <div class="col-1">
            	<!-- Honeypot (for bot spam) --><input name="contact-email2" type="text" placeholder="Email Address" autocomplete="false" class="honeypot" value="<?php echo isset($_POST['contact-email2'])?$_POST['contact-email2']:""; ?>" />
                <button class="button" name="send" value="sendform">Send Booking Request <i class="icon ion-ios-arrow-right"></i></button>
            </div>
            
        </form>
    </div>
</div>
<!-- Form | END -->



<!-- USP Strip | START -->
<div class="section usp fade">
	<div class="center">
    
        <div class="col-3">
        	<div class="item">
            	<i class="icon ion-ios-telephone-outline"></i>
                <h4>Call Reservations</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel.</p>
            </div>
        </div>
        
        <div class="col-3">
        	<div class="item">
            	<i class="icon ion-ios-email-outline"></i>
                <h4>Send an Enquiry</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel.</p>
            </div>
        </div>
        
        <div class="col-3">
        	<div class="item">
            	<i class="icon ion-ios-eye-outline"></i>
                <h4>Visit the Hotel</h4>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel.</p>
            </div>
        </div>
        
    </div>
</div>
<!-- USP Strip | END -->



<!-- Social | START -->
<div class="section social fade">
    <a href="https://www.facebook.com" target="_blank"><i class="icon ion-social-facebook"></i></a>
    <a href="https://www.instagram.com/klayemorrison/" target="_blank"><i class="icon ion-social-instagram-outline"></i></a>
</div>
<!-- Social | END -->



<!-- Map | START -->
<div class="section map fade">
    
    <div id="map"></div>
    
    <script>function initialize() {
	var latlng = new google.maps.LatLng(-37.837580, 144.961543);
	var myOptions = {
	zoom: 13,
	center: latlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	scrollwheel: false
	};
	var map = new google.maps.Map(document.getElementById('map'), myOptions);
	var marker = new google.maps.Marker({
	position: latlng, 
	map: map,
	icon: "system/images/point.png"
	});
	}
	function loadScript() {
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&'+'callback=initialize';
	document.body.appendChild(script);
	}
	window.onload = loadScript;</script>
        
</div>
<!-- Map | END -->

</main>

<!-- ******************** Main | END ******************** -->



<!-- ******************** Footer | START ******************** -->

<footer class="fade">
    <div class="col-3">
        <i class="icon ion-ios-location-outline"></i>
        <h4>ALPHA HOTEL</h4>
        <div class="stars">
        	<i class="icon ion-android-star"></i>
            <i class="icon ion-android-star"></i>
            <i class="icon ion-android-star"></i>
            <i class="icon ion-android-star"></i>
            <i class="icon ion-android-star"></i>
        </div>
        <p>100 Luxury Street, Melbourne<br>
        Victoria, Australia, 3000<br>
        <strong>+61 3 5552 1234</strong></p>
    </div>
    <div class="footer-nav">
    	<ul class="footer-links">
        	<li class="hide">Copyright &copy; <script>var d = new Date(); document.write(d.getFullYear());</script></li>
            <li><a href="index.html">Alpha Hotel</a></li>
            <li><a href="http://themeforest.net/item/alpha-hotel-website-template/15582771?ref=Klayemore" target="_blank">Theme by KM</a></li>
        </ul>
        <ul id="language">
            <li><a><span class="flag-icon flag-icon-gb"></span> English</a></li>
            <li><a href="#"><span class="flag-icon flag-icon-it"></span> Italiano</a></li>
            <li><a href="#"><span class="flag-icon flag-icon-de"></span> Deutsch</a></li>
            <li><a href="#"><span class="flag-icon flag-icon-fr"></span> Français</a></li>
        </ul>
    </div>
</footer>

<!-- ******************** Footer | END ******************** -->



</div>
<script src="system/plugins.js"></script>
<script src="script.js"></script>
</body>
</html>