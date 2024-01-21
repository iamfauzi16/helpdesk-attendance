@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush


@section('title', 'Role')

@section('header', 'Role List')

@section('content')
    <div class="card mb-4">

        <div class="card-body">
            <h5 class="mb-3">Create Role</h5>

            <form action="{{ route('store.role') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name_role">Nama Role</label>
                            <input type="text" class="form-control @error('name_role') is-invalid @enderror"
                                id="name_role" name="name_role" placeholder="admin">
                            @error('name_role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Role</button>
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
                            <th scope="col">Name Role</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $role->name_role }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td class="d-flex wrap-action">
                                    <a href="{{ route('edit.role', $role) }}" class="btn btn-sm btn-primary"><i
                                            class="bi bi-pen"></i></a>
                                    <a href="{{ route('show.role', $role) }}" class="btn btn-sm btn-warning"><i
                                            class="bi bi-eye"></i></a>
                                    <form action="{{ route('destroy.role', $role) }}" method="POST">
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
