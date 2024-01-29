@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <style>
        .wrap-action {
            gap: 6px;
        }
    </style>
@endpush


@section('title', 'Logo List')

@section('header', 'Logo List')

@section('content')
    <div class="card mb-4">

        <div class="card-body">
            <h5 class="mb-3">Create Logo</h5>

            <form action="{{ route('administrator.store.logo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row d-block">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_role">Web Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Blibli Helpdesk">
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
                <button type="submit" class="btn btn-primary">Create Logo</button>
            </form>
        </div>
    </div>
    <div>
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name Web</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logos as $logo)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $logo->name }}</td>
                                    <td>
                                        <img src="{{ url('/' . $logo->image) }}" style="max-width: 48px;">
    
                                    </td>
                                    
                                    <td class="d-flex wrap-action">
                                        <a href="{{ route('administrator.edit.logo', $logo) }}" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                                        <a href="{{ route('administrator.show.logo', $logo) }}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                        <form action="{{ route('administrator.destroy.logo', $logo) }}" method="POST">
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
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
