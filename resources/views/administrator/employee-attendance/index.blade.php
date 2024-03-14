@extends('layouts.app')

@section('title', 'Employee Schedule')
@section('header', 'Employee Schedule')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <a href="#"  class="btn btn-primary d-none">Create Employee
                    Schedule</a>
            </div>
        </div>
        <hr class="sidebar-divider mb-3">

        <div id="calendar"></div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Edit Employee Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="scheduleForm" action="{{ route('store.employee-schedule') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="form-group">
                                <label for="chooseUser">Select User</label>
                                <select id="chooseUser" class="form-control" name="user_id">
                                    <option selected disabled>Pilih User</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Choose Status</label>
                                <select class="form-control" id="status" name="status" onchange="statusCondition()">
                                    <option disabled selected>Pilih Status</option>
                                    <option value="Masuk">Masuk</option>
                                    <option value="Libur">Libur</option>
                                    <option value="Ijin">Ijin</option>
                                    <option value="Cuti">Cuti</option>
                                </select>
                            </div>
                            <div class="form-group" id="shifting" style="display: none;">
                                <label for="chooseShiftAttendance">Select Shifting</label>
                                <select id="chooseShiftAttendance" class="form-control" name="shift_name">
                                    <option selected disabled>Pilih Shift</option>
                                    @foreach ($shiftAttendances as $shiftAttendance)
                                    <option value="{{ $shiftAttendance->name_shift }}">{{ $shiftAttendance->name_shift }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
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
        selectable: true,
        dayMaxEvents: true,
        dateClick: function(info) {
            document.getElementById('date').value = info.dateStr; 
            $('#myModal').modal('show');
        },
       
        eventClick: function(info) {
            var eventId = info.event;
            
            console.log(eventId);
            // if(eventObj){ 
            //     window.open("{{ route('create.employee-schedule') }}", "_blank");
            // }
        },
        events: @json($calendars),

    });
    calendar.render();
});

    
    

    function statusCondition() {
        let option = $('#status').val();

        if (option == "Masuk") {
            $('#shifting').show(); // Tampilkan dropdown shift jika status masuk dipilih
        } else {
            $('#shifting').hide(); // Sembunyikan dropdown shift jika status lain dipilih
        }
    }
</script>
@endpush
