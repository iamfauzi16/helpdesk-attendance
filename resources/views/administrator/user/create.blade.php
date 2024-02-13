@extends('layouts.app')

@section('title', 'User Manager Create')

@section('header','Create User Manager')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.user-manager') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" placeholder="Full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="startTime" name="email" placeholder="email address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="password">Role</label>
                          <select id="roles" class="form-control @error('role_id') is-invalid @enderror"
                          name="role_id">
                          <option selected disabled>Pilih Role</option>
                          @foreach ( $roles as $role )
                          <option value="{{ $role->id }}">{{ $role->name_role }}</option>
                          @endforeach
                      </select>
                          @error('role_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  
                </div>
                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{ route('index.user-manager') }}" class="btn btn-danger">Kembali</a>

            </form>
        </div>
    </div>
@endsection
