@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/listSlider.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Role', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @can('role-create')
              <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-1">Add</a>
            @endcan
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-4">Tên vai trò</th>
                    <th class="col-md-5">Mô tả</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr class="row">
                        <th class="col-md-1">{{ $role->id }}</th>
                            <td class="col-md-4">{{ $role->name }}</td>
                            <td class="col-md-5">{{ $role->display_name }}</td>
                            <td class="col-md-2">
                              @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                              @endcan
                              @can('role-delete')
                                <a 
                                  href=""
                                  data-url="{{ route('roles.delete', $role->id) }}"
                                  class="btn btn-danger action_delete">Delete</a>
                              @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $roles->links() }}
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
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('admins/index.js') }}"></script>
@endsection