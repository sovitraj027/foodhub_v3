@extends("admin.admin_app")

@section("content")
<div id="main">
    <div class="page-header">
        <h2>All Order List</h2>
    </div>
    <div class="panel panel-default panel-shadow">
        <div class="panel-body">

            <table id="order_data_table" class="table table-striped table-hover dt-responsive" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>Delivery Time</th>
                        <th>User Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th class="text-center width-100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_list as $i => $order)
                    <tr>
                        <td>{{ date('h:i A', strtotime($order->delivery_time)) }}</td>
                        <td>{{ \App\User::getUserFullname($order->user_id) }}</td>
                        <td>{{ \App\User::getUserInfo($order->user_id)->mobile }}</td>
                        <td>{{ \App\User::getUserInfo($order->user_id)->address }}</td>
                        <td>{{ $order->type }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{getcong('currency_symbol')}}{{$order->price }}</td>
                        <td>{{ $order->status }}</td>
                        <td><input data-id="{{ $order->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"
                                data-toggle="toggle" data-on="Paid" data-off="Unpaid" {{ $order->esewa_status ? 'checked' : '' }}></td>
                       
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default-dark dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/Pending') }}"><i
                                                class="md md-lock"></i> Pending</a></li>
                                    <li><a
                                            href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/Processing') }}"><i
                                                class="md md-loop"></i> Processing</a></li>
                                    <li><a
                                            href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/Completed') }}"><i
                                                class="md md-done"></i> Completed</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id.'/Cancel') }}"><i
                                                class="md md-cancel"></i> Cancel</a></li>
                                    <li><a href="{{ url('admin/restaurants/view/orderlist/'.$order->id) }}"><i
                                                class="md md-delete"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <script type="text/javascript">
                $(document).ready(function() {
            
                $('#order_data_table').dataTable({
                    "order": [[ 0, "desc" ]]
                });

            } );
            </script>

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
            var order_id = $(this).data('id');
            $.ajax({
                type: "GET"
                , dataType: "json"
                , url: '/payment'
                , data: {
                    'status': status
                    , 'order_id': order_id
                }
                , success: function(data) {
                    console.log(data.message)
                }
            });
        })
    })

</script>
@endsection
