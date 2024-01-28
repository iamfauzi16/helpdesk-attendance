@extends('layouts.app')

@section('title','Cuti Accept Update')

@section('header','Cuti Accept Update')

@section('content')
  <div class="card">
        <div class="card-body">
            <form action="{{ route('administrator.update.cuti-accept', $cutiAccept) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cutiFormUser">User</label>
                            <input type="text" class="form-control"
                                id="cutiFormUser"value="{{ $cutiAccept->cutiForm->user->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-32">
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                         
                            <input type="text" class="form-control"
                                id="startDate" value="{{ $cutiAccept->cutiForm->start_date }}" disabled>
                         
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="text" class="form-control"
                                id="endDate" value="{{ $cutiAccept->cutiForm->end_date }}" disabled>
                         
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control"
                                id="endDate" value="{{ $cutiAccept->cutiForm->status }}" disabled>
                         
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="reason">End Date</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $cutiAccept->cutiForm->reason }}</textarea>
                           
                         
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="startTime">Comment</label>
                            <input type="text" class="form-control @error('comment') is-invalid @enderror"
                                id="startTime" name="comment" value="{{ $cutiAccept->comment }}">
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                </div>
                <a href="{{ route('administrator.index.cuti-accept') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection