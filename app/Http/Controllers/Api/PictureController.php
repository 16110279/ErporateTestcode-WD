<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Picture;
use App\Product;
use Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $picture = Picture::all();
        // $picture = Picture::orderBy('product_id')->get();
        return response()->json([
            'status' => true,
            'data' => $picture
        ]);
    }

    public function byproduct($id)
    {
        $picture = Picture::where('product_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $picture
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
        $id = $request->product_id;
        $gambar = $this->imageUpload($request);
        $store = Picture::create([
            'product_id' => $id,
            'picture_name' => $gambar,
        ]);

        $store->picture_name = url('img' . '/' . $store->picture_name);

        return response()->json([
            'status' => true,
            'message' => 'Data successfully added',
            'data' => $store
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    //     $picture = Picture::findOrFail($id);
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $picture
    //         ]
    //     );
    // }

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
        $picture = picture::findOrFail($id);
        $img = picture::where('id', $id)->first();
        Storage::disk('public')->delete('img' . '/' . $img->picture_name);
        $picture->delete();



        // $picture = Picture::where('id', $id)->get();
        return response()->json([
            'message' => 'Image deleted',
            'data' => $picture
        ]);
    }

    public function storeImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $gambar = $this->imageUpload($request, $product->product_name);
        $image = new Picture();

        $image->product_id = $id;
        $image->picture_name = $gambar;
        $image->save();

        return response()->json([
            'message' => 'Image Tersimpan'
        ]);
    }

    private function imageUpload($request, $location = 'public/img')
    {
        $product = Product::findOrFail($request->product_id);
        $uploadedFile = $request->file('picture_name');
        $filename = strtolower(str_replace(' ', '_', $product->product_name)) . '-' . (Carbon::now()->timestamp + rand(1, 1000));
        $path = $uploadedFile->storeAs($location, $filename . '.' . $uploadedFile->getClientOriginalExtension());

        return $filename . '.' . $uploadedFile->getClientOriginalExtension();
    }
}
