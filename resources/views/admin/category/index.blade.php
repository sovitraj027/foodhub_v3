@extends('admin.admin_app')

@section('content')
    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="{{ route('category.create') }}" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
            </div>
            <h2>Categories</h2>
            <div class="panel panel-default panel-shadow">
                <div class="panel-body">

                    <table id="data-table" class="table-striped table-hover dt-responsive table" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th class="width-100 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $i => $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td><img src="/storage/category-image/{{ $category->category_image }}" width="100"
                                            height="50"></td>
                                    <td class="row text-center">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-default btn-rounded"><i class="md md-edit"></i></a>

                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('Delete')

                                            <button class="btn btn-default btn-rounded"
                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                type="submit" title="Delete">
                                                <i class="md md-delete"></i>
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="clearfix"></div>
            </div>

        </div>
    @endsection
    @section('scripts')
    @endsection
