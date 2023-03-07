@extends("app")

@section('head_title', 'Edit Profile' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")

<!-- Content ================================================== -->
<div class="container margin_60">

    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-12">
            <div class="box_style_2" id="order_process">
                <h2 class="inner">Edit Profile</h2>
                <form action="{{url('profile')}}" id="profile" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="message">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                    @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                    @endif

                    <div class="form-group col-md-6">
                        <label>First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="{{$user->first_name}}" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last name</label>
                        <input type="text" class="form-control" id="last_name" value="{{$user->last_name}}"
                            name="last_name" placeholder="Last name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Telephone/mobile</label>
                        <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}" class="form-control"
                            placeholder="Telephone/mobile">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control"
                            placeholder="Your email">
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" name="city" value="{{$user->city}}" class="form-control"
                                placeholder="Your city">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" id="city" name="latitude" value="{{$user->latitude}}" class="form-control" placeholder="Your city">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" id="city" name="longitude" value="{{$user->longitude}}" class="form-control" placeholder="Your city">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Postal code</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{$user->postal_code}}"
                                class="form-control" placeholder=" Your postal code">
                        </div>
                    </div>
                    {{-- @if(Auth()->user()->usertype=='delivery_staff')
                    <div class="form-group col-md-6">
                        <label for="">Citizenship Front</label>
                        <input type="file" id="email" name="profile_image" value="" class="form-control"
                            placeholder="Your image">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Citizenship Back</label>
                        <input type="file" id="email" name="profile_image" value="" class="form-control"
                            placeholder="Your image">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Driving Lisence image</label>
                        <input type="file" id="email" name="profile_image" value="" class="form-control"
                            placeholder="Your image">
                    </div>
                    @endif --}}
                    <hr>
                    <div>
                        <div class="col-md-6">
                            <label>Your full address</label>
                            <textarea class="form-control" style="height:60px" placeholder="Address" name="address"
                                id="address">{{$user->address}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-submit">Update Profile</button>
                </form>
            </div>
            <!-- End box_style_1 -->
        </div>
        <!-- End col-md-6 -->




    </div>
    <!-- End row -->
</div>
<!-- End white_bg -->




<!-- End section -->
<!-- End Content =============================================== -->

@endsection