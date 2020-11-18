                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav nav_1">
                        {{-- <li><a href="products.html">Branded Foods</a></li> --}}
                        @foreach($categories as $category)
                            <li class="dropdown mega-dropdown">
                                @if($category->categoryChildren->count())
                                    <a href="{{ route('category.product', [ 'slug' => $category->slug, 'id' => $category->id]) }}" class="dropdown-toggle" data-toggle="dropdown">
                                        {{$category->name}}
                                        <span class="caret"></span>
                                    </a>
                                @else
                                    <a href="{{ route('category.product', [ 'slug' => $category->slug, 'id' => $category->id]) }}">
                                        {{$category->name}}
                                    </a>
                                @endif			
                                @if($category->categoryChildren->count())
                                    <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
                                        <div class="w3ls_vegetables">
                                            <ul>	
                                                @foreach($category->categoryChildren as $categoryChildren)
                                                    <li>
                                                        <a href="{{ route('category.product', 
                                                            ['slug' => $categoryChildren->slug, 'id' => $categoryChildren->id]) }}"
                                                        >
                                                            {{ $categoryChildren->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>                  
                                    </div>	
                                @endif		
                            </li>
                        @endforeach
                    </ul>
                 </div><!-- /.navbar-collapse -->