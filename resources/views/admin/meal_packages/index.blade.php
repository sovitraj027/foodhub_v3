@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="{{route('packages.create')}}" class="btn btn-primary">Add Package <i class="fa fa-plus"></i></a>
            </div>
            <h2>Meal Packages</h2>
        </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th class="text-center width-100">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($packages as $i => $package)
                        <tr>
                            <td><a href="#" class="text-regular">{{ $package->name }}</a>
                            <td><a href="#" class="text-regular">{{ $package->type }}</a>
                            <td class="text-center">
                                <a href="{{ route('packages.show', $package->id) }}" class="btn btn-default btn-rounded"><i class="md md-settings-display"></i></a>
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-default btn-rounded"><i class="md md-edit"></i></a>

                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST">
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