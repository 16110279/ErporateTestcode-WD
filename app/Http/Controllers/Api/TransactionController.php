<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Transaction;
use App\TransactionItem;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::all();
        return response()->json([
            'status' => true,
            'data' => $transaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $total = 0;
        // $transactionArr = array();
        // foreach ($request->product_id as $key => $value) {
        //     $product = Product::findOrFail($value);
        //     $qty = $request->item_qty[$key];
        //     $sub_total = $product->product_price * $qty;
        //     $total += $sub_total;

        //     $transactionArr[] = new TransactionItem(
        //         [
        //             'product_id' => $product->id,
        //             'item_qty' => $qty,
        //             'item_price' => $product->product_price,
        //             'item_subtotal' => $sub_total
        //         ]
        //     );

        //     $transaction = new Transaction;
        //     $transaction->user_id = $request->user_id;
        //     $transaction->transaction_status = 'pending';
        //     $transaction->transaction_total = $total;
        //     $transaction->save();

        //     $transaction_item = $transaction->transactionItem()->saveMany($transactionArr);


        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Data Stored',
        //         'data' => $transaction,
        //         'transaction_item' => $transaction_item
        //     ]);
        // }
        $template = 'ERP';
        $noUrutAkhir = \App\Transaction::max('id');
        $date = Carbon::now()->format('dmY');

        $transaction_code = ($template) . '' . ($date) . '-' . ($noUrutAkhir + 1);


        $total = 0;
        $transactionArr = array();
        foreach ($request->product_id as $key => $value) {
            $product = Product::findOrFail($value);
            $qty = $request->item_qty[$key];
            $price = $product->product_price;
            $sub_total = $product->product_price * $qty;
            $total += $sub_total;

            $transactionArr[] = new TransactionItem([
                'product_id' => $product->id,
                'item_qty' => $qty,
                'item_price' => $price,
                'item_subtotal' => $sub_total
            ]);
        }

        $transaction = new Transaction;
        $transaction->user_id = $request->user_id;
        $transaction->transaction_code = $transaction_code;
        $transaction->transaction_status = 'Belum Dibayar';
        $transaction->transaction_total = $total;
        $transaction->save();

        $transaction_item = $transaction->transactionItem()->saveMany($transactionArr);

        return response()->json([
            'status' => true,
            'message' => 'Data Stored',
            'data' => $transaction,
            'transaction_item' => $transaction_item
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $transaction = Transaction::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $transaction = Transaction::findOrFail($id);
        $request->validate([
            'transaction_status' => ['required', 'string']
        ]);

        $transaction->transaction_status = $request->transaction_status;
        $transaction->save();

        return response()->json([
            'status' => true,
            'message' => 'Data updated',
            'data' => $transaction,
            'transaction_item' => $transaction->transactionItem
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $transaction = Transaction::findById($id);
        $transaction->delete();

        return response()->json([
            'status' => true,
            'data' => $transaction
        ]);
    }
}
