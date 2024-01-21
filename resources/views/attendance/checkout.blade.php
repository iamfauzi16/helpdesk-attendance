@extends('layouts.app')

@push('styles')
    <style>
        .wrap {
            background-color: rgb(0, 114, 255);
        }
    </style>
@endpush

@section('title', 'Attendance Check Out')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="wrap-header p-0">
                            <h3 class="font-weight-bold">Check Out</h3>
                            <p class="text-secondary">Silahkan absen keluar terlebih dahulu</p>
                        </div>
                        <div class="wrap-check-in-history rounded-lg text-center bg-light mb-2">
                            <p class="text-secondary">Absen Hari ini  <i class="bi bi-clock-history"></i></p>
                            <h3>{{ $attendance->check_in }}</h3>  
                        </div>
                        
                        <form method="POST" action="{{ route('update.attendance', $attendance->id) }}">
                            @method('put')
                            @csrf
                            
                            <div class="wrap p-3 rounded-lg text-center">
                                <p class="text-white">Time</p>
                                <h1 id="realTime" class="font-weight-bold text-white"></h1>    
                            </div>
                            
        
                            <button class="btn btn-success btn-lg btn-block mt-4" type="submit">Check Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection

@push('scripts')
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
@endpush
