@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link href="{{ asset('admins/permission/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Permission', 'key' => 'create'])

    <!-- Main content -->
    <div class="content">
    <form action="{{ route('permissions.createSubmit') }}" method="POST">
        @csrf
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-md-6">
              <div class="form-group">
                <label>Chọn module</label>
                <select class="form-control" name="module_parent">
                  <option value="">Chọn module</option>
                  @foreach(config('permissions.module') as $module)
                    <option value="{{ $module }}">{{ $module }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col-md-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Chọn quyền cho module</label>
                        </div>
                    </div>
                    <div class="card text-white bg-info mb-3 col-md-12">
                        <div class="card-header">
                            <label>
                                <input type="checkbox" value="" class="check_all">
                            </label>
                            Check All
                        </div>
                        <div class="row">
                            @foreach(config('permissions.permission_module') as $permissionOfModule)
                            <div class="card-body col-md-3">
                                <h5 class="card-title">
                                    <label>
                                        <input type="checkbox" name="module_children[]" value="{{ $permissionOfModule }}" class="check_children">
                                    </label>
                                    {{ $permissionOfModule }}
                                </h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </form>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')
    <script src="{{ asset('admins/permission/add/add.js') }}"></script>
@endsection