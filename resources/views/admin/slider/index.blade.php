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

    @include('partials.content-header', ['name' => 'Slider', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @can('slider-create')
              <a href="{{ route('sliders.create') }}" class="btn btn-success float-right m-1">Add</a>
            @endcan
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-3">Tên slider</th>
                    <th class="col-md-2">Hình ảnh</th>
                    <th class="col-md-4">Mô tả</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                        <tr class="row">
                        <th class="col-md-1">{{ $slider->id }}</th>
                            <td class="col-md-3">{{ $slider->name }}</td>
                            <td class="col-md-2">
                              <img src="{{ $slider->image_path }}" class="slider_image_setting" alt="">
                            </td>
                            <td class="col-md-4">{{ $slider->description }}</td>
                            <td class="col-md-2">
                              @can('slider-edit')
                                <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-info">Edit</a>
                              @endcan
                              @can('slider-delete')
                                <a 
                                  href=""
                                  data-url="{{ route('sliders.delete', $slider->id) }}"
                                  class="btn btn-danger action_delete">Delete</a>
                              @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $sliders->links() }}
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