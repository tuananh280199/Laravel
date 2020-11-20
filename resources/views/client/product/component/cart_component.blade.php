    <!-- products-breadcrumb -->
    <div class="products-breadcrumb">
        <div class="container">
            <ul>
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{route('home')}}">Home</a><span>|</span></li>
                <li>Cart</li>
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
            <h3>Bills</h3>
            @if(isset($carts) && count($carts) > 0)
          <div class="checkout-right delete_cart_url" data-url="{{route('cart.delete')}}">
                <table class="timetable_sub update_cart_url" data-url="{{route('cart.update')}}">
                    <thead>
                        <tr>
                            <th>SL No.</th>	
                            <th>Product</th>
                            <th>Quality</th>
                            <th>Product Name</th>
                        
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($carts as $id => $cartItem)
                                <tr class="rem1">
                                    <td class="invert">{{$id}}</td>
                                    <td class="invert-image"><a href=""><img src="{{ $cartItem['image'] }}" alt=" " class="img-responsive"></a></td>
                                    <td class="invert">
                                        <input type="number" class="quantity" value="{{ $cartItem['quantity'] }}">
                                    </td>
                                    <td class="invert">{{ $cartItem['name'] }}</td>
                                    
                                    <td class="invert">${{ $cartItem['price'] }}</td>
                                    <td class="invert">
                                        <a href=""  data-id="{{$id}}" class="btn btn-primary cart_update">Update</a>
                                        <a href=""  data-id="{{$id}}" class="btn btn-danger cart_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            @php
                $total = 0;   
            @endphp
            <div class="checkout-left">	
                <div class="col-md-12 checkout-left-basket" style="padding: 20px 50px 50px 50px ">
                    <h4>Invoice Details</h4>
                    <ul>
                        @foreach($carts as $id => $cartItem)
                            @php
                                $total += $cartItem['price'] * $cartItem['quantity'];   
                            @endphp
                            <li>{{$cartItem['name']}} <i>-</i> <span>${{ $cartItem['price'] * $cartItem['quantity'] }} </span></li>
                        @endforeach
                        <li style="font-size: 1em;
                            color: #212121;
                            font-weight: 600;
                            padding: 1em 0;
                            border-top: 1px solid #ddd;
                            border-bottom: 1px solid #ddd;
                            margin: 2em 0 0;"
                        >Total <i>-</i> <span>${{$total}}</span></li>
                    </ul>
                </div>
                <div class="col-md-12 address_form_agile" style="padding-right: 50px ">
                    <div class="checkout-right-basket">
                        <a href="{{ route('checkout.login') }}">Check Out<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                    </div>
                </div>
            
                <div class="clearfix"> </div>
                
            </div>
            @else
                <div class="checkout-right">
                    <h1 style="text-align: center">Empty shopping cart, invite you to shop</h1>
                </div>
            @endif
        </div>
<!-- //about -->
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- //banner -->