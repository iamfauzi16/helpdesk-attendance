@extends('layouts.app')

@section('title', 'Role Edit')

@section('header', 'Edit Role')

@section('content')
<div class="card">
  <div class="card-body">
      <form action="{{ route('update.role', $role) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="nameRole">Name Role</label>
                      <select id="nameRole" class="form-control @error('name_role') is-invalid @enderror"
                          name="name_role">
                          <option selected disabled>Pilih Role</option>
                          <option value="user">User</option>
                          <option value="admin">Admin</option>
                      </select>
                      @error('name_role')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

          </div>
          <button type="submit" class="btn btn-primary">Update Role</button>
          <a href="{{ route('index.role') }}" class="btn btn-danger">Kembali</a>
      </form>
  </div>
</div>
  
@endsection