<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--========== Google fonts  ==========-->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,300,700" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/x-icon" href="curtainssolutions">

	<!--========== Stylesheets  ==========-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<style>
		body {
			font-family: 'Roboto', sans-serif;
			font-size: 14px;
			line-height: 1.5;
			font-weight: 400;
			color: #333333;
			overflow-x: hidden;
			text-rendering: optimizelegibility;
		}


		a {
			text-decoration: none;
		}

		a:hover {
			text-decoration: none;
		}

		a:focus {
			text-decoration: none;
		}

		img {
			max-width: 100%;
		}

		p {
			margin: 0 0 10px;
			color: #888888;
		}

		h1,
		h2,
		h3,
		h4 {
			font-family: 'Roboto slab', serif;
			font-weight: 400;
			text-transform: uppercase;
		}

		h1 {
			font-size: 48px;
		}

		h2 {
			font-size: 28px
		}

		h3 {
			font-size: 24px;
		}

		h4 {
			font-size: 18px;
			line-height: 1.4;
			font-weight: 700;
			letter-spacing: 2px;
			margin: 0 0 10px;
		}

		h5 {
			font-family: 'Roboto slab', serif;
			font-size: 16px;
			line-height: 1.5;
			font-weight: 700;
			letter-spacing: 1px;
			margin: 0 0 10px;
		}

		h6 {
			font-size: 14px;
		}


		.text-center {
			text-align: center;
		}

		.text-left {
			text-align: left;
		}

		.text-right {
			text-align: right;
		}

		.section-title {
			text-align: center;
			margin-bottom: 80px;
		}

		.section-title h3 {
			display: inline-block;
			font-size: 36px;
			line-height: 46px;
			font-weight: 300;
			margin: 0 0 20px;
			text-transform: uppercase;
			letter-spacing: 2px;
		}

		.section-title .red-bold {
			color: #a12d23;
			font-weight: 700;
			text-shadow: 1px 1px 1px rgba(0, 0, 0, .15);
		}

		.black-border,
		.white-border {
			position: relative;
		}

		.black-border:before,
		.white-border:before {
			position: absolute;
			content: "";
			bottom: 0px;
			left: 0;
			width: 100%;
			height: 2px;
		}

		.black-border:before {
			background-color: #262522;
		}

		.white-border:before {
			background-color: #ffffff;
		}


		.red-border {
			position: relative;
			height: 100%;
			display: inline-block;
		}

		.red-border:before {
			position: absolute;
			content: "";
			bottom: 0px;
			left: 0;
			width: 100%;
			height: 2px;
			background-color: #a12d23;
		}

		.white-border .red-border {
			color: #ffffff;
		}

		.error {
			color: #FB2E1C;
		}

		.container {
			/*max-width: 1000px;*/
		}

		.home-overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, .2);
			z-index: 1;
		}

		/*--------------- Header ----------------*/
		.header {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 70px;
			background: #222 url('{{ asset('frontend/') }}/header-bg.png') left top/cover no-repeat;
			box-shadow: 0px 10px 0px rgba(161, 45, 35, 0.3);
			z-index: 999;
		}

		.site-logo img {
			height: 42px;
			width: auto;
			margin: 14px 0;
		}

		.nav-container {
			padding-right: 0;
		}

		.navigation {
			list-style: none;
			height: 70px;
			float: right;
		}

		.navigation li {
			display: inline-block;
		}

		.navigation li a {
			font-family: 'Roboto Slab', serif;
			padding: 24.5px 20px;
			line-height: 70px;
			color: #fff;

			-webkit-transition: all .3s ease-in;
			-moz-transition: all .3s ease-in;
			-ms-transition: all .3s ease-in;
			-o-transition: all .3s ease-in;
			transition: all .3s ease-in;
		}

		.navigation li a:hover {
			color: #f6f6f6;
			background-color: rgba(0, 0, 0, .3);
		}


		/*--------------- End Header ----------------*/

		/*--------------- Home ----------------*/
		.home-wrap {
			position: relative;

			min-height: 610px;
		}

		.images {
			width: 100%;
			height: 400px;
			object-fit: cover;
		}

		.counter-wrap {
			position: relative;
			z-index: 10;
		}

		.counter {
			max-width: 450px;
			color: #fff;
			margin: 210px auto 0;
			overflow: hidden;
		}

		.countdown .count-int {
			font-family: 'Roboto slab', serif;
			display: block;
			font-size: 48px;
			font-weight: 300;
		}

		.countdown .count-text {
			font-size: 16px;
		}

		.banner-wrap {
			background: url('{{ asset('frontend/') }}/banner-bg.png') center center/cover no-repeat;
			position: relative;
			width: 100%;
			height: 300px;
			margin-top: 0px;
			overflow: hidden;
			z-index: 10;
		}

		.banner-left {
			color: #fff;
			padding: 80px 60px 0 0;
		}

		.welcome-text {
			font-size: 55px;
			line-height: 55px;
			font-weight: 300;
			text-transform: uppercase;
			letter-spacing: 2px;
			text-shadow: 1px 1px 1px rgba(0, 0, 0, .6);
			margin: 0;
			margin-bottom: 20px;
		}

		.welcome-text span {
			color: #a12d23;
			font-weight: 700;
		}

		.subtitle {
			font-size: 18px;
			margin: 0;
			font-weight: 300;
		}

		.banner-right {
			padding: 80px 0 0 90px;
		}

		.newsletter-title {
			font-size: 24px;
			color: #494849;
			margin: 0;
			text-transform: uppercase;
			text-shadow: 1px 1px 1px rgba(0, 0, 0, .1);
		}

		.newsletter-title span {
			color: #a12d23;
			font-weight: 700;
		}



		.subscription-success,
		.subscription-failed {
			padding-top: 10px;
			display: none;
		}

		/*--------------- End Home ----------------*/

		/*--------------- About and features ----------------*/
		.about-wrap {
			padding: 100px 0;
			background-color: #fff;
		}



		.tab-nav {
			list-style: none;
			border-bottom: 2px solid #a12d23;
			margin-bottom: 20px;
		}

		.tab-nav li {
			display: inline-block;
		}

		.tab-nav li a {
			display: inline-block;
			padding: 10px 20px;
			color: #333;
			text-transform: uppercase;
			font-weight: 500;
			letter-spacing: 1px;

			-webkit-transition: all .15s ease;
			-moz-transition: all .15s ease;
			-ms-transition: all .15s ease;
			-o-transition: all .15s ease;
			transition: all .15s ease;
		}

		.tab-selected a {
			display: inline-block;
			background-color: #a12d23;
			color: #fff !important;
		}

		.tab {
			display: none;
			padding-left: 20px;

		}

		.tab h4 {
			letter-spacing: 1px;
		}

		.one {
			display: block;
		}

		.list-items {
			padding: 10px 0px 10px 15px;
			list-style: none;
			color: #888888;
		}

		.list-items li {
			font-size: 15px;
			margin-bottom: 5px;
			font-weight: 400;
			color: #666;
		}

		.list-items li span {
			color: #a12d23;
			margin-right: 7px;
		}

		.feature {
			overflow: hidden;
			padding: 10px 0;
		}

		.feature-icon {
			display: inline-block;
			float: left;
			text-align: center;
			height: 64px;
			width: 64px;
			background-color: #a12d23;
		}

		.feature-icon i {
			font-size: 32px;
			line-height: 64px;
			color: #fff;
		}

		.feature-desc {
			max-width: 386px;
			width: 85%;
			float: left;
			padding-left: 15px;
		}

		.feature h5 {
			text-transform: uppercase;
			line-height: 1.1;
			margin-bottom: 8px;
		}

		.feature p {
			margin: 0;
		}

		/*--------------- End About and features ----------------*/

		/*--------------- Services ----------------*/
		.services-wrap {
			padding: 100px 0 40px;
			border-top: 1px solid #eee;
			background-color: #f8fafb;
		}


		.service {
			padding-bottom: 60px;
		}

		.service .icon {
			margin-bottom: 13px;
		}

		.service .icon i {
			font-size: 36px;
			color: #a12d23;
		}

		/*--------------- End Services ----------------*/

		/*--------------- Achievement ----------------*/
		.achievement-wrap {
			position: relative;
			padding: 100px 0;
			background: url('{{ asset('frontend/') }}/achievement-bg.jpg') center center no-repeat;
		}

		.achievement-overlay {
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: rgba(0, 0, 0, .80);
			z-index: 1;
		}

		.achievement-wrap .container {
			position: relative;
			z-index: 10;
		}

		.achievement {
			font-family: 'Roboto slab', serif;
			font-size: 42px;
			font-weight: 700;
			color: #ffffff;
		}

		.achievement span {
			font-size: 13px;
			letter-spacing: 1px;
			text-transform: uppercase;
		}

		/*--------------- End Achievement ----------------*/

		/*--------------- Contact ----------------*/
		.contact-wrap {
			padding: 100px 0 60px;
		}

		.form-item {
			position: relative;
			border-bottom: 2px solid #a12d23;
			padding: 14px 0px 6px 30px;
			margin-bottom: 10px;
		}

		.input-icon {
			position: absolute;
			top: 16px;
			left: 0;
		}

		.input-icon i {
			font-size: 16px;
			color: #a12d23;
		}

		.form-input {
			border: 0;
			border-radius: 0;
			background: transparent;
			width: 100%;
		}

		.form-submit {
			overflow: hidden;
			font-size: 16px;
			color: #ffffff;
			background-color: #a12d23;
			border: 0;
			border-radius: 2px;
			height: 44px;
			padding: 10px 20px;
			margin: 10px 0;
			letter-spacing: 1px;
			text-transform: uppercase;

			-webkit-transition: all .5s ease;
			-moz-transition: all .5s ease;
			-ms-transition: all .5s ease;
			-o-transition: all .5s ease;
			transition: all .5s ease;
		}

		.form-submit span {
			margin-right: 10px;
		}

		.form-submit:hover span {
			-webkit-animation: fly 1s forwards;
		}

		.sending {
			position: relative;
			background-color: #fff;
			border: 1px solid #ccc;
		}

		.sending:before {
			position: absolute;
			top: 10px;
			left: calc(50% - 9px);
			content: "\f110";
			color: #000;
			font: normal normal normal 16px/1 FontAwesome;
			text-rendering: auto;
			font-size: 21px;
			-webkit-font-smoothing: antialiased;

			-webkit-animation: fa-spin 1s infinite linear;
			-moz-animation: fa-spin 1s infinite linear;
			-o-animation: fa-spin 1s infinite linear;
			animation: fa-spin 1s infinite linear;
		}

		.success-msg {
			display: none;
		}

		.address-wrap {
			padding-top: 15px;
		}

		.address-item {
			width: 100%;
			overflow: hidden;
			margin-bottom: 40px;
		}

		.address-icon {
			display: inline-block;
			text-align: center;
			float: left;
			height: 44px;
			width: 44px;
			background-color: #a12d23;
		}

		.address-icon i {
			font-size: 24px;
			line-height: 44px;
			color: #ffffff;
		}

		.address-desc {
			max-width: 426px;
			float: left;
			padding-left: 15px;
		}

		.address-desc h4 {
			line-height: 1.1;
			margin-bottom: 8px;
		}

		.address-desc p {
			margin: 0;
			line-height: 1.1;
		}

		/*--------------- End Contact ----------------*/

		/*--------------- Footer ----------------*/
		.footer-wrap {
			padding: 40px 0;
		}

		.copyright-text span {
			font-weight: 500;
			color: #666;
		}

		/*--------------- End Footer ----------------*/


		/*-------====== Media Quaries ======--------*/
		@media (max-width: 992px) {

			/*---------- Header ------------*/
			.header {
				height: auto;
				background: transparent;
			}

			.header-container {
				width: 100%;

			}

			.scrolling {
				-webkit-animation: frombottom .3s forwards;
				-moz-animation: frombottom .3s forwards;
				-o-animation: frombottom .3s forwards;
				animation: frombottom .3s forwards;
			}

			.site-logo {
				text-align: center;
				background-color: #a12d23;
			}

			.nav-container {
				background-color: #262522;
			}

			.navigation {
				float: none;
				height: auto;
			}

			.navigation li a {
				padding: 19.5px 20px;
				line-height: 60px;
			}

			.navigation li a:hover {
				color: #A12D23;
				background-color: transparent;
			}

			.social-container {
				background-color: #262522;
			}

			.socials {
				float: none;
			}

			.socials li {
				padding: 8px 0px 23px;
			}

			/*---------- home ------------*/
			.counter {
				margin: 310px auto 0;
			}

			.banner-wrap {
				height: auto;
				background: transparent;
			}

			.banner-container {
				width: 100%;
			}

			.banner-left {
				background-color: #262522;
				padding: 60px 0;
			}

			.banner-right {
				background-color: #F3F4F2;
				padding: 60px 0;
			}

			/*---------- About and Features ------------*/
			.image-slider {
				margin-bottom: 60px;
			}


			/*---------- Achievement ------------*/
			.achievement-box {
				margin-bottom: 40px;
			}

			/*---------- Contact ------------*/
			.address-wrap {
				padding-bottom: 20px;
			}

		}

		@media (max-width: 767px) {
			.images {
				width: 100%;
				height: 210px;
				object-fit: cover;
			}

			.welcome-text {
				font-size: 40px;
				line-height: 45px;
				font-weight: 300;
				text-transform: uppercase;
				letter-spacing: 2px;
				text-shadow: 1px 1px 1px rgba(0, 0, 0, .6);
				margin: 0;
				margin-bottom: 20px;
			}

			.subtitle {
				font-size: 14px;
				margin: 0;
				font-weight: 300;
			}
		}

		.coming_logo {
			color: #fff;
			font-size: 24px;
			letter-spacing: 1px;
			line-height: 67px;
		}
		@media (max-width: 576px) {
		    .coming_logo {
			    font-size: 22px;
		    }
		
		}
	</style>
</head>

<body>

	<!-- Start Header -->
	<div class="header">
		<div class="container header-container">
			<div class="row">
				<!-- Start logo -->
				<div class="col-md-8 site-logo">
					<a href="#" class="coming_logo">Blinds & Curtains Solution Fzc</a>
				</div>
				<!-- End site-logo-->
				<!-- Start nav-container -->
				<div class="col-md-3 nav-container text-center">
				</div>
				<!-- End nav-container -->
				<div class="col-md-1 social-container text-center">
				</div>
				<!-- End social-container -->
			</div>
			<!-- End Row -->
		</div>
		<!-- End container -->
	</div>
	<!-- End header -->

	<!-- Start section-home -->
	<section id="section-home" class="home-wrap">
		<img class="images" src="{{ asset('frontend/') }}/bg.jpg" alt="">
		<div class="home-overlay"></div>

		<div class="container">
			<!-- Start counter -->
			<div class="col-md-12 counter-wrap text-center">

			</div>
			<!-- Start counter -->
		</div>
		<!-- End container -->

		<!-- Start banner-wrap -->
		<div class="banner-wrap">
			<div class="container banner-container">
				<div class="row">
					<!-- Start banner-left -->
					<div class="col-md-6 col-12 banner-left  text-center">
						<h2 class="welcome-text">We'll Be Back<span>soon</span></h2>
						<span class="subtitle mt-3">Our website is temporarily down for maintenance. For urgent
							inquiries, please connect with us on WhatsApp at +971 56 127 8800.</span>
					</div>
					<!-- End banner-left -->

					<!-- Start banner-right -->
					<div class="col-md-6 col-12 banner-right text-center">
						<h4 class="newsletter-title">WhatsApp<span>+971 56 127 8800</span></h4>
						<!-- Start mailchimp form -->
						<form id="mailchimp-form">
							<div>
								<span>Thank you for your understanding.</span>
							</div>
							<h4 class="newsletter-title" style="margin-top: 20px;">*Blinds & Curtains Solution FZC*</h4>
						</form>
						<!-- End mailchimp form -->
						<div class="subscription-success"></div>
						<div class="subscription-failed"></div>
					</div>
					<!-- End banner-right -->
				</div>
				<!-- End row -->
			</div>
			<!-- End banner-container -->
		</div>
		<!-- End banner-wrap -->
	</section>
	<!-- End section-home -->
	<!--========= Js files =========-->


</body>

</html>