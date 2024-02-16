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

            // Fungsi untuk mendapatkan koordinat dari Nominatim API
            function getCoordinatesFromAddress(address) {
                fetch(`https://nominatim.openstreetmap.org/search?q=${address}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            // Ambil latitude dan longitude dari respons
                            const latitude = data[0].lat;
                            const longitude = data[0].lon;
                            
                            // Update nilai input dengan koordinat yang ditemukan
                            $("#latitude").val(latitude);
                            $("#longitude").val(longitude);
                        } else {
                            console.log('Alamat tidak ditemukan');
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            }

            // Panggil fungsi getCoordinatesFromAddress saat dokumen siap
            $(document).ready(function() {
                const address = "JAKARTA"; // Ganti dengan alamat yang ingin Anda cari
                getCoordinatesFromAddress(address);
            });
        });
    </script>
@endpush
