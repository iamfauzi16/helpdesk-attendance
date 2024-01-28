@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush


@section('title', 'Cuti Form')

@section('header', 'Cuti Form')

@section('content')
    <div class="card mb-4">

        <div class="card-body">
            <h5 class="mb-3">Cuti Form</h5>

            <form action="{{ route('cuti-form.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name_role">User Name</label>
                            <select class="form-control @error('name_role') is-invalid @enderror"
                                id="user_id" name="user_id">
                            <option selected>Choose user</option>
                            <option value="{{ Auth()->user()->id }}">{{ Auth()->user()->name }}</option>

                            
                            </select>

                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason"></textarea>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  
                </div>
                <button type="submit" class="btn btn-primary">Submit Cuti</button>
            </form>
        </div>
    </div>
    <div>
        <div class="card">

            <div class="card-body">

                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col">Comment</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutiforms as $cutiform)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $cutiform->user->name }}</td>
                                <td>{{ $cutiform->start_date }}</td>
                                <td>{{ $cutiform->end_date }}</td>
                                <td>{{ $cutiform->reason }}</td>
                                <td>
                                    @if($cutiform->cutiAccept->status == 'Approve')
                                    <span class="badge badge-success">{{ $cutiform->cutiAccept->status }}</span>
                                    @elseif($cutiform->cutiAccept->status == 'Rejected')
                                    <span class="badge badge-danger">{{ $cutiform->cutiAccept->status }}</span>
                                    @else
                                    <span class="badge badge-secondary">{{ $cutiform->cutiAccept->status }}</span>

                                    @endif
                                </td>
                                <td>{{ $cutiform->cutiAccept->comment }}</td>

                                <td class="d-flex wrap-action">
                                    <a href="" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                    <a href="" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <form action="" method="POST">
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
