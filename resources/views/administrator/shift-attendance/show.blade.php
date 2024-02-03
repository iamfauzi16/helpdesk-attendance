@extends('layouts.app')

@section('title', 'Show Shift Attendance')

@section('header', 'Show Shift Attendance')

@section('content')
<div class="card">
  <div class="card-body">
      <form>
        <fieldset disabled>
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="nameShift">Shift Name</label>
                      <input type="text" class="form-control @error('start_time') is-invalid @enderror"
                          id="text" value="{{ $shiftAttendance->name_shift }}">
                     
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label for="startTime">Start Time</label>
                      <input type="time" class="form-control @error('start_time') is-invalid @enderror"
                          id="startTime" value="{{ $shiftAttendance->start_time }}">
                     
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label for="endTime">End Time</label>
                      <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                          id="endTime" value="{{ $shiftAttendance->end_time }}">
                    
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label for="chooseUser">Choose User</label>
                      <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                      id="endTime" value="{{ $shiftAttendance->user->name }}">
                     
                  </div>
              </div>
          </div>
       
        </fieldset>
        <a href="{{ route('index.shift-attendance') }}" class="btn btn-danger">Kembali</a>
      </form>
  </div>
</div>

@endsection