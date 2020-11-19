<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{

    private $customer;
    private $category;

    function __construct(Category $category, Customer $customer)
    {
        $this->category = $category;
        $this->customer = $customer;
    }

    function index()
    {
        $categories = $this->category->where('parent_id', 0)->get();
        return view('client.checkout.index', compact('categories'));
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
}
