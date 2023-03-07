@extends('app')

@section('head_title', 'Login' . ' | ' . getcong('site_name'))

@section('head_url', Request::url())

@section('content')

<input type="hidden" value="{{$setting->latitude}}" id="hotel_latitude">
<input type="hidden" value="{{$setting->longitude}}" id="hotel_longitude">

@if($rider!=null)
<input type="hidden" value="{{$rider->latitude}}" id="rider_latitude">
<input type="hidden" value="{{$rider->longitude}}" id="rider_longitude">
@endif


<input type="hidden" value="{{$user->latitude}}" id="user_latitude">
<input type="hidden" value="{{$user->longitude}}" id="user_longitude">

{{-- <input type="hidden" value="27.672968" id="city_latitude">
<input type="hidden" value="85.429291" id="hotel_longitude">

<input type="hidden" value="27.669238" id="rider_latitude">
<input type="hidden" value="85.359436" id="rider_longitude">

<input type="hidden" value="27.71678" id="user_latitude">
<input type="hidden" value="85.353674" id="user_longitude"> --}}

Map
<span>
    <button class="btn btn-sm btn-outline-dark float-right show_map">
        <i id="minimizer_map" class="fas fa-angle-down fa-lg gray"></i>
    </button>
</span>
<div id='map' style='width: 100%; height: 70vh;' class="maps m-auto "></div>
@endsection
@section('script')
<script>
    function minimize() {
            obj = $('#minimizer');
            $('.card-collapse').slideToggle();
            $(obj).toggleClass('fa-angle-down');
            $(obj).toggleClass('fa-angle-up');
        }

        function toggleReply(commentId) {
            $('.reply_form_' + commentId).toggleClass('d-none');
        }

        $('.show_button').click(function () {
            obj = $('#minimizer_comment');
            $('.comments').toggleClass('d-none');
            $(obj).toggleClass('fa-angle-down');
            $(obj).toggleClass('fa-angle-up');
        })

        $('.show_map').click(function () {
            obj = $('#minimizer_map');
            $('.maps').toggleClass('d-none');
            $(obj).toggleClass('fa-angle-down');
            $(obj).toggleClass('fa-angle-up');
        })

        var hotel_latitude = document.getElementById('hotel_latitude').value;
        var hotel_longitude = document.getElementById('hotel_longitude').value;

        var rider_latitude = document.getElementById('rider_latitude').value;
        var rider_longitude = document.getElementById('rider_longitude').value;

        var user_longitude = document.getElementById('user_longitude').value;
        var user_latitude = document.getElementById('user_latitude').value;

        var hotel_city = [hotel_longitude, hotel_latitude];
        var rider_place = [rider_longitude, rider_latitude];
        var user_place = [user_longitude, user_latitude];

        mapboxgl.accessToken = 'pk.eyJ1IjoiZXhwb3VuZGVyMTIzIiwiYSI6ImNrODJwY3hjeTEzZW0zZm5xeHJxZHQxd3gifQ.7MCsao35-JomeQ69Yg0ecQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11', //v9
            center: hotel_city,
            zoom: 12
        });

        map.on('load', function () {
            addMarker(rider_place, 'load');
            addMarker2(user_place, 'load');
            addMarker3(hotel_city, 'load');

        });

        // create the popup
        let markerPopup = new mapboxgl.Popup({offset: 25})
            .setHTML(" Room's location ");

        let markerPopup2 = new mapboxgl.Popup({offset: 25})
            .setHTML(" Your current location ");

        function addMarker(ltlng, event) {
            marker = new mapboxgl.Marker({draggable: true, color: "#ff0000"})
                .setLngLat(rider_place)
                .setPopup(markerPopup) // sets a popup on this marker
                .addTo(map);
        }

        function addMarker2(ltlng, event) {
            marker = new mapboxgl.Marker({draggable: true, color: "#194d19" })
                .setLngLat(user_place)
                .setPopup(markerPopup2) // sets a popup on this marker
                .addTo(map);
        }

        function addMarker3(ltlng, event) {
        marker = new mapboxgl.Marker({draggable: true, color: "#002699" })
        .setLngLat(hotel_city)
        .setPopup(markerPopup2) // sets a popup on this marker
        .addTo(map);
        }

       
</script>
@endsection