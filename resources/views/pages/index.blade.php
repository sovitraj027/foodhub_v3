@extends("app")
@section("content")

    @include("_particles.search_slider")

    <!-- Content ================================================== -->

    <div id="blog_item">
        <div class="container">
            <h1 class="mb5 zui-highlight">Choose one to start building your order</h1>

            <nav id="list_shortcuts">
                <ul>
                    @foreach($categories as $category)
                        <img src="/storage/category-image/{{ $category->category_image }}" width="100" height="50">

                        <li><a title="{{$category->category_name}}" href="{{route('getMenus',$category->category_slug)}}" data-cuisine="chinese"> <img alt="{{$category->category_name}}"
                                                                                                                                  src="/storage/category-image/{{ $category->category_image }}">
                                <span>{{$category->name}}</span> </a></li>
                    @endforeach

                </ul>
            </nav>
        </div>
    </div>

    <div class="white_bg">
        <div class="container margin_60">
            <div class="main_title">
                <h2 class="nomargin_top">View Our Subscription Model</h2>

                <nav id="list_shortcuts">
                    <ul>
                        <a href="{{route('viewSubscriptionModel')}}" class="btn btn-block btn-lg btn-primary">Get Subscription</a>
                    </ul>
                </nav>
            </div>
            <div class="row">
                @foreach($packages as $i => $package)
                    <div class="col-md-6"><a class="strip_list" href="">
                            <div class="desc">
                                <h3>{{ $package->name }}</h3>
                                <div class="type"> {{$package->type}} </div>
                                {{-- <div class="location">{{$package->restaurant_address}}  </div> --}}

                                {{-- <div class="rating">
                                    @for($x = 0; $x < 5; $x++)

                                        @if($x < $package->review_avg)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star fa fa-star-o"></i>
                                        @endif

                                    @endfor

                                </div> --}}
                             
                                <div class="thumb_strip"><img src="/storage/package-image/{{ $package->image }}"
                                                              alt="{{ $package->namee }}"></div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    <!-- End section -->
    <!-- End Content =============================================== -->

@endsection
