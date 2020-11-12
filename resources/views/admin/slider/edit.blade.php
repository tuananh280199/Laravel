@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link href="{{ asset('admins/slider/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Slider', 'key' => 'edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-md-6">
          <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data"> 
              @csrf
              <div class="form-group">
                <label >Tên slider</label>
                <input type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên slider"
                  value="{{ $slider->name }}"
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
              <div class="container_image">
                <img src="{{ $slider->image_path }}" alt="" width="150px" height="120px">
              </div>
              <div class="form-group">
                <label>Mô tả</label>
              <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Nhập mô tả" rows="5" required>{{ $slider->description }}</textarea>
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
