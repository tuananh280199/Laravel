@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  @include('partials.content-header', ['name' => 'User', 'key' => 'edit'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row"> 
          <div class="col-md-6">
          <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"> 
              @csrf
              <div class="form-group">
                <label >Tên User</label>
                <input type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên user"
                  value="{{ $user->name }}"
                  required>
                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Email</label>
                <input type="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  name="email"
                  placeholder="Nhập email"
                  value="{{ $user->email }}"
                  required>
                  @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Password</label>
                <input type="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  name="password"
                  placeholder="Nhập password"
                  required>
                  @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              </div>
              <div class="form-group">
                <label >Chọn vai trò</label>
                <select class="form-control select2_role" name="role_id[]" multiple>
                    <option value=""></option>
                    @foreach($roles as $role)
                        <option 
                            value="{{ $role->id }}"
                            {{ $roleOfUser->contains('id', $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
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

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection
