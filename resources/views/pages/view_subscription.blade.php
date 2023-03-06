@extends("app")

@section('head_title', ' Menu' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

    <div class="sub-banner"
         style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
        <div class="overlay">
            <div class="container">
                <div id="sub_content" class="animated zoomIn">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-10 col-sm-9">
                        <div class="rating"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="restaurant_list_detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="main_menu" class="box_style_2">
                            <h2 class="inner">Customized Package List</h2>

                            {{--                            <h3 id="{{$category->category_name}}" class="nomargin_top">{{$category->category_name}}</h3>--}}
                            <table class="table table-striped cart-list">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th class="text-center">Package Name</th>
                                    <th class="text-center">Includes</th>
                                    <th class="text-center">Per Day Price</th>
                                    <th class="text-center">Subscribe</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>
                                            <div class="rstl_img"><a href="#menu_{{$package->id}}">
                                                    @if($package->name)
                                                        <img src="/storage/package-image/{{ $package->image }}"/>
                                                    @else
                                                        <img src="{{ URL::asset('upload/menu_img_s.png') }}"/>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <h5>{{$package->name}}</h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                @foreach($package->menus as $menu)
                                                    <h5>{{$menu->menu_name}}</h5>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td><strong>{{getcong('currency_symbol')}} {{$package->price}}</strong></td>

                                        <td><a href="{{route('userSubscriptionCreate',$package->id)}}" class="btn btn-sm btn-outline-success">Subscribe</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection