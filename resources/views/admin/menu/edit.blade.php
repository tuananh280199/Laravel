@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Menu', 'key' => 'edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <form action="{{ route('menus.update', $menu->id) }}" method="POST">
              @csrf
              <div class="form-group">
                <label >Tên danh mục</label>
                <input type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên danh mục"
                  value="{{ $menu->name }}"
                  required>
                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label>Chọn menu cha</label>
                <select class="form-control" name="parent_id">
                  <option value="0">Chọn menu cha</option>
                  {!! $htmlOption !!}
                </select>
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
