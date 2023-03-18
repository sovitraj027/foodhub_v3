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
                            <table class="table table-striped cart-list">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th class="text-center">Package Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Subscribe From</th>
                                    <th class="text-center">Subscribe To</th>
                                    <th class="text-center">Delivery Time</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $subscription)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <h5>{{$subscription->package->name}}</h5>
                                        </td>

                                        <td>
                                            <h5>{{$subscription->subscription_type}}</h5>
                                        </td>

                                        <td>
                                            <h5>{{$subscription->subscribed_from}}</h5>
                                        </td>

                                        <td>
                                            <h5>{{$subscription->subscribed_to}}</h5>
                                        </td>
                                         
                                        <td>
                                            <h5>{{ \Carbon\Carbon::parse($subscription->delivery_time)->format('h:i A') }}</h5>
                                        </td>

                                        <td><a href="{{route('myPackageStatus',$subscription->package_id)}}" class="btn btn btn-success">Delivery Info</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection