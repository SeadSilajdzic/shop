<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\OrderStoreRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::with('user')->with('orderStatus')->with('product')->orderByDesc('order_status_id')->where('order_status_id', 3)->simplePaginate(15),
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }
    public function userOrder()
    {
        return view('orders', [ 'orders' => Order::with('product')->with('orderStatus')->orderByDesc('created_at')->where('user_id', auth()->user()->id)->simplePaginate(15)]);
    }
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();

        Order::create([
            'user_id' => auth()->user()->id,
            'product_id' => $data['product_id'],
            'order_status_id' => 3,
            'location' => $data['location'],
            'address' => $data['address'],
            'number' => $data['number'],
            'reqQuantity' => $data['reqQuantity'],
        ]);

        toast('Thank you for the purchase! Order is created.','success')->autoClose(2500);
        return redirect()->back();
    }

    public function accept(Order $order)
    {
        $order->load('product');
        $order->order_status_id = 1;
        $order->save();

        $product = Product::findOrFail($order->product_id);
        $product->update([
            'quantity' => $product->quantity - $order->reqQuantity,
        ]);

        toast('Order is accepted!','success')->autoClose(1500);
        return redirect()->back();
    }

    public function decline(Order $order)
    {
        $order->order_status_id = 2;
        $order->save();
        toast('Order is declined!','error')->autoClose(1500);
        return redirect()->back();
    }

    public function accepted() {
        return view('admin.orders.accepted', [
            'orders' => Order::with('user')->with('product')->with('orderStatus')->orderByDesc('created_at')->where('order_status_id', 1)->simplePaginate(15),
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }

    public function declined() {
        return view('admin.orders.declined', [
            'orders' => Order::with('user')->with('product')->with('orderStatus')->orderByDesc('created_at')->where('order_status_id', 2)->simplePaginate(15),
        ]);
    }
}
