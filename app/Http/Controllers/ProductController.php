<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\Transaction\addStockStorage;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::paginate(10);
        return view('warehouse-storage', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function myIndex()
    {
        $data = Product::whereRelation('pivot', 'user_id', Auth::user()->id)->orderBy('id')->paginate(10);
        return view('stock-storage', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }


    public function saveStockStorage(addStockStorage $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::where('id', $request->user_id)->first();
            foreach ($request->product as $product) {
                $user->pivot()->where('product_id', $product['id'])->increment('amount', (int)$product['amount']);
                Product::where('id', $product['id'])->decrement('amount', (int)$product['amount']);
            }
        });
        return redirect()->route('stock-storage')->with(['success' => "Stock saved"]);
    }
    public function saveWarehouseStorage(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->product as $product) {
                Product::where('id', $product['id'])->increment('amount', (int)$product['amount']);
            }
        });
        return redirect()->route('stock-storage')->with(['success' => "Stock saved"]);
    }
}
