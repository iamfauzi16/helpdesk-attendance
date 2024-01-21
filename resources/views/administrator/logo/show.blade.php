@extends('layouts.app')


@section('title', 'Logo Show')

@section('header', 'Logo Show')

@section('content')
    <div class="card mb-4">

        <div class="card-body">
          <h5 class="mb-3">Show Logo</h5>
                <div class="row d-block">
                  <fieldset disabled>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_role">Web Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Blibli Helpdesk" value="{{ $logo->name }}">
                          
                        </div>
                    </div>

                    <div class="col-md-6">
                      <img src="{{ url('/'. $logo->image) }}" class="img-thumbnail" alt="image-logo" style="width: 200px;">
                    </div>
                </div>
              </fieldset>
                <a class="btn btn-danger mt-4" href="{{ route('administrator.index.logo') }}">Kembali</a>
        </div>
    </div>
   
@endsection
