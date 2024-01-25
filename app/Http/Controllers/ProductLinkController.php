<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductLinkRequest;
use App\Http\Requests\UpdateProductLinkRequest;
use App\Models\ProductLink;

use function PHPUnit\Framework\returnSelf;

class ProductLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreProductLinkRequest $request)
    {
        ProductLink::create($request->all());
        return redirect()->route('form-modif')->with(['success' => "Link saved"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductLink $productLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductLink $productLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductLinkRequest $request, ProductLink $productLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductLink $productLink)
    {
        //
    }
}
