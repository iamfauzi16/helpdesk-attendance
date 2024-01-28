@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush

@section('title', 'Cuti Accept')

@section('header', 'Cuti Approvel List')

@section('content')
    <div class="card">
        <div class="card-body">
         
            <div class="table-responsive">
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
                            <th scope="col">Action Approvel</th>
    
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutiAccepts as $cutiAccept)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $cutiAccept->cutiForm->user->name }}</td>
                                <td>{{ $cutiAccept->cutiForm->start_date }}</td>
                                <td>{{ $cutiAccept->cutiForm->end_date }}</td>
                                <td>{{ $cutiAccept->cutiForm->reason }}</td>
                                <td>
                                    @if ($cutiAccept->status == 'Approve')
                                        <span class="badge badge-success">{{ $cutiAccept->status }}</span>
                                    @elseif ($cutiAccept->status == 'Rejected')
                                        <span class="badge badge-danger">{{ $cutiAccept->status }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $cutiAccept->status }}</span>
                                       
                                    @endif
    
                                </td>
                                <td>{{ $cutiAccept->comment }}</td>
    
                                <td>
                                    <form action={{ route('administrator.update.cuti-accept', $cutiAccept) }} method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input class="btn btn-primary btn-sm" type="submit" value="Approve" name="comment"
                                            {{ $cutiAccept->status == 'Approve' || $cutiAccept->status == 'Rejected' ? 'disabled' : '' }}>
    
                                        <input class="btn btn-danger btn-sm" type="submit" value="Rejected" name="comment"
                                            {{ $cutiAccept->status == 'Approve' || $cutiAccept->status == 'Rejected' ? 'disabled' : '' }}>
    
                                        {{-- <td><span class="{{ $cutiAccept->status == 'Approve' ? 'badge badge-success' : '' }}">{{ $cutiAccept->status }}</span></td> --}}
    
                                    </form>
                                </td>
    
                                <td class="d-flex wrap-action">
                                    <a href="{{ route('administrator.edit.cuti-accept', $cutiAccept) }}"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                    <a href="" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <form action="{{ route('administrator.destroy.cuti-accept', $cutiAccept) }}" method="POST">
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
@endsection()

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
