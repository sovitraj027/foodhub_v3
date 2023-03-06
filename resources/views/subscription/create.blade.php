@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> Add Subscription</h2>

            <a href="{{route('subscription.index')}}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">

                <form method="POST" enctype="multipart/form-data" action="{{route('subscription.store')}}">
                    @csrf

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Subscribed From</label>
                        <div class="col-sm-9">
                            <input type="date" name="subscribed_from" class="form-control"><br>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Package</label>
                        <div class="col-sm-9">
                            <select name="package_id" class="form-control">
                                <option disabled selected>Select Package</option>
                                @foreach($packages as $package)
                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>

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

@endsection