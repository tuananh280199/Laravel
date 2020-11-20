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
            <h3>Payment</h3>
            <div class="checkout-left">	
                <div class="col-md-12 address_form_agile" style="padding-left: 20px">
                      <h4 style="margin: 30px 0 50px 0;">Choose method payment </h4>
                            <form action="{{route('checkout.order')}}" method="post" class="creditly-card-form agileinfo_form">
                                {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4">
                                                    <input type="radio" name="payment_option" value="1">
                                                    <label>Pay via ATM card</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="radio" name="payment_option" value="2" checked>
                                                    <label>Payment in cash</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="payment_option" value="3">
                                                    <label>Installment</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="height: 50px;"></div>
                                        <div class="checkout-left-basket ">
                                            <a href="{{ route('cart') }}" class="btn btn-danger" style="padding: 15px 20px 15px 20px"><- Review Cart</a>
                                        </div>
                                        <div class="checkout-right-basket">
                                            <input type="submit" value="Send Order ->" name="send_order" class="btn btn-primary" style="padding: 15px 20px 15px 20px">
                                        </div>
                                    </div>
                           
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