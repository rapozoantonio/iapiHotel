<?php

// This page contains a working example of the subscribe form, for those who do not have an email marketing service such as Mailchimp.

if(isset($_POST['subscribe'])=="subscribeform"){
	
// Validation Check

$continue = true;

if(empty($_POST['name'])){
	$continue = false;
}
if(empty($_POST['email'])){
	$continue = false;
}

// Validation OK, send email

if($continue===true){
		
	require 'system/email/phpmailer/PHPMailerAutoload.php';
		
	// Send Email
	
	$message = $_POST['name']. ' wants to subscribe to your mailing list';
	
	$mail = new PHPMailer;
	$mail->setFrom($_POST['email']);
	$mail->addAddress('test@klayemorrison.com'); // Your email address
	$mail->Subject = 'New Subscriber';
	$mail->MsgHTML($message);
	$mail->send();
}
}
?>
<!doctype html>
<!-- Alpha Hotel: HTML Template by Klaye Morrison (http://klayemorrison.com) -->
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Subscribe - Alpha Hotel</title>
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


<!-- Subscribe | START -->
<div class="section subscribe fade">
	<div class="center">
        <h3><strong>Follow us</strong> to receive the latest news</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input name="name" type="text" placeholder="Your Name" required />
            <input name="email" type="text" placeholder="Email Address" required />
            <button name="subscribe" value="subscribeform" class="button">Subscribe <i class="icon ion-ios-email-outline"></i></button>
        </form>
        
        <!-- Social | START -->
        <div class="section social">
            <a href="https://www.facebook.com" target="_blank"><i class="icon ion-social-facebook"></i></a>
            <a href="https://www.instagram.com/klayemorrison/" target="_blank"><i class="icon ion-social-instagram-outline"></i></a>
        </div>
        <!-- Social | END -->
        
    </div>
</div>
<!-- Subscribe | END -->

</main>

<!-- ******************** Main | END ******************** -->



</div>
<script src="system/plugins.js"></script>
<script src="script.js"></script>
</body>
</html>