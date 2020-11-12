@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Setting', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <a href="{{ route('settings.create') }}" class="btn btn-success float-right m-1">Add</a>
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-4">Config Key</th>
                    <th class="col-md-5">Config Value</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($settings as $setting)
                        <tr class="row">
                            <th class="col-md-1">{{ $setting->id }}</th>
                            <td class="col-md-4">{{ $setting->config_key }}</td>
                            <td class="col-md-5">{{ $setting->config_value }}</td>
                            <td class="col-md-2">
                                <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-info">Edit</a>
                                <a 
                                  href=""
                                  data-url="{{ route('settings.delete', $setting->id) }}"
                                  class="btn btn-danger action_delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $settings->links() }}
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