@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Slider', 'key' => 'create'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-md-6">
          <form action="{{ route('sliders.createSubmit') }}" method="POST" enctype="multipart/form-data"> 
              @csrf
              <div class="form-group">
                <label >Tên slider</label>
                <input type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên slider"
                  value="{{ old('name') }}"
                  required>
                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Hình ảnh</label>
                <input type="file" 
                  class="form-control-file @error('image_path') is-invalid @enderror" 
                  name="image_path"
                  required>
                  @error('image_path')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label>Mô tả</label>
              <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
