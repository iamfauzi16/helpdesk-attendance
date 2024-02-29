<!-- resources/views/locations/create.blade.php -->

@extends('layouts.app')

@section('title', 'Location Settings')

@section('header', 'Add Location')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        #map {
            min-height: 200px;

        }

        .wrap-action {
            gap: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-body p-3">
            <div id="map" class="rounded my-4"></div>
            <form action="{{ route('administrator.store.location') }}" method="POST" id="locationForm">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude"
                        readonly>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">

        <div class="card-body">
            <h3 class="mb-4">List Location</h3>
            <div class="table-responsive">

                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $location->address }}</td>
                                <td>{{ $location->longitude }}</td>
                                <td>{{ $location->latitude }}</td>
                                <td class="d-flex wrap-action">
                                    <a href="#" class="btn btn-sm btn-primary d-none"><i class="bi bi-pen"></i></a>
                                    <a href="#" class="btn btn-sm btn-warning d-none"><i class="bi bi-eye"></i></a>
                                    <form action="{{ route('administrator.destroy.location', $location) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <script>
            let table = new DataTable('#myTable');
        </script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            let map = L.map('map');
            let marker;

            function initMap() {
                map.setView([0, 0], 2); // Default view

                // Try to get user's location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            let userLatLng = [position.coords.latitude, position.coords.longitude];
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
@endsection
