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
                      <h4>Add Your Infomation </h4>
                            <form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
                                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                    <div class="information-wrapper">
                                        <div class="first-row form-group">
                                            <div class="controls">
                                                <label class="control-label">Full name: </label>
                                                <input class="billing-address-name form-control" type="text" name="name" placeholder="Full name">
                                            </div>
                                            <div class="w3_agileits_card_number_grids">
                                                <div class="w3_agileits_card_number_grid_right">
                                                    <div class="controls">
                                                        <label class="control-label">Email: </label>
                                                     <input class="form-control" type="email" name="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="w3_agileits_card_number_grid_left">
                                                    <div class="controls">
                                                        <label class="control-label">Mobile number:</label>
                                                        <input class="form-control" type="text" name="phone" placeholder="Mobile number">
                                                    </div>
                                                </div>
                                                <div class="clear"> </div>
                                            </div>
                                            <div class="controls">
                                                <label class="control-label">Town/City: </label>
                                                <input class="form-control" type="text" name="address" placeholder="Town/City">
                                            </div>
                                            <div class="controls">
                                                <label class="control-label">Order notes: </label>
                                                <textarea class="form-control" name="note" placeholder="Order notes" rows="5" style="width: 100%; !important"></textarea>
                                            </div>
                                        </div>
                                        <div class="checkout-left-basket">
                                            <a href="{{ route('cart') }}" class="btn btn-danger" style="padding: 15px 20px 15px 20px"><- Review Cart</a>
                                        </div>
                                        <div class="checkout-right-basket">
                                            <input type="submit" value="Send Order ->" name="send_order" class="btn btn-primary" style="padding: 15px 20px 15px 20px">
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
        <script>
            function cartUpdate(event) {
                event.preventDefault();
                let urlUpdateCart = $('.update_cart_url').data('url');
                let id = $(this).data('id');
                let quantity = $(this).parents('tr').find('input.quantity').val();
                $.ajax({
                    type: "GET",
                    url: urlUpdateCart,
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function(data) {
                        if(data.code === 200) {
                            $('.cart_wrapper').html(data.cart_component);
                            // alert("Cập nhật thành công");
                        }
                    },
                    error: function() {

                    }
                })
            }

            function cartDelete(event) {
                event.preventDefault();
                let urlDeleteCart = $('.delete_cart_url').data('url');
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: urlDeleteCart,
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if(data.code === 200) {
                            $('.cart_wrapper').html(data.cart_component);
                            // alert("Cập nhật thành công");
                        }
                    },
                    error: function() {

                    }
                })
            }

            $(function() {
                $(document).on('click', '.cart_update', cartUpdate);
                $(document).on('click', '.cart_delete', cartDelete);
            })
        </script>
    </body>
    
@endsection