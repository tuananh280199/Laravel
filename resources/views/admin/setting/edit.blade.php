@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Setting', 'key' => 'edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <form action="{{ route('settings.update', $setting->id) }}" method="POST">
              @csrf
              <div class="form-group">
                <label >Config key</label>
                <input type="text" 
                  class="form-control @error('config_key') is-invalid @enderror" 
                  name="config_key"
                  value="{{ $setting->config_key }}"
                  placeholder="Nhập config key"
                  >
                  @error('config_key')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Config value</label>
                <textarea type="text" 
                  class="form-control @error('config_value') is-invalid @enderror" 
                  name="config_value"
                  placeholder="Nhập config value"
                  rows="5"
                  >{{ $setting->config_value }}</textarea>
                  @error('config_value')
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
