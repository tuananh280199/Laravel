@extends('client.layouts.master')
    
@section('title')
    <title>Cart Page</title> 
@endsection

@section('js')
    <script src="{{ asset('client/js/jquery-3.5.1.min.js') }}"></script>
@endsection

@section('content')
<body>	
    <div class="cart_wrapper">
    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{route('home')}}">Home</a><span>|</span></li>
                <li>Checkout</li>
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
<!-- about -->
        <div class="privacy about">
            <h3>Checkout</h3>
            <div class="checkout-left">	
                <div class="col-md-12 address_form_agile" style="padding-left: 20px">
                      <h4>Fill In Shipping Information </h4>
                            <form action="{{route('checkout.saveCheckoutCustomer')}}" method="post" class="creditly-card-form agileinfo_form">
                                {{csrf_field()}}
                                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                    <div class="information-wrapper">
                                        <div class="first-row form-group">
                                            <div class="controls">
                                                <label class="control-label">Full name: </label>
                                                <input class="billing-address-name form-control" type="text" name="name" placeholder="Full name" required>
                                            </div>
                                            <div class="w3_agileits_card_number_grids">
                                                <div class="w3_agileits_card_number_grid_right">
                                                    <div class="controls">
                                                        <label class="control-label">Email: </label>
                                                     <input class="form-control" type="email" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="w3_agileits_card_number_grid_left">
                                                    <div class="controls">
                                                        <label class="control-label">Mobile number:</label>
                                                        <input class="form-control" type="text" name="phone" placeholder="Mobile number" required>
                                                    </div>
                                                </div>
                                                <div class="clear"> </div>
                                            </div>
                                            <div class="controls">
                                                <label class="control-label">Town/City: </label>
                                                <input class="form-control" type="text" name="address" placeholder="Town/City" required>
                                            </div>
                                            <div class="controls">
                                                <label class="control-label">Order notes: </label>
                                                <textarea class="form-control" name="note" placeholder="Order notes" rows="5" style="width: 100%; !important" required></textarea>
                                            </div>
                                        </div>
                                        <div class="checkout-left-basket">
                                            <a href="{{ route('cart') }}" class="btn btn-danger" style="padding: 15px 20px 15px 20px"><- Review Cart</a>
                                        </div>
                                        <div class="checkout-right-basket">
                                            <input type="submit" value="Send ->" name="send_shipping" class="btn btn-primary" style="padding: 15px 20px 15px 20px">
                                        </div>
                                    </div>
                                </section>
                            </form>
                    </div>
            
                <div class="clearfix"> </div>
                
            </div>

        </div>
<!-- //about -->
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- //banner -->
    </div>
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