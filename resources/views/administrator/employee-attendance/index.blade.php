@extends('layouts.app')

@section('title', 'Employee Schedule')
@section('header', 'Employee Schedule')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-6">
        <a href="{{ route('create.employee-schedule') }}" class="btn btn-primary">Create Employee Schedule</a>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="exampleInputEmail1">Sorting</label>
          <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
      </div>
     
    </div>
    
  
   
    @foreach ($employeeScheduleGroups as $userId => $employeeSchedules)
    <div class="card my-3">
      <div class="card-body" >
        <h3>{{ $userId }}</h3>
        <div class="row mt-3">
        @foreach ( $employeeSchedules as $index )
          <div class="col-md-2">
            <p>{{ $index->date }}</p>
            <p>{{ $index->status == 1 ? 'Masuk' : 'Libur' }}</p>
          </div>
        @endforeach
          
        </div>
    
    
      </div>
    </div>
    @endforeach
  </div>
</div>


@endsection