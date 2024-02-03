<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Create;
use App\Http\Requests\User\Edit;
use App\Models\Product;
use App\Models\User;
use App\Models\UserHasProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('roles')->paginate();
        return view('user.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function apiIndex()
    {
        $data = User::with('roles')->paginate();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        $user = User::create($request->all());
        $allProducts = Product::all();
        foreach ($allProducts as $product) {
            UserHasProduct::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'amount' => 0
            ]);

            $product->save();
        }
        $user->assignRole($request->role);
        return redirect()->route('employee-list')->with(['success' => "User created"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.Edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Edit $request, User $user)
    {
        $user->update($request->all());
        $user->syncRoles($request->role);
        return redirect()->route('employee-list')->with(['success' => "User created"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->pivot()->delete();
        $user->delete();
        return redirect()->route('employee-list')->with(['success' => "User deleted"]);
    }

    /**
     * Display the specified resource.
     */
    public function stock(User $user)
    {
        $name = $user->name;
        $data = $user->pivot()->paginate();
        return view('user.stock', compact('data', 'name'));
    }


    /**
     * Display the specified resource.
     */
    public function transaction(User $user)
    {
        $data = $user->transactions()->orderBy('created_at', 'desc')->paginate();
        return view('user.Transaction', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function information()
    {
        $user = Auth::user();
        return view('user.information', compact('user'));
    }
}
