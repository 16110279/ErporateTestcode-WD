<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Picture;
use Carbon\Carbon;
use App\TransactionItem;
use App\User;
use Storage;

use App\Category;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menu = 'Dashboard';

        return view('kasir/index', compact('menu'));
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
        $request->validate([
            'product_name' => ['required', 'string'],
            'category_id' => ['required'],
            'product_price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required'],
            'status' => ['required'],
            'product_gambar' => ['required'],
        ]);

        $store = Product::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);


        $product = Product::latest('created_at')->first();;
        $product_id = $product->id;

        $gambar = $this->imageUpload($request, $product_id);


        $simpan = Picture::create([
            'product_id' => $product->id,
            'picture_name' => $gambar,
        ]);

        $simpan->picture_name = url('img' . '/' . $simpan->picture_name);

        $img = Picture::latest('created_at')->first();;

        return redirect('/kasir/manage-product')->with('status', 'Product successfully added !');

        // return response()->json([
        //     'data' => $product,
        //     'img' => $img,
        // ]);

    }

    public function uploadImg(Request $request)

    {
        $product = Product::latest('created_at')->first();;
        $product_id = $product->id;
        $gambar = $this->imageUpload($request, $product_id);

        $simpan = Picture::create([
            'product_id' => $product->id,
            'picture_name' => $gambar,
        ]);

        $simpan->picture_name = url('img' . '/' . $simpan->picture_name);
    }
    private function imageUpload($request, $product_id, $location = 'public/img')
    {
        $product = Product::findOrFail($product_id);
        $uploadedFile = $request->file('product_gambar');
        $filename = strtolower(str_replace(' ', '_', $request->product_name)) . '-' . (Carbon::now()->timestamp + rand(1, 1000));
        $path = $uploadedFile->storeAs($location, $filename . '.' . $uploadedFile->getClientOriginalExtension());

        return $filename . '.' . $uploadedFile->getClientOriginalExtension();
    }

    public function getubah($id)
    {
        $data = Product::findOrFail($id);

        return response()->json($data);
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
        $picture = Picture::where('product_id', $id)->get();
        $product = Product::where('id', $id)->with('category')->get();
        $menu = 'Manage Product';
        return view('kasir/product-detail', compact('picture', 'product', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //

        $menu = 'Manage Product';
        // $produk = Product::with('category')->get();
        $produk = Product::with('category', 'picture')->where('id', $product->id)->get();
        $category_lain = Category::where('id', '!=', $product->category_id)->get();

        return view('kasir/product-edit', compact('product', 'produk', 'category_lain', 'menu'));
    }

    public function editpicture(Product $product)
    {
        //

        $menu = 'Manage Product';
        $picture = Picture::where('product_id', $product->id)->get();


        return view('kasir/product-edit-img', compact('menu', 'product', 'picture'));
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
        $product = Product::findOrFail($id);
        $request->validate([
            'product_name' => ['required', 'string'],
            'category_id' => ['required'],
            'status' => ['required'],
            'product_price' => ['required', 'numeric', 'min:0']
        ]);

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->product_price = $request->product_price;
        $product->save();

        return redirect('/kasir/manage-product')->with('status', 'Product successfully updated !');
    }

    public function showTransaction($id)
    {

        //
        // $user_id = Auth::user()->id;
        // $count = Cart::where('user_id', $user_id)->sum('cart_qty');
        // $cart = Cart::with('Product', 'Picture')->where('user_id', $user_id)->get();
        $sum = TransactionItem::where('transaction_id', $id)->sum('item_subtotal');
        // $cart_sum = Cart::with(' Product ')->sum(' cart_qty * cart_qty ');

        $transaction = Transaction::with('TransactionItem')->where('id', $id)->get();
        $transaction_item = TransactionItem::with('product', 'picture', 'transaction')->where('transaction_id', $id)->get();
        $all_product = Product::with('category', 'picture')->where('status', 'Ready')->get();
        $menu = 'Transaction';
        $idt = $id;

        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_total = $sum;
        $transaction->save();

        return view('kasir/transaction-edit', compact('transaction', 'all_product', 'transaction_item',   'menu', 'sum', 'idt'));
    }



    public function bayar($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->transaction_status == 'Aktif') {
            $status = 'Selesai';
        } else if ($transaction->transaction_status == 'Selesai') {
            $status = 'Aktif';
        }
        $transaction->transaction_status = $status;

        $transaction->save();
        // return response()->json([
        //     'data' => $status,
        // ]);

        return redirect('/kasir/transaction')->with('status', 'Product successfully updated !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyProduct($id)
    {
        //
        $product = Product::findOrFail($id);
        $picture = Picture::where('product_id', $id)->get();
        foreach ($picture as $key) {
            $foto_produk = $key['picture_name'];
            // Storage::delete(');
            Storage::delete("{{ url('storage/img'.'/'.$foto_produk) }}");
            Storage::delete('storage/img/1.jpg');
        }

        $result = Picture::where('product_id', $id)->count();
        if ($result >= 0) {
            $product->delete();
        }


        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data deleted',
        //     // 'result' => $result,
        //     'data' => $picture
        // ]);


        return redirect('/kasir/manage-product')->with('status', 'Product successfully deleted !');
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
        //     'data' => $transaction->transaction_id
        // ]);
        return redirect('/kasir/transaction/' . $transaction->transaction_id)->with('status', 'QTY updated !');
    }

    public function destroyTransaction($id)
    {
        //
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect('/kasir/transaction')->with('status', 'Product successfully deleted !');
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

        return redirect('/kasir/transaction/' . $request->idt)->with('status', 'Order successfully updated !');
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
        return redirect('/kasir/transaction/' . $idt[0]->transaction_id)->with('status', 'Order successfully updated !');
    }

    public function manageProduct()
    {
        $menu = 'Manage Product';
        $product = Product::with('category', 'picture')->get();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('kasir/manage-product', compact('product', 'menu'));
    }
    public function addproduct()
    {
        $menu = 'Add Product';
        $product = Product::with('category', 'picture')->get();
        $category = Category::all();

        return view('kasir/add-product', compact('product', 'menu', 'category'));
    }


    public function managetransaction()
    {
        $menu = 'Transaction';
        $transaction = Transaction::with('user')->get();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('kasir/transaction-manage', compact('transaction', 'menu'));
    }
}
