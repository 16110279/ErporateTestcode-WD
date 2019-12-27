<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Picture;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $camera = Camera::with('brand')->get();

        $product = Product::with('category', 'picture')->get();
        // $product = Product::with('category')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Fetched',
            'data' => $product
        ]);
    }

    public function active()
    {
        //
        // $camera = Camera::with('brand')->get();

        $product = Product::with('category', 'picture')->where('status', 'Ready')->get();
        // $product = Product::with('category')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Fetched',
            'data' => $product
        ]);
    }


    public function ccart()
    {
        $cart = Cart::all()->count();
        return response()->json([
            'status' => true,
            'message' => 'Data Fetched',
            'data' => $cart
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

        $request->validate([
            'product_name' => ['required', 'string', 'unique:product,product_name'],
            'category_id' => ['required'],
            'product_price' => ['required', 'numeric', 'min:0']
        ]);

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->product_price = $request->product_price;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Data Stored',
            'data' => $product,
            'category' => $product->category
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
        $product = Product::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $product
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

        $product = Product::findOrFail($id);
        $request->validate([
            'product_name' => ['required', 'string', 'unique:product,product_name'],
            'category_id' => ['required'],
            'product_price' => ['required', 'numeric', 'min:0']
        ]);

        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->product_price = $request->product_price;
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Data Updated',
            'data' => $product,
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
        $product = Product::findOrFail($id);

        // $picture = new Picture();
        $picture = Picture::where('product_id', $id)->get();
        foreach ($picture as $key) {
            $foto_produk = $key['picture_name'];
            Storage::delete('img' . '/' . $foto_produk);
        }

        $result = Picture::where('product_id', $id)->count();
        if ($result >= 0) {
            $product->delete();
        }


        return response()->json([
            'status' => true,
            'message' => 'Data deleted',
            'result' => $result,
            'data' => $picture
        ]);
    }
}
