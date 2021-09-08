<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index', [
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }

    public function ordersCount() {
        return view('layouts.admin', [
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }
}
