@extends('layouts.app')

@section('title', 'Role Show')

@section('header', 'Show Role')

@section('content')
<div class="card">
  <div class="card-body">
      <form>
        <fieldset disabled>
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="nameRole">Name Role</label>
                      <input type="text" class="form-control"
                          id="nameRole" value="{{ $role->name_role }}">
                     
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label for="createdAt">Created At</label>
                      <input type="text" class="form-control"
                          id="createAt" value="{{ $role->created_at }}">
                  </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                    <label for="updatedAt">Updated At</label>
                    <input type="text" class="form-control"
                        id="updatedAt" value="{{  $role->updated_at }}">
                </div>
            </div>
          </div>
       
        </fieldset>
        <a href="{{ route('index.role') }}" class="btn btn-danger">Kembali</a>
      </form>
  </div>
</div>
  
@endsection