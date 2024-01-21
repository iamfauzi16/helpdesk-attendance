@extends('layouts.app')
@section('title', 'Shift Attendance')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush

@section('header', 'Shift Attendance')


@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('create.shift-attendance') }}" class="btn btn-primary  mb-4">Create Shift</a>
            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name Shift</th>
                            <th scope="col">Start TIme</th>
                            <th scope="col">End Time</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shiftAttendances as $shiftAttendance)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $shiftAttendance->name_shift }}</td>
                                <td>{{ $shiftAttendance->start_time }}</td>
                                <td>{{ $shiftAttendance->end_time }}</td>
                                <td>{{ $shiftAttendance->user->name }}</td>
                        
                                <td class="d-flex wrap-action">
                                    <a href="{{ route('edit.shift-attendance', $shiftAttendance) }}"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                    <a href="{{ route('show.shift-attendance', $shiftAttendance) }}"
                                        class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <form action="{{ route('destroy.shift-attendance', $shiftAttendance) }}"
                                        method="POST">
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
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
