@extends('layouts.app')

@push('styles')

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush


@section('title', 'My Profile')

@section('header','My Profile')

@section('content')
<div>
  <div class="card">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($myprofiles as $myprofile)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $myprofile->name }}</td>
                            <td>{{ $myprofile->email }}</td>
                            <td>{{ $myprofile->role->name_role }}</td>
                            <td>{{ $myprofile->created_at }}</td>
                            <td>{{ $myprofile->updated_at }}</td>
  
                            <td class="d-flex wrap-action">
                                <a href="{{ route('administrator.edit.my-profile', $myprofile) }}" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                
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
</div>

@endsection

