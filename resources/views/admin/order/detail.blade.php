@extends('layouts.admin')

@section('title')
    <title>Admin</title>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Order Detail', 'key' => 'detail'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12">
            <table class="table">
                <div style="font-size: 1.4em; font-weight: 500; margin-bottom: 10px; text-align: center;">Thông tin khách hàng</div>
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-6">Tên khách hàng</th>
                    <th class="col-md-6">Số điện thoại</th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="row">
                        <td class="col-md-6">{{$order_customer->name}}</td>
                        <td class="col-md-6">{{$order_customer->phone}}</td>
                    </tr>
                </tbody>
              </table>
         </div>
         <hr width="95%">
         <br><br>
         <div class="col-md-12">
            <table class="table">
                <div style="font-size: 1.4em; font-weight: 500; margin-bottom: 10px; text-align: center;">Thông tin gửi hàng</div>
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-3">Tên khách hàng</th>
                    <th class="col-md-3">Địa chỉ</th>
                    <th class="col-md-2">Số điện thoại</th>
                    <th class="col-md-4">Ghi chú</th>
                  </tr>
                </thead>
                <tbody>
                        <tr class="row">
                            <td class="col-md-3">{{$order_shipping->shipping_name}}</td>
                            <td class="col-md-3">{{$order_shipping->shipping_address}}</td>
                            <td class="col-md-2">{{$order_shipping->shipping_phone}}</td>
                            <td class="col-md-4">{{$order_shipping->shipping_note}}</td>
                        </tr>
                </tbody>
              </table>
         </div>
         <hr width="95%">
         <br><br>
         <div class="col-md-12">
            <table class="table">
                <div style="font-size: 1.4em; font-weight: 500; margin-bottom: 10px; text-align: center;">Chi tiết đơn hàng</div>
                <thead class="thead-light">
                  <tr class="row">
                    <th class="col-md-2">Id sản phẩm</th>
                    <th class="col-md-3">Tên sản phẩm</th>
                    <th class="col-md-2">Số lượng</th>
                    <th class="col-md-2">Đơn giá</th>
                    <th class="col-md-3">Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($order_details as $orderDetailItem)
                        <tr class="row">
                            <th class="col-md-2">{{$orderDetailItem->product_id}}</th>
                            <td class="col-md-3">{{$orderDetailItem->product_name}}</td>
                            <td class="col-md-2">{{$orderDetailItem->product_quantity}}</td>
                            <td class="col-md-2">${{$orderDetailItem->product_price}}</td>
                            <td class="col-md-3">${{$orderDetailItem->product_quantity * $orderDetailItem->product_price}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
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
