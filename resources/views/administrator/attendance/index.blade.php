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
                    <a href="{{ route('administrator.create.attendance') }}" class="btn btn-primary my-3">Create
                        Attendance</a>
                    {{-- <a href="{{ route('export.excel.attendance') }}" class="btn btn-success my-3" target="_blank"
                        style="float: right;">EXPORT EXCEL</a> --}}
                </div>

                <div class="wrap-export">
                    <div class="mb-4">
                        <form action="{{ route('administrator.export-by-month.attendance') }}" method="post">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col">
                                    <select name="selectMonth" id="selectMonth" class="form-control">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">July</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                
                                <div class="col">
                                    <div class="dropdown">
                                        <a class="btn btn-dark dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-expanded="false">
                                            Export Choose
                                        </a>

                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" type="submit">Export Month</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>


                <div class="table-responsive">
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
                                        <span
                                            class="badge badge-primary">{{ $attendance->shiftAttendance->name_shift }}</span>
                                    </td>
                                    <td class="d-flex wrap-action">
                                        <a href="" class="btn btn-sm btn-primary d-none"><i class="bi bi-pen"></i></a>
                                        <a href="" class="btn btn-sm btn-warning d-none"><i class="bi bi-eye"></i></a>
                                        <form action="{{ route('administrator.destroy.attendance', $attendance) }}"
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
