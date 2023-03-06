@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> Update Package</h2>

            <a href="{{route('packages.index')}}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

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

                <form method="POST" enctype="multipart/form-data" action="{{route('packages.update', $package->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label mb-2">Package Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{$package->name}}">
                        </div>
                    </div>
                    <br><br>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label mb-2">Package Price</label>
                        <div class="col-sm-9">
                            <input type="number" name="price" class="form-control" value="{{$package->price}}"><br>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="" class="col-sm-3 control-label">Package Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" cols="30" rows="10" class="form-control">{{$package->description}}</textarea> <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Package Image</label>
                        <div class="col-sm-9">
                            <input type="file" name="image" class="form-control"> <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Package Type</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control" id="package_type">
                                @foreach(\App\Package::types as $package_type)
                                    <option value="{{$package_type}}" @if($package->type === $package_type) selected @endif>{{$package_type}}</option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>

                    <div id="menu_box" >
                        <label for="roles" class="col-sm-3 control-label">Select Menu List</label>
                        <div id="menu_box_checkbox_list" class="col-sm-9"></div>
                    </div>

                    @if(!empty($package->menus))
                        <div id="user_permissions_box">
                            <label for="" class="col-sm-3 control-label">Menu Items</label>
                            <div id="user_permissions_checkbox_list" class="d-flex flex-wrap col-sm-9">
                                @foreach ($menu_items as $menu_item)
                                    <div class="form-check form-check-inline mx-1">
                                        <input class="form-check-input" type="checkbox" name="menu_items[]" id="{{$menu_item->id}}"
                                               value="{{$menu_item->id}}" {{ in_array($menu_item->id, $package_menus ) ? 'checked="checked"' : '' }}>
                                        <label class="form-check-label" for="{{$menu_item->id}}">{{$menu_item->menu_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Is Active</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="status" class="form-control" value="0">
                            <input type="checkbox" name="status" class="form-control" value="1" @if($package->status === 1) checked @endif> <br>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">Update Package</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function(){
            let menu_box = $('#menu_box');
            let menu_box_checkbox_list = $('#menu_box_checkbox_list');
            let user_menu_box = $('#user_menu_box');
            // let user_menu_box_checkbox_list = $('#user_menu_box_checkbox_list');

            menu_box.hide(); // hide all boxes


            $('#package_type').on('change', function() {
                let package_type = $(this).find(':selected').val();

                menu_box_checkbox_list.empty();
                user_menu_box.empty();

                $.ajax({
                    url: "{{route('packages.create')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        package_type: package_type,
                    }
                }).done(function(data) {

                    menu_box.show();
                    // menu_box_checkbox_list.empty();

                    $.each(data, function(index, element){
                        $(menu_box_checkbox_list).append(
                            '<div class="form-check form-check-inline mx-1">' +
                            '<input class="form-check-input" style="margin-right:5px" type="checkbox" name="menu_items[]" id="' + element.name + '" value="' + element.id + '">' +
                            '<label class="form-check-label" for="' + element.menu_name + '">' + element.menu_name + '</label>' +
                            '</div>'
                        );

                    });
                });
            });
        });

    </script>
@endsection