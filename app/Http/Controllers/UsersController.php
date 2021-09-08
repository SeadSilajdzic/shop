<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Requests\Users\UserStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::with('role')->orderBy('role_id', 'asc')->simplePaginate(15),
            'roles' => Role::all(),
            'ordersCount' => Order::all()->where('order_status_id', 3)->count()
        ]);
    }
    public function create()
    {
        return view('admin.users.index');
    }
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id']
        ]);

        toast('User created','success')->autoClose(1500);
        return redirect()->back();
    }
    public function edit($id)
    {
        return view('admin.users.index');
    }
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update([
           'name' => $data['name'],
           'email' => $data['email'],
           'role_id' => $data['role_id'],
        ]);

        if($request->input('password'))
        {
            $user->update([
                'password' => bcrypt($data['password'])
            ]);
        }

        toast('User updated','info')->autoClose(1500);
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        toast('User deleted','error')->autoClose(1500);
        return redirect()->back();
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
