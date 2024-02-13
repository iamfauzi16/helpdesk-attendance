@extends('layouts.app')

@section('title','Shift Attendance Edit')

@section('header','Edit Shift Attendance')

@section('content')
  <div class="card">
        <div class="card-body">
            <form action="{{ route('update.shift-attendance', $shiftAttendance) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameShift">Shift Name</label>
                            <select id="nameShift" class="form-control @error('name_shift') is-invalid @enderror"
                                name="name_shift" value="{{ $shiftAttendance->name_shift }}">
                                <option disabled>Pilih Shift</option>
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
                                id="startTime" name="start_time" value="{{ $shiftAttendance->start_time }}">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="endTime">End Time</label>
                            <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                id="endTime" name="end_time" value="{{ $shiftAttendance->end_time }}">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="chooseUser">Choose User</label>
                            <select id="chooseUser" class="form-control @error('user_id') is-invalid @enderror">
                            <option selected disabled>Pilih User</option>
        
                                <option value="{{ $shiftAttendance->user->id }}" selected>{{ $shiftAttendance->user->name }}</option>
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('index.shift-attendance') }}" class="btn btn-danger">Kembali</a>

            </form>
        </div>
    </div>
@endsection