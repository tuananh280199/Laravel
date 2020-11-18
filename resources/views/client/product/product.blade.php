@extends('client.layouts.master')
    
@section('title')
    <title>Shop Page</title> 
@endsection

@section('js')
    <script src="{{ asset('client/js/jquery-3.5.1.min.js') }}"></script>
@endsection

@section('content')
<body>
    <!-- products-breadcrumb -->
        <div class="products-breadcrumb">
            <div class="container">
                <ul>
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{route('home')}}">Home</a><span>|</span></li>
                    <li>Shop</li>
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
                <div class="w3ls_w3l_banner_nav_right_grid">
                    <h3 style="margin-top: 10px;">Products</h3>
                    <div class="agile_top_brands_grids">
                        @foreach($products as $product)
                        <div class="col-md-3 top_brand_left" style="margin-bottom: 20px;">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid">
                                    {{-- <div class="tag"><img src="/client/images/tag.png" alt=" " class="img-responsive" /></div> --}}
                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block" >
                                                <div class="snipcart-thumb">
                                                    <a href="{{ route('products.detail', $product->id) }}"><img title=" " alt=" " src="{{$product->feature_image_path}}" /></a>		
                                                    <p>{{$product->name}}</p>
                                                    <h4>${{ number_format($product->price) }}.00</h4>
                                                    {{-- <h4>{{$product->price}}</h4> --}}
                                                </div>
                                                <div class="snipcart-details top_brand_home_details">
                                                    <input 
                                                        type="submit" 
                                                        name="submit" 
                                                        value="Add to cart" 
                                                        class="button add_to_cart" 
                                                        data-url="{{ route('products.add_to_cart',$product->id )}}"
                                                    />
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin: 10px 0 10px 0;">
                            {{ $products->links() }}
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
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
    <script src="/client/js/minicart.js"></script>
    <script>
            paypal.minicart.render();
    
            paypal.minicart.cart.on('checkout', function (evt) {
                var items = this.items(),
                    len = items.length,
                    total = 0,
                    i;
    
                // Count the number of each item in the cart
                for (i = 0; i < len; i++) {
                    total += items[i].get('quantity');
                }
    
                if (total < 1) {
                    alert('The minimum order quantity is 1. Please add more to your shopping cart before checking out');
                    evt.preventDefault();
                }
            });
    
        </script>
        <script>
            function addToCart(event) {
                event.preventDefault()
                let urlCart = $(this).data('url');
                $.ajax({
                    type: "GET",
                    url: urlCart,
                    dataType: 'json',
                    success: function(data) {
                        if(data.code === 200) {
                            alert('Thêm sản phẩm thành công');
                        }
                    },
                    error: function() {

                    }
                })
            }
            $(function() {
                $('.add_to_cart').on('click', addToCart);
            })
        </script>
    </body>
@endsection