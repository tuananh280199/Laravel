@extends('client.layouts.master')
    
@section('title')
    <title>Home Page</title> 
@endsection

@section('js')
    <script src="{{ asset('client/js/jquery-1.11.1.min.js') }}"></script>
@endsection

@section('content')
<body>
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.html">Home</a><span>|</span></li>
				<li>Sign In & Sign Up</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
		<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   @include('client.components.sidebar')
			</nav>
		</div>
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
			@php
				$login_fail = Session::get('login_fail');   
			@endphp
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil" style="margin-top: 9px;"></i>
					<div class="tooltip">click me</div>
				  </div>
				  <div class="form">
					<h2>Login to your account</h2>
					@if($errors->any())
					<div class="alert alert-danger" role="alert">
						Register fail. Please fix the following errors
					</div>
					@endif
					@if($login_fail !== null) 
						<p style="color: #FF2D20; margin-bottom: 10px;">{{$login_fail}}</p>
					@endif
					<form action="{{route('login.customer')}}" method="post">
					  {{csrf_field()}}
					  <input type="email" name="email" placeholder="Email Address" required>
					  <input type="password" name="password" placeholder="Password" required>
					  <input type="submit" value="Login">
					</form>
				  </div>
				  <div class="form">
					<h2>Create an account</h2>
					@if($errors->any())
					<div class="alert alert-danger" role="alert">
						Register fail. Please fix the following errors
					</div>
					@endif
				  	<form action="{{route('checkout.register')}}" method="post">
					  {{csrf_field()}}
					  <input type="text" class="@error('name') is-invalid @enderror" name="name" placeholder="Name" required>
					  @error('name')
					  	<div class="alert alert-danger invalid-feedback">{{$message}}</div>
					  @enderror
					  <input type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="Email Address" required>
					  @error('email')
					  	<div class="alert alert-danger invalid-feedback">{{$message}}</div>
				  	  @enderror 
					  <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required>
					  @error('password')
					  	<div class="alert alert-danger invalid-feedback">{{$message}}</div>
				  	  @enderror 
					  <input type="text" class="@error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" required>
					  @error('phone')
					  	<div class="alert alert-danger invalid-feedback">{{$message}}</div>
				  	  @enderror 
					  <input type="submit" value="Register">
					</form>
				  </div>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- Bootstrap Core JavaScript -->
<script src="/client/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
@endsection