<?php
$your_email = 'youremail@youremail.com'; // <<=== update to your email address

session_start();
$errors = '';
$name = '';
$visitor_email = '';
$phone_number = '';
$user_message = '';

if (isset($_POST['submit']))
	{
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$phone_number = $_POST['phonenumber'];
	$user_message = $_POST['message'];

	if (empty($name))
		{
		$errors.= "\n * Name are required. ";
		}

	if (empty($visitor_email))
		{
		$errors.= "\n * Email are required. ";
		}

	if (empty($phone_number))
		{
		$errors.= "\n * Phone Number are required. ";
		}

	if (IsInjected($visitor_email))
		{
		$errors.= "\n Bad email value!";
		}

	if (empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
		{

		// Note: the captcha code is compared case insensitively.
		// if you want case sensitive match, update the check above to
		// strcmp()

		$errors.= "\n * The captcha code does not match!";
		}

	if (empty($errors))
		{

		// send the email

		$to = $your_email;
		$subject_form = "Veil Contact Form";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		$body = "A user  $name submitted the contact form:\n" . "Name: $name\n" . "Email: $visitor_email \n" . "Phone Number: $phone_number \n" . "Message: \n " . "$user_message\n" . "IP: $ip\n";
		$headers = "From: $from \r\n";
		$headers.= "Reply-To: $visitor_email \r\n";
		mail($to, $subject_form, $body, $headers);
		/*
		*
		* do processing and error checking
		*
		**/
		header("Location: page-contact-us-2.php?formsubmit=1");
		exit();
		}
	}

// Function to validate against any email injection attempts

function IsInjected($str)
	{
	$injections = array(
		'(\n+)',
		'(\r+)',
		'(\t+)',
		'(%0A+)',
		'(%0D+)',
		'(%08+)',
		'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if (preg_match($inject, $str))
		{
		return true;
		}
	  else
		{
		return false;
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Page - Contact Us | iMax</title>

    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,800,800italic,300,300italic">
    <!-- Begin: MAIN CSS -->

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/plugins-min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu-overright.css">
    <link href="assets/css/colors/aqua-yellow.css" type="text/css" media="all" rel="stylesheet" />
    <!-- End: MAIN CSS -->

    <!-- Begin: HTML5SHIV FOR IE8 -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/internetexplorer/html5shiv.min.js"></script>
      <script src="assets/js/internetexplorer/respond.min.js"></script>
    <![endif]-->
    <!-- end: HTML5SHIV FOR IE8 -->
</head>
<body class="switcher_boxed boxed">

    <!-- Begin: HEADER SEARCH -->
    <div class="modal fade header-search" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="search">
                <form method="get" action="search.html">
                    <div class="form-group full-width">
                        <div class="input-group">
                            <input type="text" class="form-control input-lg" placeholder="Search Here..." value="" name="q">
                            <div class="input-group-btn "><button type="submit" class="btn btn-base btn-lg"><i class="fa fa-search"></i></button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: HEADER SEARCH -->

    <!--
    #################################
        - Begin: HEADER -
    #################################
    -->
    <header class="main-header sticky-header">
        <nav class="navbar navbar-default">
            <div class="container position-relative">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header border">
                    <!-- Begin: RESPONSIVE MENU TOGGLER -->
                    <button type="button" class="navbar-toggle" data-toggle="modal" data-target=".header-search">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <!-- End: RESPONSIVE MENU TOGGLER -->
                    <!-- Begin: RESPONSIVE MENU TOGGLER -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-shopping-bag"></i>
                    </button>
                    <!-- End: RESPONSIVE MENU TOGGLER -->
                    <!-- Begin: RESPONSIVE MENU TOGGLER -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- End: RESPONSIVE MENU TOGGLER -->
                    <!-- Begin: LOGO -->
                    <a class="navbar-brand logo" href="index.html"><span><i class="fa fa-info"></i></span> Max</a>
                    <!-- End: LOGO -->
                </div>
                <div class="collapse navbar-collapse pull-right search-shop-dropdown" id="nav-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right margin-right-0">
                        <li class="dropdown search-dropdown hidden-xs hidden-sm"> <a href="#" class="" data-toggle="modal" data-target=".header-search"><i class="fa fa-search"></i></a> </li>
                        <li class="dropdown shop-cart-dropdown">
                            <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-hover="dropdown" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-shopping-bag"></i><span class="badge">3</span> </a>
                            <ul class="dropdown-menu">
                                <li class="list-img">
                                    <ul class="list-ul">
                                        <li>
                                            <div class="row text-weight-700">
                                                <div class="col-xs-8">item(s)</div>
                                                <div class="col-xs-4 text-right">$90</div>
                                            </div>
                                        </li>
                                        <li class="alert">
                                            <div class="close"><a href="#" data-dismiss="alert" aria-hidden="false"><i class="fa fa-close"></i></a></div>
                                            <div class="list-img"> <a href="#"><img src="assets/images/widgets/shop-1.jpg" alt=""></a> </div>
                                            <div class="list-text">
                                                <h5 class="list-title text-weight-600"><a href="#">Halter Neck Dress</a></h5>
                                                <ul class="list-meta list-inline">
                                                    <li><i class="fa fa-usd"></i> 30.00</li>
                                                    <li>
                                                        <div class="star-rating" data-toggle="tooltip" data-placement="top" title="5.00"> <span class="width-100"><strong class="rating">5.00</strong> out of 5</span> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="alert">
                                            <div class="close"><a href="#" data-dismiss="alert" aria-hidden="false"><i class="fa fa-close"></i></a></div>
                                            <div class="list-img"> <a href="#"><img src="assets/images/widgets/shop-2.jpg" alt=""></a> </div>
                                            <div class="list-text">
                                                <h5 class="list-title text-weight-600"><a href="#">Maxi Sweater Dress</a></h5>
                                                <ul class="list-meta list-inline">
                                                    <li><i class="fa fa-usd"></i> 30.00</li>
                                                    <li>
                                                        <div class="star-rating" data-toggle="tooltip" data-placement="top" title="4.00"> <span class="width-80"><strong class="rating">4.00</strong> out of 5</span> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="alert">
                                            <div class="close"><a href="#" data-dismiss="alert" aria-hidden="false"><i class="fa fa-close"></i></a></div>
                                            <div class="list-img"> <a href="#"><img src="assets/images/widgets/shop-3.jpg" alt=""></a> </div>
                                            <div class="list-text">
                                                <h5 class="list-title text-weight-600"><a href="#">Mixed Fabric Jacket</a></h5>
                                                <ul class="list-meta list-inline">
                                                    <li><i class="fa fa-usd"></i> 30.00</li>
                                                    <li>
                                                        <div class="star-rating" data-toggle="tooltip" data-placement="top" title="2.50"> <span class="width-50"><strong class="rating">2.50</strong> out of 5</span> </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="shop-cart-btn">
                                    <div class="btn-group btn-group-justified"> <a href="shop-cart.html" class="btn btn-base btn-sm text-weight-700 text-spacing-2 text-uppercase">View Cart</a> <a href="shop-checkout.html" class="btn btn-dark btn-sm text-weight-700 text-spacing-2 text-uppercase">Checkout</a> </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <div class="collapse navbar-collapse text-weight-400" id="nav-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right margin-right-0">
                        <li class="dropdown">
                            <a href="index.html" class="dropdown-toggle" data-toggle="" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="#">Home - Corporate <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index-corporate-1.html">Home - Corporate 1</a></li>
                                        <li><a href="index-corporate-2.html">Home - Corporate 2</a></li>
                                        <li><a href="index-corporate-3.html">Home - Corporate 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#">Home - Portfolio <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index-portfolio-1.html">Home - Portfolio 1</a></li>
                                        <li><a href="index-portfolio-2.html">Home - Portfolio 2</a></li>
                                        <li><a href="index-portfolio-3.html">Home - Portfolio 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="charity-index.html">Home - Charity</a></li>
                                <li><a href="construction-index.html">Home - Construction</a></li>
                                <li><a href="gym-index.html">Home - Gym</a></li>
                                <li><a href="photography-index.html">Home - PhotoGraphy</a></li>
                                <li><a href="medico-index.html">Home - Medico</a></li>
                                    <li><a href="lawyer-index.html">Home - Lawyer</a></li>
                                <li><a href="wedding-index.html">Home - Wedding</a></li>
                                <li class="dropdown-submenu">
                                    <a href="index-blog-1.html">Blogs <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index-blog-1.html">Home - Blog 1</a></li>
                                        <li><a href="index-blog-2.html">Home - Blog 2</a></li>
                                        <li><a href="index-blog-3.html">Home - Blog 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="index-shop-1.html">Shops <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index-shop-1.html">Home - Shop 1</a></li>
                                        <li><a href="index-shop-2.html">Home - Shop 2</a></li>
                                        <li><a href="index-shop-3.html">Home - Shop 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="index-onepage.html">Home - One Page</a></li>
                            </ul>
                        </li>
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="page-about-us.html">About Us <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-about-us.html">About Us 1</a></li>
                                        <li><a href="page-about-us-2.html">About Us 2</a></li>
                                        <li><a href="page-about-us-3.html">About Us 3</a></li>
                                        <li><a href="page-about-me.html">About Me</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-services.html">Services <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-services.html">Services 1</a></li>
                                        <li><a href="page-services-2.html">Services 2</a></li>
                                        <li><a href="page-services-3.html">Services 3</a></li>
                                        <li><a href="page-services-4.html">Services 4</a></li>
                                        <li><a href="page-services-5.html">Services 5</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-our-team.html">Our Team <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-our-team.html">Our Team 1</a></li>
                                        <li><a href="page-our-team-2.html">Our Team 2</a></li>
                                        <li><a href="page-our-team-3.html">Our Team 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-testimonials.html">Testimonials <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-testimonials.html">Testimonials 1</a></li>
                                        <li><a href="page-testimonials-2.html">Testimonials 2</a></li>
                                        <li><a href="page-testimonials-3.html">Testimonials 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-faqs.html">Faqs <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-faqs.html">Faqs 1</a></li>
                                        <li><a href="page-faqs-2.html">Faqs 2</a></li>
                                        <li><a href="page-faqs-3.html">Faqs 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu active">
                                    <a href="page-contact-us.php">Contact Us <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-contact-us.php">Contact Us 1</a></li>
                                        <li class="active"><a href="page-contact-us-2.php">Contact Us 2</a></li>
                                        <li><a href="page-contact-us-3.php">Contact Us 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-left-sidebar.html">Layouts <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-left-sidebar.html">Left Sidebar</a></li>
                                        <li><a href="page-right-sidebar.html">Right Sidebar</a></li>
                                        <li><a href="page-both-sidebar.html">Both Sidebar</a></li>
                                        <li><a href="page-full-width.html">Full Width</a></li>
                                        <li><a href="page-wide-left-sidebar.html">Wide Left Sidebar</a></li>
                                        <li><a href="page-wide-right-sidebar.html">Wide Right Sidebar</a></li>
                                        <li><a href="page-wide-both-sidebar.html">Wide Both Sidebar</a></li>
                                        <li><a href="page-wide-full-width.html">Wide Full Width</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-login.html">Login <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-login.html">Login 1</a></li>
                                        <li><a href="page-login-2.html">Login 2</a></li>
                                        <li><a href="page-login-3.html">Login 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-register.html">Register <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-register.html">Register 1</a></li>
                                        <li><a href="page-register-2.html">Register 2</a></li>
                                        <li><a href="page-register-3.html">Register 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-login-register.html">Login Register <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-login-register.html">Login Register 1</a></li>
                                        <li><a href="page-login-register-2.html">Login Register 2</a></li>
                                        <li><a href="page-login-register-3.html">Login Register 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-lost-password.html">Lost Password <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-lost-password.html">Lost Password 1</a></li>
                                        <li><a href="page-lost-password-2.html">Lost Password 2</a></li>
                                        <li><a href="page-lost-password-3.html">Lost Password 3</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-error-404.html">404 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-error-404.html">404 1</a></li>
                                        <li><a href="page-error-404-2.html">404 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-coming-soon.html">Coming Soon <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-coming-soon.html">Coming Soon 1</a></li>
                                        <li><a href="page-coming-soon-2.html">Coming Soon 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="page-blank.html">Blank <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="page-blank.html">Blank 1</a></li>
                                        <li><a href="page-blank-2.html">Blank 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#">1st Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Link</a></li>
                                        <li><a href="#">Link</a></li>
                                        <li><a href="#">Link</a></li>
                                        <li class="dropdown-submenu">
                                            <a href="#">2nd Dropdown <span class="caret"></span></a>
                                            <ul class="dropdown-menu animate" data-animation="bounceInUp">
                                                <li><a href="#">Link</a></li>
                                                <li><a href="#">Link</a></li>
                                                <li><a href="#">Link</a></li>
                                                <li><a href="#">3rd Dropdown</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown mega-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portfolio <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Start: MEGA MENU CONTENT -->
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Columns</span>
                                                        <ul class="sub-menu">
                                                            <li><a href="portfolio-6-column.html">6 Column</a></li>
                                                            <li><a href="portfolio-5-column.html">5 Column</a></li>
                                                            <li><a href="portfolio-4-column.html">4 Column</a></li>
                                                            <li><a href="portfolio-3-column.html">3 Column</a></li>
                                                            <li><a href="portfolio-2-column.html">2 Column</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Style</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="portfolio-grid.html"> Grid </a> </li>
                                                            <li> <a href="portfolio-masonry.html"> Masonry </a> </li>
                                                            <li> <a href="portfolio-only-title.html"> Only Title </a> </li>
                                                            <li> <a href="portfolio-only-image.html"> Only Image </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Sidebars</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="portfolio-left-sidebar.html"> Left Sidebar </a> </li>
                                                            <li> <a href="portfolio-right-sidebar.html"> Right Sidebar </a> </li>
                                                            <li> <a href="portfolio-both-sidebar.html"> Both Sidebars </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Single Project</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="portfolio-single-project-fullwidth.html"> Fullwidth </a> </li>
                                                            <li> <a href="portfolio-single-project-left-sidebar.html"> Left Sidebar </a> </li>
                                                            <li> <a href="portfolio-single-project-right-sidebar.html"> Right Sidebar </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Single Project Media</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="portfolio-single-project-image-style.html"> Single Image </a> </li>
                                                            <li> <a href="portfolio-single-project-slider-gallery-style.html"> Slider Gallery </a> </li>
                                                            <li> <a href="portfolio-single-project-thumbnail-gallery-style.html"> Thumbnail Gallery </a> </li>
                                                            <li> <a href="portfolio-single-project-video-style.html"> Video </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Color Versions</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="portfolio-default.html"> Default </a> </li>
                                                            <li> <a href="portfolio-light.html"> Light </a> </li>
                                                            <li> <a href="portfolio-dark.html"> Dark </a> </li>
                                                            <li> <a href="portfolio-base.html"> Base </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: MEGA MENU CONTENT -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown mega-menu">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
                                Shortcodes <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu icon">
                                <li>
                                    <!-- Start: MEGA MENU CONTENT -->
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shortcode-accordion.html">
                                                                    <i class="fa fa-th-list"></i> Accordion
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-animations.html">
                                                                    <i class="fa fa-magic"></i> Animations
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-animated-rotate-text.html">
                                                                    <i class="fa fa-magic"></i> Animated Rotate Text
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-alerts.html">
                                                                    <i class="fa fa-exclamation-circle"></i> Alerts
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-buttons.html">
                                                                    <i class="fa fa-link"></i> Buttons
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-bg-sections.html">
                                                                    <i class="fa fa-columns"></i> Background Sections
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-clients.html">
                                                                    <i class="fa fa-user"></i> Clients
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-counters.html">
                                                                    <i class="fa fa-tachometer"></i> Counters
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-column-section.html">
                                                                    <i class="fa fa-columns"></i> Column Section
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shortcode-callout.html">
                                                                    <i class="fa fa-bullhorn"></i> Callout
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-forms.html">
                                                                    <i class="fa fa-table"></i> Forms
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-full-screen-section.html">
                                                                    <i class="fa fa-table"></i> Full Screen Section
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-grid.html">
                                                                    <i class="fa fa-th-large"></i> Grid System
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-icons.html">
                                                                    <i class="fa fa-leaf"></i> Icons
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-icon-lists.html">
                                                                    <i class="fa fa-list-alt"></i> Icon Lists
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-labels-badges.html">
                                                                    <i class="fa fa-certificate"></i> Labels & Badges
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-list-group-panels.html">
                                                                    <i class="fa fa-align-justify"></i> List Group & Panels
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-map.html">
                                                                    <i class="fa fa-map-marker"></i> Map
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shortcode-modals.html">
                                                                    <i class="fa fa-arrows-alt"></i> Modals
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-progressbar.html">
                                                                    <i class="fa fa-tasks"></i> Progressbar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-pricing-tables.html">
                                                                    <i class="fa fa-usd"></i> Pricing Tables
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-parallax-section.html">
                                                                    <i class="fa fa-columns"></i> Parallax Section
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-pagination-pager.html">
                                                                    <i class="fa fa-cogs"></i> Pagination & Pager
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-responsive-media-embeds.html">
                                                                    <i class="fa fa-play"></i> Responsive Media Embeds
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-services-box.html">
                                                                    <i class="fa fa-cubes"></i> Services Box
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-separator.html">
                                                                    <i class="fa fa-indent"></i> Separator
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-social-icons.html">
                                                                    <i class="fa fa-facebook"></i> Social Icons
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shortcode-typograpy.html">
                                                                    <i class="fa fa-pencil"></i> Typograpy
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-team.html">
                                                                    <i class="fa fa-users"></i> Team
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-testimonials.html">
                                                                    <i class="fa fa-quote-left"></i> Testimonials
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-tabs.html">
                                                                    <i class="fa fa-star"></i> Tabs
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-tables.html">
                                                                    <i class="fa fa-table"></i> Tables
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shortcode-video-background.html">
                                                                    <i class="fa fa-object-group"></i> Video Background
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: MEGA MENU CONTENT -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown mega-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Start: MEGA MENU CONTENT -->
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Columns</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="blog-6-column.html">
                                                                    6 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-5-column.html">
                                                                    5 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-4-column.html">
                                                                    4 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-3-column.html">
                                                                    3 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-2-column.html">
                                                                    2 Column
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Blog Style</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="blog-grid.html">
                                                                    Grid
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-masonry.html">
                                                                    Masonry
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-thumbnail.html">
                                                                    Thumbnail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-medium-image.html">
                                                                    Medium Image
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-large-image.html">
                                                                    Large Image
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Sidebars</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="blog-left-sidebar.html">
                                                                    Left Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-right-sidebar.html">
                                                                    Right Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-both-sidebar.html">
                                                                    Both Sidebars
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Single Post</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="blog-single-post-fullwidth.html">
                                                                    Fullwidth
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-single-post-left-sidebar.html">
                                                                    Left Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-single-post-right-sidebar.html">
                                                                    Right Sidebar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Single Post Media Style</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="blog-single-image-post.html">
                                                                    Single Image Post
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-single-slider-gallery-post.html">
                                                                    Slider Gallery Post
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-single-thumbnail-gallery-post.html">
                                                                    Thumbnail Gallery Post
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="blog-single-video-post.html">
                                                                    Video Post
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: MEGA MENU CONTENT -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown mega-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Start: MEGA MENU CONTENT -->
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Columns</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shop-6-column.html">
                                                                    6 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-5-column.html">
                                                                    5 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-4-column.html">
                                                                    4 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-3-column.html">
                                                                    3 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-2-column.html">
                                                                    2 Column
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-1-column.html">
                                                                    1 Column
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Shop Style</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shop-grid.html">
                                                                    Grid
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-masonry.html">
                                                                    Masonry
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Sidebars</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shop-left-sidebar.html">
                                                                    Left Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-right-sidebar.html">
                                                                    Right Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-both-sidebar.html">
                                                                    Both Sidebars
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Single Product</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shop-single-product-fullwidth.html">
                                                                    Fullwidth
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-single-product-left-sidebar.html">
                                                                    Left Sidebar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-single-product-right-sidebar.html">
                                                                    Right Sidebar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Order Process</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="shop-cart.html">
                                                                    Cart
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="shop-checkout.html">
                                                                    Checkout
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Color Versions</span>
                                                        <ul class="sub-menu">
                                                            <li> <a href="shop-default.html"> Default </a> </li>
                                                            <li> <a href="shop-light.html"> Light </a> </li>
                                                            <li> <a href="shop-dark.html"> Dark </a> </li>
                                                            <li> <a href="shop-base.html"> Base </a> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: MEGA MENU CONTENT -->
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown mega-menu">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
                                Features <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- Start: MEGA MENU CONTENT -->
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Header Color Versions</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-default-header.html">
                                                                    Default White Header
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-light-header.html">
                                                                    Light Header
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-dark-header.html">
                                                                    Dark Header
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-base-header.html">
                                                                    Base Header
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Header Sizes</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-wide-header-mega-menu-wide.html">
                                                                    Wide Header Mega Menu Wide
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-box-header-mega-menu-wide.html">
                                                                    Box Header Mega Menu Wide
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Logo Menu Positions</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-logo-left-menu-right.html">
                                                                    Logo Left Menu Right
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-right-menu-left.html">
                                                                    Logo Right Menu Left
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-menu-below.html">
                                                                    Logo Top Menu Bellow
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Transparent Header</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-transparent-header-white-text.html">
                                                                    Menu White Text
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-transparent-header-black-text.html">
                                                                    Menu Black Text
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Semi Transparent</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-semi-transparent-header-default.html">
                                                                    Default
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-semi-transparent-header-light.html">
                                                                    Light
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-semi-transparent-header-dark.html">
                                                                    Dark
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-semi-transparent-header-base.html">
                                                                    Base
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Logo Bg Menu BG</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-logo-top-position-white-base.html">
                                                                    White, Base
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-base-white.html">
                                                                    Base, White
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-dark-base.html">
                                                                    Dark, Base
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-base-dark.html">
                                                                    Base, Dark
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-white-dark.html">
                                                                    White, Dark
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-dark-white.html">
                                                                    Dark, White
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-white-light.html">
                                                                    White, Light
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-logo-top-position-light-white.html">
                                                                    Light, White
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-menu-icon-inside.html">
                                                                    Menu Icon Inside <span class="label label-base">Hot</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Revolution Sliders</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-revolution-slider.html">
                                                                    Boxed
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-revolution-slider-full-width.html">
                                                                    Full Width
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-revolution-slider-full-screen.html">
                                                                    Full Screen
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Page Main Heading</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-page-main-heading-sizes.html">
                                                                    Sizes
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-page-main-heading-alignment.html">
                                                                    Alignment
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-page-main-heading-color-version.html">
                                                                    Color Version
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-page-main-heading-media-version.html">
                                                                    Media Version
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">OWL Sliders</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-owl-slider.html">
                                                                    Default
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-owl-slider-progress-bar.html">
                                                                    Progress Bar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-owl-slider-thumbnail.html">
                                                                    Thumbnail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-owl-slider-carousels.html">
                                                                    Carousels
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-owl-slider-static-content.html">
                                                                    Static Content
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <ul class="sub-menu">
                                                    <li>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Flex Sliders</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-flex-slider.html">
                                                                    Default
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-flex-slider-thumbnail.html">
                                                                    Thumbnail
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <span class="mega-menu-title text-uppercase text-weight-700">Features</span>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="features-widgets.html">
                                                                    Widgets
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-modal-onload.html">
                                                                    Modal Onload
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-sticky-page-title.html">
                                                                    Sticky Page Title
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-twitter-tweets.html">
                                                                    Twitter Tweets
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-top-headers.html">
                                                                    Top Headers
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-patterns.html">
                                                                    Patterns
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-page-loaders.html">
                                                                    Page Loader
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-boxed-layout.html">
                                                                    Boxed Layout
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-left-header.html">
                                                                    Left Header
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="features-right-header.html">
                                                                    Right Header
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: MEGA MENU CONTENT -->
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
    </header>
    <!-- End: HEADER -
    ################################################################## -->


    <!--
    #################################
        - Begin: BACKGROUND SECTION -
    #################################
    -->
    <section class="padding-0">
        <!-- Begin: MAP -->
        <div class="is-map width-100 height-400px" data-latlng="48.868974, 2.330663" data-zoom="13">
            <p data-marker-image="assets/images/map-marker.png" data-latlng="48.860617, 2.337650" data-title="Location 1">
                <strong>Location 1:</strong>
                <br /> Main Office Here
            </p>
            <p data-marker-image="assets/images/map-marker.png" data-latlng="48.865491, 2.321137" data-title="Location 2">
                <strong>Location 2:</strong>
                <br /> 2nd Branch Office Here
            </p>
            <p data-marker-image="assets/images/map-marker.png" data-latlng="48.871977, 2.331612" data-title="Location 3">
                <strong>Location 3:</strong>
                <br /> 3rd Branch Office Here
            </p>
        </div>
        <!-- End: MAP -->
    </section>
    <!-- End: BACKGROUND SECTION -
    ################################################################## -->


    <!--
    #################################
        - Begin: FAQs -
    #################################
    -->
    <section class="padding-top-large padding-bottom-small">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 padding-bottom-medium">
                    <h3 class="page-header text-weight-300">Get in Touch with Us</h3>
                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime. nobis est eligendi optio cumque nihil impedit quo minus.</p>

                    <!-- Begin: FORM -->
                    <?php if(isset($_GET[ 'formsubmit'])) { /* if the form has been submitted */ echo '<h1 class="text-center text-base margin-bottom-small font-size-60px"><i class="fa fa-envelope-o"></i></h1>'; echo '<h5 class="text-center margin-bottom-small">Your message has been sent! We will reply within 24 hours!</h5>'; echo '<p class="text-center"><a class="btn btn-base btn-lg text-weight-600 text-uppercase box-shadow-active" href="page-contact-us-2.php">Submit New Form</a></p>'; ?>
                    <?php } else { // show the form ?>

                    <?php if(!empty($errors)){ echo '<div class="alert alert-danger">' .nl2br($errors). '</div>'; } ?>

                    <form method="POST" name="assets/contact_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" placeholder="Name" class="form-control input-lg" name="name" value="<?php  echo htmlentities($name); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" placeholder="Email" class="form-control input-lg" name="email" value="<?php  echo htmlentities($visitor_email); ?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" placeholder="Phone Number" class="form-control input-lg" name="phonenumber" value="<?php  echo htmlentities($phone_number); ?>">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Your Message!</label>
                                    <textarea rows="4" cols=30 placeholder="Your Message!" class="form-control input-lg" name="message"><?php echo htmlentities($user_message); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <img src="assets/contact_form/captcha_code_file.php?rand=<?php  echo rand(); ?>" id='captchaimg'>
                                    <br>
                                    <label for='message'>Enter the code above here :</label>
                                    <br>
                                    <input type="text" id="6_letters_code" name="6_letters_code" class="form-control input-lg">
                                    <small>Can't read the image? click <a class="is-text" href='javascript: refreshCaptcha();'>here</a> to refresh</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" value="Submit" name='submit' class="btn btn-base btn-lg text-weight-600 text-uppercase box-shadow-active">Submit</button>
                    </form>

                    <script language="JavaScript">
                        // Code for validating the form
                        // Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
                        // for details
                        var frmvalidator = new Validator("assets/contact_form");
                        //remove the following two lines if you like error message box popups
                        frmvalidator.EnableOnPageErrorDisplaySingleBox();
                        frmvalidator.EnableMsgsTogether();
                        frmvalidator.addValidation("name", "req", "Please Provide Your Name");
                        frmvalidator.addValidation("email", "req", "Please Provide Your Email");
                        frmvalidator.addValidation("email", "email", "Please Enter a Valid Email address");
                        frmvalidator.addValidation("phonenumber", "req", "Please Provide Your Phone Number");
                    </script>
                    <script language='JavaScript' type='text/javascript'>
                        function refreshCaptcha() {
                            var img = document.images['captchaimg'];
                            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
                        }
                    </script>
                    <?php } ?>
                    <!-- End: FORM -->

                </div>
                <div class="col-md-4 col-sm-4 padding-bottom-medium">
                    <h3 class="page-header text-weight-300">Contact Us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <address> <abbr title="Address"><strong>Address:</strong></abbr><br> 1355 Market Street, Suite 900<br> San Francisco, CA 94103 </address>
                    <address> <abbr title="Phone"><strong>Phone:</strong></abbr><br> (123) 456-7890 </address>
                    <address> <abbr title="Email"><strong>Email:</strong></abbr><br> <a href="mailto:#">info@imax.com</a> </address>
                    <ul class="social-icon base margin-top-small margin-bottom-small">
                        <li><a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Youtube"><i class="fa fa-youtube"></i></a></li>
                        <li><a title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Google"><i class="fa fa-google"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <!-- End: FAQs -
    ################################################################## -->


    <!--
    #################################
        - Begin: FOOTER -
    #################################
    -->
    <footer id="footer" class="dark-bg">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <!-- Begin: WIDGET -->
                        <div class="widget map-bg">
                            <h3 class="widget-title text-weight-700">Contact Us</h3>
                            <address> <abbr title="Address"><strong>Address:</strong></abbr><br> 1355 Market Street, Suite 900<br> San Francisco, CA 94103 </address>
                            <address> <abbr title="Phone"><strong>Phone:</strong></abbr><br> (123) 456-7890 </address>
                            <address> <abbr title="Email"><strong>Email:</strong></abbr><br> <a href="mailto:#">info@imax.com</a> </address>
                        </div>
                        <!-- End: WIDGET -->
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <!-- Begin: WIDGET -->
                        <div class="widget">
                            <div class="list-link">
                                <h3 class="widget-title text-weight-700">Pages</h3>
                                <ul class="list-ul">
                                    <li><i class="fa fa-circle-o"></i><a href="#">Home</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">About Us</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">Services</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">Portfolio</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">Blog</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End: WIDGET -->
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <!-- Begin: WIDGET -->
                        <div class="widget">
                            <div class="list-link">
                                <h3 class="widget-title text-weight-700">Shortcut links</h3>
                                <ul class="list-ul">
                                    <li><i class="fa fa-circle-o"></i><a href="#">ante etiam sit</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">mauris sit</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">Sed consequat</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">idunt duis</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">sit amet orci</a></li>
                                    <li><i class="fa fa-circle-o"></i><a href="#">donec sodales</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End: WIDGET -->
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <!-- Begin: WIDGET -->
                        <div class="widget margin-bottom-small">
                            <h3 class="widget-title text-weight-700">Quick links</h3>
                            <div class="tags">
                                <ul class="list-ul list-inline">
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Office</a> </li>
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Computer</a> </li>
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Picture</a> </li>
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Design</a> </li>
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Animation</a> </li>
                                    <li><a class="btn btn-default btn-sm btn-dark" href="#">Metting</a> </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End: WIDGET -->
                        <!-- Begin: WIDGET -->
                        <div class="widget margin-bottom-small">
                            <h3 class="widget-title text-weight-700">Subscribe</h3>
                            <div class="search">
                                <form class="form-inline">
                                    <div class="form-group form-group-md full-width">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="exampleInputAmount" placeholder="Email">
                                            <div class="input-group-btn"><button type="submit" class="btn btn-base btn-md btn-block text-uppercase text-weight-700"><i class="fa fa-send-o"></i></button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End: WIDGET -->
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2"> <a href="index.html" class="logo"><span><i class="fa fa-info"></i></span> Max</a> </div>
                    <div class="col-md-10 col-sm-10 text-right">
                        <p>&copy; Copyright 2017 by <a href="#">iMax</a>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End: FOOTER -
    ################################################################## -->

    <!-- Begin: BACK TO TOP -->
    <a id="back-to-top" href="#" class="back-to-top btn btn-base">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- End: BACK TO TOP -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    
    <!-- Begin: REQUIRED FOR THIS PAGE ONLY -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVfiG0WBDC223SzY65Rnj8VWZa3myVPoA"></script>			<!-- MAP -->
    <script type="text/javascript" src="assets/js/map/jquery.axgmap.js"></script>										<!-- MAP -->
    <script>
        // Map
        $(document).ready(function ($) {
            $('.is-map').axgmap();
        });
    </script>
    <!-- End: REQUIRED FOR THIS PAGE ONLY -->

</body>
</html>