@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@php
    use App\ShiftAttendance;
    use App\Attendance;

    $shiftAttendance = ShiftAttendance::where('user_id', auth()->user()->id)->first();
    $attendance = Attendance::where('user_id', auth()->user()->id)->first();
    $currentTime = now();
@endphp



@section('title', 'Attendances List')

@section('header', 'Attendance List')

@section('content')
    <div>
        <div class="card">

            <div class="card-body">
               
                @if ((strtotime(now()) > strtotime($shiftAttendance->start_time)) && ($shiftAttendance->name_shift == 'Shift Pagi' || $shiftAttendance->name_shift == 'Shift Sore'))
                @if ($attendance)
                   
                @else
                    <a href="{{ route('create.attendance') }}" class="btn btn-success mb-3">
                        Check In
                    </a>
                @endif
            @endif
            

                <a href="{{ route('export.excel.attendance') }}" class="btn btn-success my-3" target="_blank"
                    style="float: right;">EXPORT EXCEL</a>

                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Shift</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $attendance->user->name }}</td>
                                <td>{{ $attendance->check_in }}</td>
                                <td>{{ $attendance->check_out }}</td>
                                <td>
                                    <span
                                        class="{{ $attendance->status == 'Masuk' ? 'badge badge-success' : 'badge badge-danger' }}">
                                        {{ $attendance->status }}
                                    </span>
                                </td>
                                <td>{{ $attendance->datetime }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $attendance->shiftAttendance->name_shift }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable();
        });
    </script>
@endpush
