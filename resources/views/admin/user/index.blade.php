@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'User', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7">
            <form class="form-inline d-flex active-pink-4 m-1" action="{{ route('users.index') }}">
              <input value="{{ \Request::get('name') }}" name="name" class="form-control form-control-sm d-flex" type="text" placeholder="Name user" aria-label="Name" style="margin-right: 5px">
              <button class="btn btn-outline-danger btn-rounded btn-sm my-0 waves-effect waves-light" type="submit">Search</button>
            </form>
          </div>
          <div class="col-md-5">
            @can('user-create')
              <a href="{{ route('users.create')}}" class="btn btn-success float-right m-1">Add</a>
            @endcan
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-5">Tên User</th>
                    <th class="col-md-4">Email</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="row">
                        <th class="col-md-1">{{ $user->id }}</th>
                            <td class="col-md-5">{{ $user->name }}</td>
                            <td class="col-md-4">{{ $user->email }}</td>
                            <td class="col-md-2">
                              @can('user-edit')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                              @endcan
                              @can('user-delete')
                                <a 
                                  href=""
                                  data-url="{{ route('users.delete', $user->id) }}"
                                  class="btn btn-danger action_delete">Delete</a>
                              @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $users->links() }}
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