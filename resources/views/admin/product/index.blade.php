@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/listProduct.css') }}">
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Product', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @can('product-create')
              <a href="{{ route('products.create') }}" class="btn btn-success float-right m-1">Add</a>
            @endcan
          </div>
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-3">Tên sản phẩm</th>
                    <th class="col-md-2">Hình ảnh</th>
                    <th class="col-md-2">Giá</th>
                    <th class="col-md-2">Danh mục</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="row">
                        <th class="col-md-1">{{ $product->id }}</th>
                            <td class="col-md-3">{{ $product->name }}</td>
                            <td class="col-md-2">
                                <img src="{{ $product->feature_image_path }}" class="product_image_setting" alt="">
                            </td>
                            <td class="col-md-2">${{ $product->price }}</td>
                            <td class="col-md-2">{{ optional($product->category)->name }}</td>
                            <td class="col-md-2">
                              @can('product-edit')
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
                              @endcan
                              @can('product-delete')
                                <a 
                                  href=""
                                  data-url="{{ route('products.delete', $product->id) }}"
                                  class="btn btn-danger action_delete">Delete</a>
                              @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $products->links() }}
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
