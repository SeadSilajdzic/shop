<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome() {
        return view('welcome', [
            'products' => Product::withoutTrashed()->get(),
        ]);
    }
}
