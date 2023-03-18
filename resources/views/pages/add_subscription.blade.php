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
                            <form method="POST" enctype="multipart/form-data" action="{{route('subscription.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Subscribed From</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="subscribed_from" class="form-control datepicker"><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Delivery Time</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="" name="delivery_time" class="form-control timeData"><br>
                                    </div>
                                </div>
                                <input type="hidden" name="package_id"  value="{{$package_id}}">

                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Subscription Type</label>
                                    <div class="col-sm-9">
                                        <select name="subscription_type" class="form-control">
                                            <option disabled selected>Select Type</option>
                                            @foreach(\App\Subscription::subscription_types as $sub_type)
                                                <option value="{{$sub_type}}">{{$sub_type}}</option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-sm-9 ">
                                        <button type="submit" class="btn btn-primary">Create Subscription</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>    
   $('.timeData').flatpickr({
    noCalendar: true,
    enableTime: true,
    dateFormat: 'h:i K'
    });
    const today = new Date();
    const fp = flatpickr(".datepicker", {
    minDate: today,
    // "enableTime": true,
    dateFormat: "Y-m-d"
    });
</script>
@endsection