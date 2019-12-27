<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Picture;
use Carbon\Carbon;
use App\TransactionItem;
use App\User;

use App\Category;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::with('TransactionItem')->get();
        $transaction_item = TransactionItem::with('product')->get();

        $menu = 'Dashboard';

        return view('admin/index', compact('transaction', 'transaction_item',   'menu'));


        // $submenu = array();
        // foreach ($user_menu as $key => $value) {
        //     $submenu = UserSubmenu::where(' menu_id ', $key[' id '])->get();
        // }


        // $sub = UserAccessMenu::all();

        // $transaction = Product::with(' category ', ' picture ')->get();
        // $transaction = Transaction::all();
        // $penawaran = Product::all();

        // return view(' admin / index ', compact(' transaction ', ' transaction_item ', ' user_menu ', ' submenu '));
        // return view(' admin / index ', [' $transaksi' => $transaksi]);
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
        // $request->validate([
        //     'product_name' => $request->nama,
        //     'product_price' => $request->harga,
        //     'category_id' => $request->kategori,
        //     'status' => $request->status,
        // ]);

        $store = Product::create([
            'product_name' => $request->nama,
            'product_price' => $request->harga,
            'category_id' => $request->kategori,
            'status' => $request->status
            // 'pariwisata_gambar' => $gambar,
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


        // return response()->json([
        //     'data' => $product,
        //     'img' => $img,
        // ]);

        return redirect('/admin/manage-product');
    }

    public function detail_product()
    {
        $transaction = Transaction::with('TransactionItem')->get();
        $transaction_item = TransactionItem::with('product')->get();

        $menu = 'Dashboard';

        return view('admin/product-detail', compact('transaction', 'transaction_item',   'menu'));
    }


    private function imageUpload($request, $product_id, $location = 'public/img')
    {
        $product = Product::findOrFail($product_id);
        $uploadedFile = $request->file('pariwisata_gambar');
        $filename = strtolower(str_replace(' ', '_', $request->nama)) . '-' . (Carbon::now()->timestamp + rand(1, 1000));

        // return response()->json([
        //     'data' => $filename,
        //     'img' => $filename,
        // ]);

        $path = $uploadedFile->storeAs($location, $filename . '.' . $uploadedFile->getClientOriginalExtension());

        return $filename . '.' . $uploadedFile->getClientOriginalExtension();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Picture::where('product_id', $id)->get();
        $title = Product::findOrFail($id);
        $menu = 'da';
        return view('admin/product-detail', compact('product', 'title', 'menu'));
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

    public function allproduct()
    {
        $menu = 'Product';
        $product = Product::with('category', 'picture')->get();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('admin/product', compact('product', 'menu'));
    }

    public function addproduct()
    {
        $menu = 'Tambah Product';
        $product = Product::with('category', 'picture')->get();
        $category = Category::all();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('admin/add-product', compact('product', 'menu', 'category'));
    }

    public function addproductimg()
    {
        $menu = 'Tambah Product';
        $product = Product::with('category', 'picture')->get();
        $category = Category::all();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('admin/add-product-img', compact('product', 'menu', 'category'));
    }

    public function category()
    {
        $menu = 's';
        $menu = 'Management';
        $submenu = 'Category';
        return view('admin/category', compact('menu', 'menu', 'submenu'));
    }

    public function alltransaction()
    {
        $menu = 'Transaction';
        $transaction = Transaction::all();
        // $users = User::all();
        // ["products" => \App\Product::paginate(25)]);

        return view('admin/transaction', compact('transaction', 'menu'));
    }
}
