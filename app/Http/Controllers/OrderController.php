<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $order;
    private $customer;
    private $shipping;
    private $order_details;

    function __construct(Order $order, Customer $customer, Shipping $shipping, OrderDetail $order_details)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->shipping = $shipping;
        $this->order_details = $order_details;
    }

    function index(Request $request)
    {
        $allOrder = $this->order
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name')
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(10);
        if ($request->name) {
            $allOrder = $this->order
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.*', 'customers.name')
                ->where('name', 'like', '%' . $request->name . '%')
                ->orderBy('orders.id', 'desc')
                ->simplePaginate(10);
        }
        if ($request->price) $allOrder = $this->order
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name')
            ->where('order_total', $request->price)
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(10);
        if ($request->status) $allOrder = $this->order
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name')
            ->where('order_status', 'like', '%' . $request->status . '%')
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(10);
        return view('admin.order.index', compact('allOrder'));
    }

    function detail($id)
    {
        $order = $this->order->find($id);
        $order_customer = $this->customer->find($order->customer_id);
        $order_shipping = $this->shipping->find($order->shipping_id);
        $order_details = $this->order_details->where('order_id', $order->id)->get();
        return view('admin.order.detail', compact('order_customer', 'order_shipping', 'order_details'));
    }
}
