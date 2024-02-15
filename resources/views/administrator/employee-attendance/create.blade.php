@extends('layouts.app')
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
                      <input type="date" class="form-control @error('date') is-invalid @enderror"
                          id="date" name="date" value="{{ now()->format('Y-m-d') }}">
                      @error('date')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                      <label for="status">Status</label>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" class="custom-control-input @error('status') is-invalid @enderror" name="status" value="1">
                        <label class="custom-control-label" for="customRadio1">Masuk</label>
                        @error('status')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" class="custom-control-input @error('status') is-invalid @enderror" name="status" value="0">
                        <label class="custom-control-label" for="customRadio2">Libur</label>
                        @error('status')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      
                      
                   
                  </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                    <label for="chooseUser">Choose User</label>
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

          
            
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Create Employee Schedule</button>
            <a href="{{ route('index.employee-schedule') }}" class="btn btn-danger">Kembali</a>
  
          </div>
         
      </form>
  </div>
</div>
@endsection