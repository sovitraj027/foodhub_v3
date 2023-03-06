@extends('admin.admin_app')

@section('content')
<div id="main">
    <div class="page-header">

        <div class="pull-right">
            <a href="{{ route('menus.create') }}" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
        </div>
        <h2>Food Menu</h2>
        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table-striped table-hover dt-responsive table" cellspacing="0" width="100%">
                     <thead>
                         <tr>
                             <th>Name</th>
                             <th>Type</th>
                             <th>Price</th>
                             <th colspan="40">Image</th>
                             <th >Action</th>
                         </tr>
                     </thead>
                    <tbody>
                        <tbody>
                            @foreach($menu as $i => $item)
                            <tr>
                                <td>{{ $item->menu_name }}</td>
                                <td>{{ $item->menu_type }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if($item->menu_image)
                                <td><img src="/storage/menu-image/{{ $item->menu_image }}" width="40" height="30" class="img-circle border-white" alt="menu"> </td>
                                @else
                                <img src="{{ URL::asset('upload/menu_img_s.png') }}" width="80" class="img-circle border-white" />
                                @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('menus.edit',$item->id)}}" class="btn btn-default btn-rounded"><i class="md md-edit"></i></a>
                                    <form action="{{ route('menus.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <button class="btn btn-default btn-rounded" onclick="return confirm('Are you sure you want to delete this item?');" type="submit" title="Delete">
                                            <i class="md md-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>


                    </tbody>
                </table>

            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    @endsection
    @section('scripts')
    @endsection

