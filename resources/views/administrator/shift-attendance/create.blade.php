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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="chooseUser">Choose User</label>
                            <select id="chooseUser" class="form-control @error('user_id') is-invalid @enderror"
                                name="user_id">
                                <option selected disabled>Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 d-none">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select id="location" class="form-control @error('location_id') is-invalid @enderror"
                                name="location_id">
                                <option selected disabled>Pilih Lokasi</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->address }}</option>
                                @endforeach

                            </select>
                            @error('location_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Shift</button>
            </form>
        </div>
    </div>
@endsection
