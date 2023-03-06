@extends("admin.admin_app")
@section("content")
<div class="card">
    <div class="card-header">
        <h2 class="lead text-center">Create a New Category</h2>
    </div>
    <div class="card-body">
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="category_name">Name</label>
                    <input type="text" class="form-control" name="category_name" id="name"
                        value="{{old('category_name')}}">
                </div>
                <div class="form-group  col-md-6">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="category_slug" id="slug" value="{{old('slug')}}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 ">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error(" image") is-invalid @enderror" name="category_image"
                        id="image" alt="image">
                    <img id="showImagePreview" src="#" alt="book image preview" height="100px" width="150px">
                    {{-- @error("image")
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror --}}
                </div>

                 <div class="col-md-6">
                     <div class="mt-5">
                         <label for="">Status</label>
                         <input type="checkbox" name="status" style="width:50px; height:20px;">
                         {{-- @error('status')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror --}}
                     </div>
                 </div>

            </div>

            <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $("#name").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#slug").val(Text);
        });
    });
    window.onload = function () {

    // to display image preview
    let siteImage = document.getElementById('image');
    let showImagePreview = document.getElementById('showImagePreview');
    showImagePreview.style.display = "none";

    siteImage.onchange = evt => {
    const [file] = siteImage.files
    if (file) {
    showImagePreview.style.display = "block";
    showImagePreview.src = URL.createObjectURL(file);
    showImagePreview.onload = function () {
    URL.revokeObjectURL(showImagePreview.src) // free memory
    }
    }
    }
    };

</script>
@endsection