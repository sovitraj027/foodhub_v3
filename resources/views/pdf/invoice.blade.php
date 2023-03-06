<style>
    body {

        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .container {

        margin-right: auto;
        margin-left: auto;
    }

    .brand-section {
        background-color: #13be0d;
        padding: 10px 40px;
    }

    .logo {
        width: 50%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-6 {
        width: 50%;
        flex: 0 0 auto;
    }

    .text-white {
        color: #fff;
    }

    .company-details {
        float: right;
        text-align: right;
    }

    .body-section {
        padding: 16px;
        border: 1px solid gray;
    }

    .heading {
        font-size: 20px;
        margin-bottom: 08px;
    }

    .sub-heading {
        color: #081603;
        margin-bottom: 05px;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
    }

    table thead tr {
        border: 1px solid #111;
        background-color: #f2f2f2;
    }

    table td {
        vertical-align: middle !important;
        text-align: center;
    }

    table th,
    table td {
        padding-top: 08px;
        padding-bottom: 08px;
    }

    .table-bordered {
        box-shadow: 0px 0px 5px 0.5px rgb(182, 80, 80);
        text-align: center;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .text-right {
        text-align: end;
    }

    .w-20 {
        width: 20%;
    }

    .float-right {
        float: right;
    }
</style>

<div class="container">
    <div class="brand-section">
        <div class="row">
            <div class="col-6">
                <h1 class="text-white">Cloud Kitchen</h1>
            </div>

        </div>
    </div>

    <div class="body-section">
        <div class="row">
            <div class="col-6">
                @php
                $invoice= mt_rand();
                @endphp
                <h2 class="heading">Order No. {{$invoice}} </h2>
                <p class="sub-heading"><strong> Name:{{$user->first_name . ' ' .$user->last_name}} </strong></p>
                <p class="sub-heading"><strong> Email: {{$user->email}}</strong> </p>
                <p class="sub-heading"><strong> Delivery Time: {{\Carbon\Carbon::now()->format('Y-m-d')}}</strong></p>
            </div>
        </div>
    </div>

    <div class="body-section">
        <h3 class="heading">Detials</h3>
        <br>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th class="w-20">Quantity</th>
                    <th class="w-30">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if($package_name)
                    <td>{{$package_name}}</td>
                    @else
                    <td>{{$item_name}}</td>
                    @endif
                    <td>{{$quantity}}</td>
                    <td>{{$price}}</td>
                </tr>

            </tbody>
        </table>
        <br>
        <h3 class="heading"><strong>Thank you</strong> </h3>
    </div>

</div>