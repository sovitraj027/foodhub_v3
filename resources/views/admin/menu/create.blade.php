@extends("admin.admin_app")

@section("content")

<div id="main">
    <div class="page-header">
        <h2> {{ isset($menu->menu_name) ? 'Edit: '. $menu->menu_name : 'Add Menu' }}
        </h2>

        <a href=" " class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>

    </div>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
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
            {{-- {!! Form::open(array('url' =>
            array(route('menus.store')),'class'=>'form-horizontal
            padding-15','name'=>'menu_form','id'=>'menu_form','role'=>'form','enctype' => 'multipart/form-data')) !!} --}}
            <form action="{{route('menus.store')}}" method="POST" id="menu_form" enctype="multipart/form-data" class="form-horizontal padding-15">
                @csrf
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Menu Name</label>
                <div class="col-sm-9">
                    <input type="text" name="menu_name" value="{{ isset($menu->menu_name) ? $menu->menu_name : null }}"
                        class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Sort Description</label>
                <div class="col-sm-9">
                    <input type="text" name="menu_description"
                        value="{{ isset($menu->description) ? $menu->description : null }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-6">

                    <input id="touch-spin-2" data-toggle="touch-spin" data-min="-1000000" data-max="1000000"
                        data-prefix="Rs" data-step="1" type="number"
                        value="{{ isset($menu->price) ? $menu->price : null }}" name="price" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 ">Menu category</label>
                <div class="col-sm-6">
                    <select id="basic" name="category_id" class="selectpicker show-tick form-control">
                        <option value="">Select Food Category</option>
                        @foreach($categories as $i => $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-3 ">Select Type</label>
                <div class="col-sm-6">
                    <select id="basic" name="menu_type" class="selectpicker show-tick form-control">
                        <option value="">Select Food Type</option>
                        {{-- @foreach(\App\Package::types as $package_type)
                            <option value="{{$package_type}}">{{$package_type}}</option>
                        @endforeach --}}
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Non Vegetarian">Non Vegetarian</option>
                        <option value="vegan">Vegan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="avatar" class="col-sm-3 control-label">Menu Image</label>
                <div class="form-group col-md-6 ">
                    <input type="file" class="form-control @error(" image") is-invalid @enderror" name="menu_image" id="image" alt="image">
                    <img id="showImagePreview" src="#" alt="book image preview" height="100px" width="150px">
                    {{-- @error("image")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror --}}
            </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-md-offset-3 col-sm-9 ">
                    <button type="submit" class="btn btn-primary">{{ isset($menu->id) ? 'Edit Menu ' : 'Add Menu'
                        }}</button>

                </div>
            </div>
            </form>
        </div>
    </div>


</div>

@endsection
@section('scripts')
<script>
    window.onload = function() {

        // to display image preview
        let siteImage = document.getElementById('image');
        let showImagePreview = document.getElementById('showImagePreview');
        showImagePreview.style.display = "none";

        siteImage.onchange = evt => {
            const [file] = siteImage.files
            if (file) {
                showImagePreview.style.display = "block";
                showImagePreview.src = URL.createObjectURL(file);
                showImagePreview.onload = function() {
                    URL.revokeObjectURL(showImagePreview.src) // free memory
                }
            }
        }
    };

</script>
@endsection
