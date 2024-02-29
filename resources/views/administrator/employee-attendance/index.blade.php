@extends('layouts.app')

@section('title', 'Employee Schedule')
@section('header', 'Employee Schedule')



@section('content')
<div class="card mb-3">
  <div class="card-body">
    <div class="row align-items-center">
      <div class="col-md-6">
        <a href="{{ route('create.employee-schedule') }}" class="btn btn-primary">Create Employee Schedule</a>
      </div>
    </div>
    <hr class="sidebar-divider mb-3">
    
    <div id="calendar"></div>
   
    {{-- @foreach ($employeeScheduleGroups as $userId => $employeeSchedules)
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
    @endforeach --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Edit Employee Schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" onchange="dateValue()">
              </div>

              <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" id="title" name="date" onchange="titleValue()">
              </div>

              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" onchange="dateValue()">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            <a href="{{ route('create.employee-schedule') }}" class="btn btn-success btn-sm">Create Employee Schedule</a>
            <button type="button" class="btn btn-primary btn-sm">Save changes</button>
          </div>
        </div>
      </div>
    </div>


@endsection
@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          events: @json($calendars),
          initialView: 'dayGridMonth',

          eventClick: function(info) {
            function dateValue () {
              let dateValue = document.getElementById('date');
              dateValue.value = info.event.startStr;
            }
            function titleValue() {
              let titleValue = document.getElementById('title');
              titleValue.value = info.event.title;
            }
            
            dateValue()
            titleValue()
          
            // alert('Event: ' + info.event.title);
            $('#myModal').modal('show')

          }
        });
        calendar.render();
      });
</script>
@endpush
