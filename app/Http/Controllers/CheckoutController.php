<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{

    private $customer;
    private $category;
    private $shipping;
    private $payment;
    private $order;
    private $order_detail;

    function __construct(Category $category, Customer $customer, Shipping $shipping, Payment $payment, Order $order, OrderDetail $order_detail)
    {
        $this->category = $category;
        $this->customer = $customer;
        $this->shipping = $shipping;
        $this->payment = $payment;
        $this->order = $order;
        $this->order_detail = $order_detail;
    }

    function index()
    {
        $customer_id = session()->get('customer_id');
        $carts = session()->get('cart');
        if (isset($carts) && isset($customer_id) && count($carts) > 0) {
            $categories = $this->category->where('parent_id', 0)->get();
            return view('client.checkout.index', compact('categories'));
        } else {
            return redirect()->route('cart');
        }
    }

    function loginCheckout()
    {
        $customer_id = session()->get('customer_id');
        if (isset($customer_id)) {
            return redirect()->route('checkout.index');
        } else {
            $categories = $this->category->where('parent_id', 0)->get();
            return view('client.checkout.login', compact('categories'));
        }
    }

    function logoutCheckout()
    {
        session()->forget('customer_id'); // xóa session 
        session()->forget('login_fail');
        return redirect()->route('checkout.login');
    }

    function registerCheckout(Request $request)
    {
        // session()->forget('customer_id'); // xóa session 
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'phone' => $request->phone
        ];
        $this->customer->create($data);
        return redirect()->route('checkout.login');
    }

    function loginCustomer(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $result = $this->customer->where('email', $email)->where('password', $password)->first();
        if ($result) {
            session()->put('customer_id', $result->id);
            return redirect()->route('checkout.index');
        } else {
            session()->put('login_fail', 'Email Or Password Wrong !');
            return redirect()->route('checkout.login');
        }
    }

    function saveCheckoutCustomer(Request $request)
    {
        $data = [
            'shipping_name' => $request->name,
            'shipping_email' => $request->email,
            'shipping_phone' => $request->phone,
            'shipping_address' => $request->address,
            'shipping_note' => $request->note,
        ];
        $shipping =  $this->shipping->create($data);
        session()->put('shipping_id', $shipping->id);
        return redirect()->route('checkout.payment');
    }

    function payment()
    {
        $categories = $this->category->where('parent_id', 0)->get();
        return view('client.checkout.payment', compact('categories'));
    }

    function sendOrder(Request $request)
    {
        //get payment method
        $data_payment = [
            'payment_method' => $request->payment_option,
            'payment_status' => 'Waiting for processing',
        ];
        $payment =  $this->payment->create($data_payment);
        $total = 0;
        $carts = session()->get('cart');
        foreach ($carts as $cartItem) {
            $total += $cartItem['price'] * $cartItem['quantity'];
        }
        $data_order = [
            'customer_id' => session()->get('customer_id'),
            'shipping_id' => session()->get('shipping_id'),
            'payment_id' => $payment->id,
            'order_total' => $total,
            'order_status' => 'Waiting for processing',
        ];
        $order =  $this->order->create($data_order);
        foreach ($carts as $cartItem) {
            $data_orderDetail = [
                'order_id' => $order->id,
                'product_id' => $cartItem['id'],
                'product_name' => $cartItem['name'],
                'product_price' => $cartItem['price'],
                'product_quantity' => $cartItem['quantity'],
            ];
            $result = $this->order_detail->create($data_orderDetail);
        }
        if ($data_payment['payment_method'] == 1) {
            session()->forget('cart');
            echo 'Pay via ATM card';
        } else if ($data_payment['payment_method'] == 2) {
            session()->forget('cart');
            $categories = $this->category->where('parent_id', 0)->get();
            return view('client.checkout.handcash', compact('categories'));
        } else {
            session()->forget('cart');
            echo 'Installment';
        }
    }
}
