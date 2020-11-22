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
        @include('client.product.component.cart_component')
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
                            alert("Cập nhật thành công");
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
                            alert("Cập nhật thành công");
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