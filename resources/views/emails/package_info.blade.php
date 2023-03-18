<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>


<body>
    <div>
        <p><b>New Package Order Placed</b></p>
        <p> Order From: {{ ucfirst($data['user']->first_name) }} {{ $data['user']->last_name }} .
        </p>
        <p>Delivery Location: {{ $data['user']->address }} </p>
        <p>Email: {{ $data['user']->email }} </p>
        <p>Phone Number: {{ $data['user']->mobile }} </p>
        <p>Package Name: {{$data['package_name']}}</p>
        <p>Food Type:{{$data['food_type']}} </p>
        <p>Price: {{$data['price']}}</p>
        <p>Package Type: {{$data['package_type']}}</p>
        <p>Thank You!</p>
        <p>
            <small>Note:This email is auto-generated from {{ env('APP_NAME') }}. Please do not reply this email.</small>
        </p>
    </div>
</body>

</html>