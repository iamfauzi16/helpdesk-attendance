@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>                                                                                    
@endpush


@section('title', 'Dashboard Attendance')

@section('header', 'Attendance List')

@section('content')
    <div>
        <div class="card">

            <div class="card-body">
                <div>
                    <a href="{{ route('administrator.create.attendance') }}" class="btn btn-primary my-3">Create Attendance</a>
                    <a href="{{ route('export.excel.attendance') }}" class="btn btn-success my-3" target="_blank" style="float: right;">EXPORT EXCEL</a>
                </div>
             

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
                            <th scope="col">Action</th>

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
                                <td class="d-flex wrap-action">
                                    <a href="" class="btn btn-sm btn-primary"><i
                                            class="bi bi-pen"></i></a>
                                    <a href="" class="btn btn-sm btn-warning"><i
                                            class="bi bi-eye"></i></a>
                                    <form action="{{ route('administrator.destroy.attendance', $attendance) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
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

