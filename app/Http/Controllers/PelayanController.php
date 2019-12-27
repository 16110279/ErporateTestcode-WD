<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Cart;
use App\Picture;
use Carbon\Carbon;
use App\TransactionItem;
use App\User;
use Auth;
use App\Category;

class PelayanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('pelayan');
        // $user_id = Auth::user()->id;
    }

    public function index()
    {
        //
        $user_id = Auth::user()->id;

        $transaction = Transaction::with('TransactionItem')->get();
        $transaction_item = TransactionItem::with('product')->get();
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');

        $menu = 'Dashboard';

        return view('pelayan/index', compact('transaction', 'transaction_item',   'menu', 'count'));
    }

    public function addtocart($id)
    {
        $user_id = Auth::user()->id;
        $product = Product::findOrFail($id);
        $pid = $product->id;
        $cart = new Cart;
        $cart_count = Cart::where('product_id', $product->id)->count();

        if ($cart_count == '') {
            $cart->user_id = $user_id;
            $cart->product_id = $product->id;
            $cart->subtotal = $product->product_price;
            $cart->cart_qty = 1;
            $cart->save();
            return response()->json([
                'data' => $product->id,
                'message' => 'Added to chart'
            ]);
        } else {

            $co = Cart::where('product_id', $id)->get();
            foreach ($co as $c) {
                $cart = Cart::findOrFail($c->id);
                $cart->subtotal = $c->subtotal + $product->product_price;
                $cart->cart_qty = $c->cart_qty + 1;
                $cart->save();

                // }
            }
            return response()->json([
                'data' => $co,
                'message' => 'Added to chart'
            ]);
        };
    }


    public function updt(Request $request, $id)
    {
        $trans_item = TransactionItem::with('Transaction')->where('transaction_id', $request->idt)->where('product_id', $request->idp)->get();
        $pid = $request->idp;
        $qty = '';
        $pro = Product::where('id', $request->idp)->get();


        if (empty($trans_item[0])) {
            // Array is not empty.
            echo 'd';
            $new_trans = new TransactionItem();
            $new_trans->transaction_id = $request->idt;
            $new_trans->product_id = $request->idp;
            $new_trans->item_qty = $new_trans->item_qty + 1;
            $new_trans->item_subtotal = $pro[0]->product_price * ($new_trans->item_qty);
            $new_trans->save();
        } else {

            $id = $trans_item[0]->id;
            $transaksi_update = TransactionItem::findOrFail($id);
            $transaksi_update->item_qty = $transaksi_update->item_qty + 1;
            $transaksi_update->item_subtotal = $pro[0]->product_price * ($transaksi_update->item_qty);
            $transaksi_update->save();
        }
        // return response()->json([
        //     'data' => $trans_item
        // ]);

        return redirect('/pelayan/transaction/' . $request->idt)->with('status', 'Order successfully updated !');
    }

    public function updateQty(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->cart_qty = $request->cart_qty;


        $product = Product::findOrFail($cart->product_id);


        $cart->subtotal = $product->product_price * $request->cart_qty;

        $cart->save();

        // return response()->json([
        //     'data' => $cart
        // ]);

        return redirect('pelayan/cart');
    }

    public function updateQtyTransaction(Request $request, $id)
    {

        $request->validate([
            'item_qty' => ['required', 'numeric', 'min:1'],
        ]);


        $transaction = TransactionItem::findOrFail($id);
        $transaction->item_qty = $request->item_qty;


        $product = Product::findOrFail($transaction->product_id);


        $transaction->item_subtotal = $product->product_price * $request->item_qty;

        $transaction->save();

        // return response()->json([
        //     'data' => $cart
        // ]);
        return redirect('/pelayan/transaction/' . $request->idt)->with('status', 'Order successfully updated !');
    }


    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        // $id = $id;
        // $c = dump($cart);
        $template = 'ERP';
        $noUrutAkhir = \App\Transaction::max('id');
        $date = Carbon::now()->format('dmY');
        $transaction_code = ($template) . '' . ($date) . '-' . ($noUrutAkhir + 1);

        $total = 0;
        $transactionArr = array();
        foreach ($cart as $key) {
            $product = Product::findOrFail($key->product_id);
            $qty = $key->cart_qty;
            $sub_total = $key->subtotal;
            $total += $sub_total;
            $transactionArr[] = new TransactionItem([
                'product_id' => $key->product_id,
                'item_qty' => $qty,
                'item_subtotal' => $sub_total
            ]);

            $cart_delete = Cart::findOrFail($key->id);
            $cart_delete->delete();



            // return response()->json([
            //     'data' => $product
            // ]);
        }

        $transaction = new Transaction;
        $transaction->user_id = $user_id;
        $transaction->transaction_code = $transaction_code;
        $transaction->transaction_status = 'Aktif';
        $transaction->transaction_total = $total;
        $transaction->save();

        $transaction_item = $transaction->transactionItem()->saveMany($transactionArr);

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data Stored',
        //     'data' => $transaction,
        //     'transaction_item' => $transaction_item
        // ]);
        return redirect('/pelayan/')->with('status', 'Order successfully created !');

        // return redirect('pelayan/')dad;
    }

    public function laporan()
    {
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');
        $laporan = Transaction::with('transactionItem')->where('user_id', $user_id)->get();

        $menu = 'Laporan';
        return view('pelayan/laporan', compact('menu', 'count', 'laporan'));
    }

    public function laporandetail($id)
    {
        $sum = TransactionItem::where('transaction_id', $id)->sum('item_subtotal');
        $status = Transaction::where('id', $id)->get();

        $count = Cart::all()->sum('item_subtotal');
        // $laporan = Transaction::with('transactionItem')->get();
        $laporan = TransactionItem::with('product', 'picture')->where('transaction_id', $id)->get();

        $menu = 'Laporan';
        return view('pelayan/detail-laporan', compact('menu', 'count', 'laporan', 'sum', 'status'));
    }

    public function cetaklaporan()
    {
        $uid =  Auth::user()->id;
        $sum = TransactionItem::where('transaction_id')->sum('item_subtotal');
        $total = Transaction::where('user_id', $uid)->sum('transaction_total');

        $count = Cart::all()->sum('item_subtotal');
        // $laporan = Transaction::with('transactionItem')->get();

        $tr = Transaction::where('user_id', $uid)->get();


        $laporan = TransactionItem::with('transaction', 'product', 'picture')->get();
        // $laporan = TransactionItem::with('transaction', 'product', 'picture')->get();


        $date = Carbon::now()->translatedFormat('d F Y');

        foreach ($tr as $t) {
            $lp[] = TransactionItem::with('product')->where('transaction_id', $t->id)->get();
        }
        $menu = 'Laporan';
        return view('pelayan/cetak-laporan', compact('menu', 'count', 'laporan', 'sum', 'tr', 'lp', 'total', 'date'));
    }

    public function cart()
    {
        //
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');
        $cart = Cart::with('Product', 'Picture')->where('user_id', $user_id)->get();
        $sum = Cart::where('user_id', $user_id)->sum('subtotal');
        // $cart_sum = Cart::with(' Product ')->sum(' cart_qty * cart_qty ');



        $transaction = Transaction::with('TransactionItem')->where('user_id', $user_id)->get();
        $transaction_item = TransactionItem::with('product')->get();

        $menu = 'Dashboard';

        return view('pelayan/cart', compact('transaction', 'transaction_item',   'menu', 'count', 'cart', 'sum'));
    }

    public function showTransaction($id)
    {
        //
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');
        $cart = Cart::with('Product', 'Picture')->where('user_id', $user_id)->get();
        $sum = TransactionItem::where('transaction_id', $id)->sum('item_subtotal');

        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_total = $sum;
        $transaction->save();

        // $cart_sum = Cart::with(' Product ')->sum(' cart_qty * cart_qty ');

        $transaction = Transaction::with('TransactionItem')->where('id', $id)->get();
        $transaction_item = TransactionItem::with('product', 'picture', 'transaction')->where('transaction_id', $id)->get();
        $all_product = Product::with('category', 'picture')->where('status', 'Ready')->get();
        $menu = 'Transaction';
        $idt = $id;

        return view('pelayan/transaction-edit', compact('transaction', 'all_product', 'transaction_item',   'menu', 'count', 'cart', 'sum', 'idt'));
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
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
        $user_id = Auth::user()->id;

        // $produk = Product::with('category', 'picture')->where('id', $product->id)->get();
        // $category_lain = Category::where('id', '!=', $product->category_id)->get();

        $transaction_item = TransactionItem::with('transaction', 'product', 'picture')->where('id', $transaction->id)->get();
        // $sum = Transaction::where('id', $transaction->id)->get();
        $menu = 'Transaction';
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');
        return view('pelayan/transaction-edit', compact('transaction', 'count', 'menu', 'transaction_item'));
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
    }
    public function destroyTransactionItem($id)
    {
        //
        $idt = TransactionItem::where('id', $id)->get();
        $item = TransactionItem::where('id', $id)->delete();

        // $trs = Transa
        // return view('pelayan/transaction-manage', compact('transaction', 'menu', 'count'));
        // return response()->json([
        //     'data' => $idt[0]->transaction_id,
        // ]);
        return redirect('/pelayan/transaction/' . $idt[0]->transaction_id)->with('status', 'Order successfully updated !');
    }

    public function managetransaction()
    {
        $user_id = Auth::user()->id;
        $menu = 'Transaction';
        $transaction = Transaction::with('user')->where('user_id', $user_id)->where('transaction_status', 'Aktif')->get();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);
        $count = Cart::where('user_id', $user_id)->sum('cart_qty');

        return view('pelayan/transaction-manage', compact('transaction', 'menu', 'count'));
    }
}
