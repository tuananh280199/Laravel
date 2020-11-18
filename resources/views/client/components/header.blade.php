    <!-- header -->
    <div class="agileits_header">
        <div class="w3l_offers">
            <a href="products.html">Today's special Offers !</a>
        </div>
        <div class="w3l_search">
            <form action="{{ route('products.all') }}" method="">
            <input type="text" name="name" value="{{ \Request::get('name') }}"  placeholder="Search by name product ...">
                <input type="submit" value=" ">
            </form>
        </div>
        <div class="product_list_header">  
            <form action="{{ route('cart') }}">
                <fieldset>
                    <input type="hidden"  value="_cart" />
                    <input type="hidden"  value="1" />
                    <input type="submit"  value="View your cart" class="button" />
                </fieldset>
            </form>
        </div>
        <div class="w3l_header_right">
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
                    <div class="mega-dropdown-menu">
                        <div class="w3ls_vegetables">
                            <ul class="dropdown-menu drp-mnu">
                                <li><a href="login.html">Login</a></li> 
                                <li><a href="login.html">Sign Up</a></li>
                            </ul>
                        </div>                  
                    </div>	
                </li>
            </ul>
        </div>
        <div class="w3l_header_right1">
            <h2><a href="mail.html">Contact Us</a></h2>
        </div>
        <div class="clearfix"> </div>
    </div>
<!-- script-for sticky-nav -->
    <script>
    $(document).ready(function() {
         var navoffeset=$(".agileits_header").offset().top;
         $(window).scroll(function(){
            var scrollpos=$(window).scrollTop(); 
            if(scrollpos >=navoffeset){
                $(".agileits_header").addClass("fixed");
            }else{
                $(".agileits_header").removeClass("fixed");
            }
         });
         
    });
    </script>
<!-- //script-for sticky-nav -->
    <div class="logo_products">
        <div class="container">
            <div class="w3ls_logo_products_left">
                <h1><a href="{{route('home')}}"><span>Grocery</span> Store</a></h1>
            </div>
            <div class="w3ls_logo_products_left1">
                <ul class="special_items">
                    <li><a href="{{route('home')}}">Home</a><i>/</i></li>
                    <li><a href="#">About Us</a><i>/</i></li>
                    <li><a href="{{route('products.all')}}">Shop</a><i>/</i></li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="shop.html">Shop
                        {{-- <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Page 1-1</a></li>
                          <li><a href="#">Page 1-2</a></li>
                          <li><a href="#">Page 1-3</a></li>
                        </ul> 
                        <i>/</i>
                    </li>--}}
                    <li><a href="#">Services</a></li>
                </ul>
            </div>
            <div class="w3ls_logo_products_left1">
                <ul class="phone_email">
                    <li><i class="fa fa-phone" aria-hidden="true"></i>{{getConfigValueSetting('phone_contact')}}</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">{{getConfigValueSetting('email')}}</a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
<!-- //header -->