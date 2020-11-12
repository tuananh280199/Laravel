@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link href="{{ asset('admins/role/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'Role', 'key' => 'create'])

    <!-- Main content -->
    <div class="content">
        <form action="{{ route('roles.createSubmit') }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Tên vai trò</label>
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
                            <label>Mô tả</label>
                            <textarea class="form-control @error('display_name') is-invalid @enderror" name="display_name" rows="5" placeholder="Nhập mô tả" required>{{ old('display_name') }}</textarea>
                            @error('display_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="check_all">
                                    </label>
                                    Check All
                                </div>
                                @foreach($permissionsParent as $permissionParent)
                                <div class="card text-white bg-info mb-3 col-md-12">
                                    <div class="card-header">
                                        <label>
                                            <input type="checkbox" value="" class="check_wrapper">
                                        </label>
                                        Module {{ $permissionParent->name }}
                                    </div>
                                    <div class="row">
                                        @foreach($permissionParent->permissionsChildren as $permissionChildren)
                                            <div class="card-body col-md-3">
                                                <h5 class="card-title">
                                                    <label>
                                                        <input type="checkbox" class="check_children" name="permission_id[]" value="{{ $permissionChildren->id }}">
                                                    </label>
                                                    {{ $permissionChildren->name }}
                                                </h5>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
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
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection
