<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the page title -->
	<title>E-Learning | Landing Page Template</title>
	<!-- inlcude google nunito sans font cdn link -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<!-- inlcude google roboto font cdn link -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<!-- inlcude google jost font cdn link -->
	<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<!-- inlcude google poppins font cdn link -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="{{asset('educa/css/bootstrap.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{asset('educa/style.css')}}">
	<!-- include theme color setting stylesheet -->
	<link rel="stylesheet" href="{{asset('educa/css/colors.css')}}">
	<!-- include the site responsive stylesheet -->
	<link rel="stylesheet" href="{{asset('educa/css/responsive.css')}}">
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- phStickyWrap -->
		<div class="phStickyWrap">
			<!-- pageHeader -->
			<header id="pageHeader" class="py-2 py-lg-4 py-xl-6 headerFixer">
				<div class="container">
					<!-- pageNav -->
					<nav id="pageNav" class="navbar navbar-expand-md navbar-dark border-0 p-0 rounded-0">
						<!-- logo -->
						<div class="logo flex-shrink-0 mr-3">
							<a href="{{url('/')}}">
								<img src="{{asset('educa/images/logo.png')}}" class="img-fluid" alt="E-Learning | Online Learning">
							</a>
						</div>
						<!-- pageMainNavCollapse -->
						<div class="collapse navbar-collapse justify-content-end pageMainNavCollapse" id="pageMainNavCollapse">
							<!-- mainNavigation -->
							<ul class="navbar-nav mainNavigation fontAlter">
								<li class="nav-item active">
									<a class="nav-link" href="#scrollToIntroBlock">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#scrollToAboutUs">About Us</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#scrollToOurCourses">Our Courses</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#scrollToOurTeam">Our Team</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#scrollToOurStudents">Our Students</a>
								</li>
							</ul>
							<a  class="nav-link" href="{{url('/login')}}">Login / Signup</a>
						</div>
						<!-- pageNavOpener -->
						<button class="navbar-toggler pageNavOpener position-relative" type="button" data-toggle="collapse" data-target="#pageMainNavCollapse" aria-controls="pageMainNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>
				</div>
			</header>
		</div>
		<main>
			<!-- scrollToIntroBlock -->
			<div id="scrollToIntroBlock" class="mt-n12 pt-12 mt-lg-n16 pt-lg-16 mt-xl-n20 pt-xl-20">
				<!-- introBlock -->
				<section class="introBlock d-flex w-100 bgCover text-center position-relative text-white" style="background-image: url({{asset('educa/images/img01.jpg')}});">
					<div class="alignHolder w-100 d-flex align-items-center">
						<div class="align w-100 pt-20 pt-md-24 pt-lg-30 pt-xl-38 pb-3 pb-md-10">
							<div class="container position-relative">
								<div class="mxterWrap mx-auto">
									<div class="wow fadeInDown">
										<h1 class="text-white text-uppercase mb-3">
											<span class="d-block headingTitle mb-1">Learn with us</span>
											<span class="d-block">Study with experts</span>
										</h1>
									</div>
									<div class="wow fadeInDown" data-wow-delay="0.5s">
										<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
									</div>
									<a href="javascript:void(0);" class="btn btnTheme position-relative border-0 p-0 mt-4 wow bounceIn" data-wow-delay="1s" data-hover="Grab Your Course">
										<span class="d-block btnText">Grab Your Course</span>
									</a>
								</div>
								<div class="position-relative catsWrap mx-auto mt-6 mt-md-0 wow flipInX" data-wow-delay="1.5s">
									<strong class="arrowTag arrowTag01 fontThird mb-4 mb-md-0 d-block">We provide many types of courses <span class="artgArrow1 position-absolute d-none d-md-block"><img src="{{asset('educa/images/arrow1.png')}}" alt="arrow"></span></strong>
									<div class="row d-block mt-md-14">
										<!-- ourCategorySlider -->
										<div class="ourCategorySlider">
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-internet"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Data Analysis</a>
																</h2>
																<strong class="cbcTag position-absolute bg-purple text-white rounded font-weight-normal">+15</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-fingerprint"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Graphic Design</a>
																</h2>
																<strong class="cbcTag position-absolute bg-warning text-white rounded font-weight-normal">+23</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-smartphone-6"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Mobile App</a>
																</h2>
																<strong class="cbcTag position-absolute bg-success text-white rounded font-weight-normal">+23</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-photo-camera"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Photography</a>
																</h2>
																<strong class="cbcTag position-absolute bg-info text-white rounded font-weight-normal">+12</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-fingerprint"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Graphic Design</a>
																</h2>
																<strong class="cbcTag position-absolute bg-warning text-white rounded font-weight-normal">+23</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div>
												<div class="col-12">
													<!-- catBoxColumn -->
													<div class="catBoxColumn position-relative rounded d-flex align-items-center justify-content-center w-100 mb-6">
														<div class="alignHolder d-flex w-100 align-items-center">
															<div class="align w-100">
																<i class="icnWrap d-flex align-items-center justify-content-center fi mb-3 flaticon-smartphone-6"><span class="sr-only">icon</span></i>
																<h2 class="text-white mb-0">
																	<a href="javascript:void(0);">Mobile App</a>
																</h2>
																<strong class="cbcTag position-absolute bg-success text-white rounded font-weight-normal">+23</strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- scrollToAboutUs -->
			<div id="scrollToAboutUs" class="mt-n12 pt-12 mt-lg-n16 pt-lg-16 mt-xl-n20 pt-xl-20">
				<!-- aboutUsBlock -->
				<article class="aboutUsBlock pt-7 pt-md-15 pt-lg-20 pt-xl-29">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-6 order-md-2 wow slideInRight" data-wow-delay="0.5s">
								<!-- headingHead -->
								<header class="headingHead hasPattern mb-6 mb-xl-9 position-relative pb-4">
									<h2 class="mb-4">
										<strong class="font-weight-normal d-block headTitle mb-2">About Us</strong>
										<span class="d-block">We provide many types of courses</span>
									</h2>
									<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
								</header>
								<!-- featuresList -->
								<ul class="list-unstyled featuresList d-flex flex-wrap">
									<li>Online Education</li>
									<li>Hands on Research</li>
									<li>Unlimited Access</li>
									<li>Detiacted to Your Success</li>
									<li>Certified Teachers</li>
									<li>Classic Experience</li>
								</ul>
							</div>
							<div class="col-12 col-md-6 order-md-1 d-flex align-items-end wow slideInLeft" data-wow-delay="0.5s">
								<!-- imgHolder  -->
								<div class="imgHolder position-relative mt-4 mt-md-n9 mx-auto mx-md-0">
									<span class="wrap overflow-hidden d-block ml-11 ml-lg-21">
										<img src="{{asset('educa/images/img02.jpg')}}" class="img-fluid" alt="image description">
									</span>
									<span class="elemsWrap position-absolute">
										<img src="{{asset('educa/images/pattern01.png')}}" class="img-fluid" alt="image description">
									</span>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
			<!-- scrollToOurCourses -->
			<div id="scrollToOurCourses" class="mt-n12 pt-12 mt-lg-n16 pt-lg-16 mt-xl-n20 pt-xl-20">
				<!-- coursesBlock -->
				<section class="bg-light coursesBlock pt-7 pb-3 pt-md-10 pb-md-6 pt-lg-13 pb-lg-10 pt-xl-19 pb-xl-14" style="background-image: url(images/pattern04.png);">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-8 offset-md-2 col-xl-6 offset-xl-3 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
								<!-- headingHead -->
								<header class="headingHead hasPattern mb-8 mb-lg-12 position-relative pb-4 text-center">
									<h2 class="mb-4">
										<strong class="font-weight-normal d-block headTitle mb-2">Our Courses</strong>
										<span class="d-block">We provide alot of courses</span>
									</h2>
									<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
								</header>
							</div>
						</div>
						<div class="row justify-content-center wow fadeInDown" data-wow-duration="1s" data-wow-delay="1s">
							<div class="col-12 col-md-4 d-md-flex">
								<!-- postColumn -->
								<article class="postColumn position-relative overflow-hidden rounded-lg d-flex w-100 flex-column bg-white mb-6 p-4 p-lg-8 mx-auto mx-md-0">
									<div class="heitherWrap flex-grow-1">
										<strong class="pColumnTag rounded-lg position-absolute text-white fontAlter">Free</strong>
										<div class="imgHolder mb-4 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
											<img src="{{asset('educa/images/img03.jpg')}}" class="img-fluid w-100" alt="image description">
										</div>
										<header class="pColumnHead mb-4">
											<h3 class="mb-2">
												<a href="javascript:void(0);">Basic Marketing</a>
											</h3>
											<h4>Mark Smith</h4>
										</header>
										<p>This should be used to tell a story and let your users know more about your service. How can you benefit them?</p>
									</div>
									<footer class="pColumnFoot fontAlter mt-2 pt-3">
										<ul class="list-unstyled d-flex flex-wrap mb-0 align-items-center">
											<li>
												<a href="javascript:void(0);">
													<i class="far fa-file-video icn mr-1"><span class="sr-only">icon</span></i>
													12 Lessons
												</a>
											</li>
											<li>
												<i class="far fa-clock icn mr-1"><span class="sr-only">icon</span></i>
												18 Hours
											</li>
										</ul>
									</footer>
								</article>
							</div>
							<div class="col-12 col-md-4 d-md-flex">
								<!-- postColumn -->
								<article class="postColumn position-relative overflow-hidden rounded-lg d-flex w-100 flex-column bg-white mb-6 p-4 p-lg-8 mx-auto mx-md-0">
									<div class="heitherWrap flex-grow-1">
										<strong class="pColumnTag rounded-lg position-absolute text-white fontAlter">$30</strong>
										<div class="imgHolder mb-4 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
											<img src="{{asset('educa/images/img04.jpg')}}" class="img-fluid w-100" alt="image description">
										</div>
										<header class="pColumnHead mb-4">
											<h3 class="mb-2">
												<a href="javascript:void(0);">Business English</a>
											</h3>
											<h4>Vera Duncan</h4>
										</header>
										<p>This should be used to tell a story and let your users know more about your service. How can you benefit them?</p>
									</div>
									<footer class="pColumnFoot fontAlter mt-2 pt-3">
										<ul class="list-unstyled d-flex flex-wrap mb-0 align-items-center">
											<li>
												<a href="javascript:void(0);">
													<i class="far fa-file-video icn mr-1"><span class="sr-only">icon</span></i>
													12 Lessons
												</a>
											</li>
											<li>
												<i class="far fa-clock icn mr-1"><span class="sr-only">icon</span></i>
												25 Hours
											</li>
										</ul>
									</footer>
								</article>
							</div>
							<div class="col-12 col-md-4 d-md-flex">
								<!-- postColumn -->
								<article class="postColumn position-relative overflow-hidden rounded-lg d-flex w-100 flex-column bg-white mb-6 p-4 p-lg-8 mx-auto mx-md-0">
									<div class="heitherWrap flex-grow-1">
										<strong class="pColumnTag rounded-lg position-absolute text-white fontAlter">$30</strong>
										<div class="imgHolder mb-4 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
											<img src="{{asset('educa/images/img05.jpg')}}" class="img-fluid w-100" alt="image description">
										</div>
										<header class="pColumnHead mb-4">
											<h3 class="mb-2">
												<a href="javascript:void(0);">IT Foundations</a>
											</h3>
											<h4>Cooper Moore</h4>
										</header>
										<p>This should be used to tell a story and let your users know more about your service. How can you benefit them?</p>
									</div>
									<footer class="pColumnFoot fontAlter mt-2 pt-3">
										<ul class="list-unstyled d-flex flex-wrap mb-0 align-items-center">
											<li>
												<a href="javascript:void(0);">
													<i class="far fa-file-video icn mr-1"><span class="sr-only">icon</span></i>
													20 Lessons
												</a>
											</li>
											<li>
												<i class="far fa-clock icn mr-1"><span class="sr-only">icon</span></i>
												11 Hours
											</li>
										</ul>
									</footer>
								</article>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- completionBlock -->
			<section class="completionBlock position-relative bg-dark text-white pt-12 pb-2 pt-md-22 pb-md-22 overflow-hidden">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-6 wow slideInLeft" data-wow-delay="0.5s">
							<!-- vidWrap -->
							<div class="vidWrap position-relative overflow-hidden rounded-lg mx-auto mx-lg-0 mb-6 mb-md-0">
								<a href="https://www.youtube.com/watch?v=NNamZZsggM4" data-fancybox>
									<img src="{{asset('educa/images/img06.jpg')}}"  class="img-fluid w-100 rounded-lg" alt="image description">
									<span class="icnPlay position-absolute d-flex align-items-center justify-content-center rounded-circle text-dark">
										<i class="fas fa-play"><span class="sr-only">icon</span></i>
									</span>
									<strong class="arrowTag text-center arrowTag02 fontThird mb-4 mb-md-0 d-block position-absolute">Watch Overview in 40 Second <span class="artgArrow2 position-absolute d-none d-md-block"><img src="images/arrow2.png" alt="arrow"></span></strong>
								</a>
							</div>
						</div>
						<div class="col-12 col-lg-6 d-flex wow slideInRight" data-wow-delay="0.5s">
							<!-- countListItems -->
							<ul class="list-unstyled countListItems d-flex flex-wrap align-items-center flex-grow-1 pt-md-16">
								<li>
									<!-- countColumn -->
									<div class="countColumn type1">
										<h2 class="fontFourth mb-5"><span class="dataCount">265</span>+</h2>
										<h3>Complete Courses</h3>
										<p>This should be used to tell a story and let your users know more about your service. How can you benefit them?</p>
									</div>
								</li>
								<li>
									<!-- countColumn -->
									<div class="countColumn type2">
										<h2 class="fontFourth mb-5"><span class="dataCount">98</span>%</h2>
										<h3>Students Satisfection</h3>
										<p>This should be used to tell a story and let your users know more about your service. How can you benefit them?</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<span class="bgMap position-absolute inaccessible">
					<img src="{{asset('educa/images/img07.png')}}" class="img-fluid" alt="map">
				</span>
				<span class="ronder rouder1 inaccessible position-absolute">
					<img src="{{asset('educa/images/pattern05.png')}}" alt="image">
				</span>
				<span class="ronder rouder2 inaccessible position-absolute">
					<img src="{{asset('educa/images/pattern06.png')}}" alt="image">
				</span>
			</section>
			<!-- scrollToOurTeam -->
			<div id="scrollToOurTeam" class="mt-n12 pt-12 mt-lg-n16 pt-lg-16 mt-xl-n20 pt-xl-20">
				<!-- teamBlock -->
				<section class="teamBlock pt-6 pb-3 pt-md-9 pb-md-6 pt-lg-13 pb-lg-10 pt-xl-19 pb-xl-14">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-8 offset-md-2 col-xl-6 offset-xl-3 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
								<!-- headingHead -->
								<header class="headingHead hasPattern mb-8 mb-lg-12 position-relative pb-4 text-center">
									<h2 class="mb-4">
										<strong class="font-weight-normal d-block headTitle mb-2">Our Team</strong>
										<span class="d-block">The Best Tutors in Town</span>
									</h2>
									<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
								</header>
							</div>
						</div>
						<div class="row justify-content-center wow fadeInDown" data-wow-duration="1s" data-wow-delay="1s">
							<div class="col-12 col-md-4">
								<!-- teamColumn -->
								<article class="teamColumn rounded overflow-hidden position-relative bg-light p-4 p-lg-8 mb-6 mx-auto mx-md-0">
									<div class="imgHolder mb-5 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
										<img src="{{asset('educa/images/img08.jpg')}}"  class="w-100 img-fluid" alt="image description">
									</div>
									<h3 class="mb-1">
										<a href="javascript:void(0);">Mark Smith</a>
									</h3>
									<h4 class="mb-0">Designer</h4>
								</article>
							</div>
							<div class="col-12 col-md-4">
								<!-- teamColumn -->
								<article class="teamColumn rounded overflow-hidden position-relative bg-light p-4 p-lg-8 mb-6 mx-auto mx-md-0">
									<div class="imgHolder mb-5 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
										<img src="{{asset('educa/images/img09.jpg')}}"  class="w-100 img-fluid" alt="image description">
									</div>
									<h3 class="mb-1">
										<a href="javascript:void(0);">Vera Duncan</a>
									</h3>
									<h4 class="mb-0">Web Developer</h4>
								</article>
							</div>
							<div class="col-12 col-md-4">
								<!-- teamColumn -->
								<article class="teamColumn rounded overflow-hidden position-relative bg-light p-4 p-lg-8 mb-6 mx-auto mx-md-0">
									<div class="imgHolder mb-5 mb-lg-7 mx-n4 mt-n4 mx-lg-n8 mt-lg-n8">
										<img src="{{asset('educa/images/img10.jpg')}}"  class="w-100 img-fluid" alt="image description">
									</div>
									<h3 class="mb-1">
										<a href="javascript:void(0);">Bryce Vaughn</a>
									</h3>
									<h4 class="mb-0">Professor</h4>
								</article>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- scrollToOurStudents -->
			<div id="scrollToOurStudents" class="mt-n12 pt-12 mt-lg-n16 pt-lg-16 mt-xl-n20 pt-xl-20">
				<!-- studentsBlock -->
				<section class="studentsBlock bg-light pt-7 pb-5 pt-md-10 pb-md-9 pt-lg-14 pb-lg-12 pt-xl-19 pb-xl-17" style="background-image: url(images/pattern04.png);">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-8 offset-md-2 col-xl-6 offset-xl-3 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
								<!-- headingHead -->
								<header class="headingHead hasPattern mb-8 mb-lg-12 position-relative pb-4 text-center">
									<h2 class="mb-4">
										<strong class="font-weight-normal d-block headTitle mb-2">Our Students</strong>
										<span class="d-block">Students Satisfection</span>
									</h2>
									<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
								</header>
							</div>
						</div>
						<div class="row d-block wow fadeInDown" data-wow-duration="1s" data-wow-delay="1s">
							<!-- studentsSaySlider -->
							<div class="studentsSaySlider">
								<div>
									<div class="col-12">
										<!-- sayQuote -->
										<blockquote class="sayQuote position-relative pl-10">
											<div class="imgHolder rounded-circle position-absolute">
												<img src="{{asset('educa/images/img11.jpg')}}"  class="img-fluid rounded-circle" alt="image">
												<i class="fas fa-quote-left icnQuote rounded-circle d-flex align-items-center justify-content-center position-absolute"><span class="sr-only">icon</span></i>
											</div>
											<div class="bg-white d-flex flex-wrap wrap">
												<q>This should be used to tell a story and include any testimonials you might have about your product or service for your clients</q>
												<cite>
													<strong class="h d-block h3 mb-1">Mark Smith</strong>
													<strong class="d-block subtitle">Envato Inc</strong>
												</cite>
											</div>
										</blockquote>
									</div>
								</div>
								<div>
									<div class="col-12">
										<!-- sayQuote -->
										<blockquote class="sayQuote position-relative pl-10">
											<div class="imgHolder rounded-circle position-absolute">
												<img src="{{asset('educa/images/img12.jpg')}}"  class="img-fluid rounded-circle" alt="image">
												<i class="fas fa-quote-left icnQuote rounded-circle d-flex align-items-center justify-content-center position-absolute"><span class="sr-only">icon</span></i>
											</div>
											<div class="bg-white d-flex flex-wrap wrap">
												<q>This should be used to tell a story and include any testimonials you might have about your product or service for your clients</q>
												<cite>
													<strong class="h d-block h3 mb-1">Vera Duncan</strong>
													<strong class="d-block subtitle">PayPal Inc</strong>
												</cite>
											</div>
										</blockquote>
									</div>
								</div>
								<div>
									<div class="col-12">
										<!-- sayQuote -->
										<blockquote class="sayQuote position-relative pl-10">
											<div class="imgHolder rounded-circle position-absolute">
												<img src="{{asset('educa/images/img11.jpg')}}"class="img-fluid rounded-circle" alt="image">
												<i class="fas fa-quote-left icnQuote rounded-circle d-flex align-items-center justify-content-center position-absolute"><span class="sr-only">icon</span></i>
											</div>
											<div class="bg-white d-flex flex-wrap wrap">
												<q>This should be used to tell a story and include any testimonials you might have about your product or service for your clients</q>
												<cite>
													<strong class="h d-block h3 mb-1">Mark Smith</strong>
													<strong class="d-block subtitle">Envato Inc</strong>
												</cite>
											</div>
										</blockquote>
									</div>
								</div>
								<div>
									<div class="col-12">
										<!-- sayQuote -->
										<blockquote class="sayQuote position-relative pl-10">
											<div class="imgHolder rounded-circle position-absolute">
												<img src="{{asset('educa/images/img12.jpg')}}"  class="img-fluid rounded-circle" alt="image">
												<i class="fas fa-quote-left icnQuote rounded-circle d-flex align-items-center justify-content-center position-absolute"><span class="sr-only">icon</span></i>
											</div>
											<div class="bg-white d-flex flex-wrap wrap">
												<q>This should be used to tell a story and include any testimonials you might have about your product or service for your clients</q>
												<cite>
													<strong class="h d-block h3 mb-1">Vera Duncan</strong>
													<strong class="d-block subtitle">PayPal Inc</strong>
												</cite>
											</div>
										</blockquote>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- grabBlock -->
			<section class="grabBlock text-center position-relative bg-cover text-white d-flex w-100 bgCover" style="background-image: url({{asset('educa/images/img13.jpg')}});">
				<div class="align-holder positon-relative d-flex w-100 align-items-center">
					<div class="align w-100 py-6">
						<div class="container">
							<div class="row">
								<div class="col-12 col-md-8 offset-md-2 col-xl-6 offset-xl-3">
									<!-- headingHead -->
									<header class="headingHead wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
										<h2 class="mb-3 h1 text-white text-uppercase">
											<strong class="d-block fwSemi headTitle mb-1 text-white">Learn easier</strong>
											<span class="d-block">We Can Teach You!</span>
										</h2>
										<p>This should be used to tell a story and let your users know a little more about your product or service. How can you benefit them?</p>
										<a href="javascript:void(0);" class="btn btnTheme position-relative border-0 p-0 mt-4" data-hover="Grab Your Course">
											<span class="d-block btnText">Grab Your Course</span>
										</a>
										<strong class="arrowTag text-center arrowTag03 mt-6 fontThird mb-4 mb-md-0 d-block position-relative mx-auto"><i class="fas fa-info-circle d-block mb-2"><span class="sr-only">icon</span></i>We provide  many types of courses <span class="artgArrow3 position-absolute d-none d-md-block"><img src="{{asset('educa/images/arrow2.png')}}" alt="arrow"></span></strong>
									</header>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!-- ftAreaWrap -->
		<div class="ftAreaWrap bg-light">
			<!-- pageFooter -->
			<footer id="pageFooter" class="pt-28 text-center text-md-left pb-7 pt-md-11 pb-lg-10 pt-xl-17 pb-xl-16 position-relative">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-3 order-md-2">
							<!-- ftNav -->
							<nav class="ftNav">
								<h3 class="mb-7">Help Center</h3>
								<ul class="list-unstyled">
									<li>
										<a href="javascript:void(0);">Our Company</a>
									</li>
									<li>
										<a href="javascript:void(0);">Our Location</a>
									</li>
									<li>
										<a href="javascript:void(0);">Support Center</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-12 col-md-3 order-md-3">
							<!-- ftNav -->
							<nav class="ftNav">
								<h3 class="mb-7">Our Courses</h3>
								<ul class="list-unstyled">
									<li>
										<a href="javascript:void(0);">Basic Marketing</a>
									</li>
									<li>
										<a href="javascript:void(0);">Business English</a>
									</li>
									<li>
										<a href="javascript:void(0);">IT Foundations</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-12 col-md-3 order-md-4">
							<h3 class="mb-7">Social Media</h3>
							<!-- ftSocialNetworks -->
							<ul class="list-unstyled ftSocialNetworks d-flex align-items-center flex-wrap justify-content-center justify-content-md-start">
								<li>
									<a href="javascript:void(0);">
										<i class="fab fa-facebook-f"><span class="sr-only">icon</span></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);">
										<i class="fab fa-twitter"><span class="sr-only">icon</span></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);">
										<i class="fab fa-instagram"><span class="sr-only">icon</span></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);">
										<i class="fab fa-vimeo-v"><span class="sr-only">icon</span></i>
									</a>
								</li>
							</ul>
						</div>
						<div class="col-12 col-md-3 order-md-1 position-static">
							<!-- ftLogo -->
							<div class="ftLogo mb-7 mt-1 pr-md-8">
								<a href="home.html">
									<img src="{{asset('educa/images/ftLogo.svg')}}" width="51" height="57" alt="logo">
								</a>
							</div>
							<!-- copyright -->
							<div class="fontAlter">
								<p><strong class="fwSemi">2021 &copy; <a href="home.html">E-Learning</a>. All rights reserved.</strong></p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<!-- include jQuery library -->
	<script src="{{asset('educa/js/jquery-3.4.1.min.js')}}"></script>
	<!-- include bootstrap popper JavaScript -->
	<script src="{{asset('educa/js/popper.min.js')}}"></script>
	<!-- include bootstrap JavaScript -->
	<script src="{{asset('educa/js/bootstrap.min.js')}}"></script>
	<!-- include custom JavaScript -->
	<script src="{{asset('educa/js/jqueryCustom.js')}}"></script>
	<!-- include fontAwesome -->
	<script src="https://kit.fontawesome.com/391f644c42.js"></script>
</body>
</html>