@extends('layouts.app')

@section('title', 'Shift Attendance Create')

@section('header', 'Create Shift Attendance')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.shift-attendance') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameShift">Shift Name</label>
                            <select id="nameShift" class="form-control @error('name_shift') is-invalid @enderror"
                                name="name_shift">
                                <option selected disabled>Pilih Shift</option>
                                <option value="Shift Pagi">Shift Pagi</option>
                                <option value="Shift Sore">Shift Sore</option>
                            </select>
                            @error('name_shift')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="startTime">Start Time</label>
                            <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                                id="startTime" name="start_time">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="endTime">End Time</label>
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                id="endTime" name="end_time">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Shift</button>
                <a href="{{ route('index.shift-attendance') }}" class="btn btn-danger">Kembali</a>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Mendengarkan perubahan pada pilihan shift
    document.getElementById('nameShift').addEventListener('change', function() {
        var selectedShift = this.value;

        // Mendapatkan elemen input untuk waktu mulai dan waktu akhir
        var startTimeInput = document.getElementById('startTime');
        var endTimeInput = document.getElementById('endTime');

        // Setel waktu mulai dan waktu akhir berdasarkan pilihan shift
        if (selectedShift === 'Shift Pagi') {
            startTimeInput.value = '07:00';
            endTimeInput.value = '16:00';
        } else if (selectedShift === 'Shift Sore') {
            startTimeInput.value = '16:00';
            endTimeInput.value = '00:00';
        }
    });
</script>
@endpush

