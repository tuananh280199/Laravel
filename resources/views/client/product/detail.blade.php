@extends('client.layouts.master')
    
@section('title')
    <title>Home Page</title> 
@endsection

@section('js')
    <script src="{{ asset('client/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('client/js/okzoom.js') }}"></script>
    <script>
    $(function(){
        $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
        });
    });
    </script>
@endsection

@section('content')
<body>
        <!-- products-breadcrumb -->
        <div class="products-breadcrumb">
            <div class="container">
                <ul>
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{route('home')}}">Home</a><span>|</span></li>
                    <li>Detail</li>
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
                <div class="agileinfo_single" style="padding: 10px 20px 20px 20px;">
                    <h5 style="text-align: center;">{{ $product->name }}</h5>
                    <div class="col-md-1"></div>
                    <div class="col-md-3 agileinfo_single_left">
                        <img id="example" src="{{ $product->feature_image_path }}" alt=" " class="img-responsive" width="266" height="250"/>
                    </div>
                    <div class="col-md-8 agileinfo_single_right">
                        <div class="w3agile_description">
                            <h4>Description :</h4>
                            <p>{{ $product->content }}</p>
                        </div>
                        <div class="snipcart-item block">
                            <div class="snipcart-thumb agileinfo_single_right_snipcart">
                                <h4 style="text-align: start;">Price : <p style="display: inline; color: #0032BD;">${{ $product->price }}</p></h4>
                            </div>
                            <div class="snipcart-details agileinfo_single_right_details">
                                <input 
                                    type="submit" 
                                    name="submit" 
                                    value="Add to cart" 
                                    class="button add_to_cart" 
                                    data-url="{{ route('products.add_to_cart',$product->id )}}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
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

