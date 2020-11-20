@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Order', 'key' => 'list'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-1">#</th>
                    <th class="col-md-4">Tên khách hàng</th>
                    <th class="col-md-2">Tổng giá tiền</th>
                    <th class="col-md-3">Tình trạng</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($allOrder as $orderItem)
                        <tr class="row">
                            <th class="col-md-1">{{ $orderItem->id }}</th>
                            <td class="col-md-4">{{ $orderItem->name }}</td>
                            <td class="col-md-2">${{ $orderItem->order_total }}</td>
                            <td class="col-md-3">{{ $orderItem->order_status }}</td>
                            <td class="col-md-2">
                                @can('order-detail')
                                  <a href="{{ route('order.detail', $orderItem->id) }}" class="btn btn-warning">Detail</a>
                                @endcan
                                {{-- @can('category-delete')
                                  <a 
                                    href=""
                                    data-url="{{ route('categories.delete', $orderItem->id) }}"
                                    class="btn btn-danger action_delete">Delete</a>
                                @endcan --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
         </div>
         <div class="col-md-12" style="display: flex;  justify-content: center; align-items: center; margin-bottom: 10px;">
             {{ $allOrder->links() }}
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
