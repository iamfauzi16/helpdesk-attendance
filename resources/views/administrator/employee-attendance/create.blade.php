@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush
@section('title', 'Create Employee Schedule')
@section('header', 'Create Employee Schedule')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.employee-schedule') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" value="{{ now()->format('Y-m-d') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="chooseUser">Select User</label>
                            <select id="chooseUser" class="form-control @error('user_id') is-invalid @enderror"
                                name="user_id">
                                <option selected disabled>Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Choose Status</label>
                            <select class="form-control" id="status" name="status">
                                <option disabled selected>Pilih Status</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Libur">Libur</option>
                                <option value="Ijin">Ijin</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12" id="shifting" style="display: none;">
                        <div class="form-group">
                            <label for="chooseShiftAttendance">Select Shifting</label>
                            <select id="chooseShiftAttendance"
                                class="form-control @error('shift_name') is-invalid @enderror" name="shift_name">
                                <option selected disabled>Pilih Shift</option>
                                @foreach ($shiftAttendances as $shiftAttendance)
                                    <option value="{{ $shiftAttendance->name_shift }}">{{ $shiftAttendance->name_shift }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Create Employee Schedule</button>
                    <a href="{{ route('index.employee-schedule') }}" class="btn btn-danger">Kembali</a>

                </div>

            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="my-3 d-none">
                <form action="{{ route('destroyAll.employee-schedule') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>

            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>User</td>
                        <td>Date</td>
                        <td>Shift Name</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeSchedules as $employeeSchedule)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employeeSchedule->user->name }}</td>

                            <td>{{ $employeeSchedule->date }}</td>
                            <td>{{ $employeeSchedule->shift_name }}</td>
                            <td>{{ $employeeSchedule->status }}</td>
                            <td class="d-flex wrap-action">
                                <a href="#"
                                    class="btn btn-sm btn-primary d-none"><i class="bi bi-pen"></i></a>
                                <a href="#"
                                    class="btn btn-sm btn-warning d-none"><i class="bi bi-eye"></i></a>
                                <form action="{{ route('destroy.employee-schedule', $employeeSchedule) }}" method="POST">
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


@endsection

@push('scripts')
    <script>
        function statusCondition() {
            let option = document.getElementById('status').value;

            if (option == "Masuk") {
                document.getElementById('shifting').style.display = "block";
            } else {
                document.getElementById('shifting').style.display = "none";
            }

        }

        document.getElementById('status').addEventListener('change', statusCondition);
        statusCondition();
    </script>
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
