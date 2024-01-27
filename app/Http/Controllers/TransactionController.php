<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductLinkRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\Transaction\FormRepair;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Product;
use App\Models\ProductLink;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::user()->transactions()->orderBy('date', 'desc')->paginate();
        return view('transaction', compact('data'));
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
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formRepair()
    {
        $links = Auth::user()->links()->pluck('link', 'id');
        $products = Product::orderBy('id')->get();
        return view('form-repair', compact('links', 'products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function formModif()
    {
        return view('form-modif');
    }

    public function formAddStock()
    {
        $employees = User::all();
        $products = Product::orderBy('id')->get();
        return view('form-add-stock', compact('employees', 'products'));
    }
    public function formAddStockWarehouse()
    {
        $products = Product::orderBy('id')->get();
        return view('form-add-stock-warehouse', compact('products'));
    }

    public function storeFormModif(StoreProductLinkRequest $request)
    {
        $productLink = ProductLink::create($request->all());
        Transaction::create([
            'date' => Carbon::now()->format('Y-m-d'),
            'owner_id' => Auth::user()->id,
            'product_link_id' => $productLink->id,
            'type' => 'modif',
        ]);
        return redirect()->route('form-modif')->with(['success' => "Link saved"]);
    }
    public function storeFormRepait(FormRepair $request)
    {
        DB::transaction(function () use ($request) {

            $transactionDetails = collect($request->product)->map(function ($item) use ($request) {
                return [
                    'product_id' => $item['id'],
                    'link' => $request->link,
                    'amount' => $item['amount'] ?? 0,
                ];
            })->filter(fn ($item) => $item['amount'] > 0)->toArray();

            Transaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'owner_id' => Auth::user()->id,
                'type' => 'repair',
            ])->details()->createMany($transactionDetails);
            foreach ($transactionDetails as $detail) {
                Auth::user()->pivot()->where('product_id', $detail['product_id'])->decrement('amount', $detail['amount']);
                // Product::where('id', $detail['product_id'])->decrement('amount', $detail['amount']);
            }
        });

        return redirect()->route('form-repair')->with(['success' => "Link saved"]);
    }

    public function reimburse(User $user, int $amount)
    {
        DB::transaction(function () use ($user, $amount) {
            Transaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'owner_id' => $user->id,
                'type' => 'reimburse',
                'reimbursement' => $amount * -1,
            ]);
        });
        return redirect()->route('employee-list')->with(['success' => "Reimbursement Success"]);
    }

    public function fee(User $user, int $amount)
    {
        DB::transaction(function () use ($user, $amount) {
            Transaction::create([
                'date' => Carbon::now()->format('Y-m-d'),
                'owner_id' => $user->id,
                'type' => 'bonus',
                'bonus' => $amount * -1,
            ]);
        });
        return redirect()->route('employee-list')->with(['success' => "Bonus Payment Success"]);
    }
}
