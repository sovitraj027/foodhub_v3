@extends('admin.admin_app')

@section('content')
<div id="main">
    <div class="page-header">

        <div class="pull-right">
            <a href="{{ URL::to('admin/users/adduser') }}" class="btn btn-primary">Add User <i class="fa fa-plus"></i></a>
        </div>
        <h2>Users</h2>
    </div>
    @if (Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        {{ Session::get('flash_message') }}
    </div>
    @endif

    <div class="panel panel-default panel-shadow">
        <div class="panel-body">

            <table id="data-table" class="table-striped table-hover dt-responsive table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>User Type</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="width-100 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $i => $users)
                    <tr>

                        <td>{{ $users->usertype }}
                        </td>
                        <td>{{ $users->first_name }}</td>
                        <td>{{ $users->last_name }}</td>
                        <td>{{ $users->email }}</td>
                        <td><input data-id="{{ $users->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Verfied" data-off="Unverified" {{ $users->status ? 'checked' : '' }}></td>

                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="{{ url('admin/users/adduser/' . $users->id) }}"><i class="md md-edit"></i> Edit Editor</a></li>
                                    <li><a href="{{ url('admin/users/delete/' . $users->id) }}"><i class="md md-delete"></i> Delete</a></li>
                                </ul>
                            </div>

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
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET"
                , dataType: "json"
                , url: '/changeStatus'
                , data: {
                    'status': status
                    , 'user_id': user_id
                }
                , success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })

</script>
@endsection
