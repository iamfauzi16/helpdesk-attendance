@extends('layouts.app')

@php
    use App\Location;

    $locations = Location::first();
@endphp

@push('styles')
    <style>
        .wrap {
            background-color: rgb(0, 114, 255);
        }
      
        #map {
            min-height: 200px;

        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
       integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
@endpush

@section('title', 'Attendance Check In')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="map" class="rounded my-4"></div>
                        <div class="wrap-header p-0">
                            <div class="p-0">
                                <p class="badge badge-dark">{{ $shiftAttendance->name_shift }}</p>
                            </div>

                            <h3 class="font-weight-bold">Check In</h3>
                            <p class="text-secondary">Silahkan absen terlebih dahulu</p>

                        </div>

                        <form method="POST" action="{{ route('store.attendance') }}">
                            @csrf
                            <div class="wrap p-3 rounded-lg text-center">
                                <p class="text-white">Time</p>
                                <h1 id="realTime" class="font-weight-bold text-white"></h1>
                            </div>
                           
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" placeholder="...." id="longitude" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" placeholder="...." id="latitude" disabled>
                            </div>

                            <button class="btn btn-success btn-lg btn-block mt-4" type="submit">Check In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Gunakan CDN untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui waktu
            function updateWaktu() {
                var waktuSekarang = new Date();
                var jam = waktuSekarang.getHours();
                var menit = waktuSekarang.getMinutes();
                var detik = waktuSekarang.getSeconds();

                // Tambahkan nol di depan angka satu digit
                jam = padZero(jam);
                menit = padZero(menit);
                detik = padZero(detik);

                // Format waktu sebagai teks dan tambahkan ke elemen HTML
                var waktuText = jam + ":" + menit + ":" + detik;
                $("#realTime").text(waktuText);
            }

            // Fungsi untuk menambahkan nol di depan angka satu digit
            function padZero(angka) {
                return angka < 10 ? "0" + angka : angka;
            }

            // Panggil fungsi updateWaktu setiap detik
            setInterval(updateWaktu, 1000);
        });
    </script>
       <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
       integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
   <script>
       var map = L.map('map');
       var marker;

       function initMap() {
           map.setView([0, 0], 2); // Default view

           // Try to get user's location
           if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(
                   function(position) {
                       var userLatLng = [position.coords.latitude, position.coords.longitude];
                       map.setView(userLatLng, 13); // Set the view to the user's location
                       addMarker(userLatLng);
                   },
                   function(error) {
                       console.error('Error getting user location:', error);
                   }
               );
           }

           L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
               attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
           }).addTo(map);

           function addMarker(latlng) {
               if (marker) {
                   map.removeLayer(marker);
               }

               marker = L.marker(latlng, {
                   draggable: true
               }).addTo(map);

               marker.on('dragend', function(event) {
                   var position = marker.getLatLng();
                   document.getElementById('longitude').value = position.lng;
                   document.getElementById('latitude').value = position.lat;

                   getAddressFromCoordinates(position);
               });
           }

           // Fungsi untuk mengirim permintaan HTTP ke API Nominatim dan menampilkan alamat yang diperoleh
           function getAddressFromCoordinates(latlng) {
               var url = `https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json`;

               fetch(url)
                   .then(response => response.json())
                   .then(data => {
                       var address = data.display_name;
                       document.getElementById('address').value = address;
                   })
                   .catch(error => {
                       console.error('Error fetching address:', error);
                   });
           }

       }


       document.addEventListener('DOMContentLoaded', function() {
           initMap();
       });
   </script>
@endpush
