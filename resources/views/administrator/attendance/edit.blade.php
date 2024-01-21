@extends('layouts.app')

@section('title', 'Attendance Create Data')

@section('header', 'Attendance Create')

@section('content')
    <div class="card">
        <div class="card-body">
                <form action="{{ route('administrator.store.attendance') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="chooseUser">Choose User</label>
                        <select id="chooseUser" class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                            <option selected disabled>Pilih User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="check_in">Check In</label>
                        <input type="time" class="form-control @error('check_in') is-invalid @enderror" id="check_in" name="check_in"
                            >
                        @error('check_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="check_out">Check Out</label>
                        <input type="time" class="form-control @error('check_out') is-invalid @enderror" id="check_out" name="check_out"
                            >
                        @error('check_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text"
                            class="form-control @error('status')
                          is-invalid
                        @enderror"
                            id="status" placeholder="Status" name="status" >
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_time">Date Time</label>
                        <input type="date"
                            class="form-control @error('datetime')
                          is-invalid
                        @enderror"
                            id="date_time" name="datetime" >
                        @error('datetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="chooseUser">Choose Shift</label>
                      <select id="chooseUser" class="form-control @error('shift_attendance_id') is-invalid @enderror" name="shift_attendance_id">
                          <option selected disabled>Pilih Shift</option>
                          @foreach ($shiftAttendances as $shiftAttendance)
                              <option value="{{ $shiftAttendance->id }}">{{ $shiftAttendance->name_shift }}</option>
                          @endforeach
                      </select>
                      @error('shift_attendance_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                </form>
    
        </div>
    </div>
@endsection
