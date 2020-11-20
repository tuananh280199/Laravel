@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Product', 'key' => 'create'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <form action="{{ route('products.createSubmit') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label >Tên sản phẩm</label>
                <input type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên sản phẩm"
                  value="{{ old('name') }}"
                  required>
                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Ảnh đại diện</label>
                <input type="file" 
                  class="form-control-file @error('feature_image_path') is-invalid @enderror" 
                  name="feature_image_path"
                  required>
                  @error('feature_image_path')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Ảnh chi tiết</label>
                <input type="file" 
                  class="form-control-file @error('image_path[]') is-invalid @enderror" 
                  name="image_path[]"
                  multiple>
                  @error('image_path[]')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Giá sản phẩm</label>
                <input type="number" 
                  step=0.01
                  class="form-control @error('price') is-invalid @enderror" 
                  name="price"
                  placeholder="Nhập giá sản phẩm"
                  value="{{ old('price') }}"
                  required>
                  @error('price')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label>Nhập tags</label>
                <select 
                  class="form-control tags_select"
                  name="tags[]"
                  multiple="multiple">
                </select>
              </div>
              <div class="form-group">
                <label>Chọn danh mục</label>
                <select class="form-control @error('category_id') is-invalid @enderror select2_cate" name="category_id" required>
                  <option value=""></option>
                  {!! $htmlOption !!}
                </select>
                @error('category_id')
                  <div class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>
              <div class="form-group">
                <label>Nhập nội dung</label>
              <textarea class="form-control @error('contents') is-invalid @enderror" name="contents" rows="5" placeholder="Nhập nội dung" required>{{ old('contents') }}</textarea>
                @error('contents')
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

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection
