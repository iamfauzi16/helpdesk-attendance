@extends('layouts.app')



@section('title', 'Logo Edit')

@section('header', 'Logo Edit')


@section('content')
<div class="card mb-4">

  <div class="card-body">
      <h5 class="mb-3">Edit Logo</h5>

      <form action="{{ route('administrator.update.logo', $logo) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
          @csrf
          <div class="row d-block">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="name_role">Web Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" placeholder="Blibli Helpdesk" value="{{ $logo->name }}">
                      @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                      <label for="image">Upload Logo Web</label>
                      <div class="input-group mb-3">

                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                   id="imageInput" aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="image" id="imageInputLabel">Choose file</label>
                        </div>
                      </div>
                      @error('image')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-primary">Update Logo</button>
          <a href="{{ route('administrator.index.logo') }}" class="btn btn-danger">Kembali</a>
      </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('imageInput').addEventListener('change', function() {
      var label = document.getElementById('imageInputLabel');
      if (this.files.length > 0) {
          label.textContent = this.files[0].name;
      } else {
          label.textContent = 'Choose file';
      }
  });
</script>
@endpush

