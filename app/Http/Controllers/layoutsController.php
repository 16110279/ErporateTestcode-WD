<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSubmenu;
use App\Product;

class layoutsController extends Controller
{
    //
    public function index()
    {
        // $user_menu = UserAccessMenu::with('user_menu')->where('role_id', '2')->get();
        $user_menu = UserAccessMenu::with('user_menu')->where('role_id', '2')->get();

        // $submenu = array();
        foreach ($user_menu as $key) {
            // return response()->json([
            //     'data' => $key
            // ]);
            $submenu[] = UserSubmenu::where('menu_id', $key->id)->get();
        }
        // $submenu = ;
        // foreach ($user_menu as $key => $value) {
        //     $submenu = UserSubmenu::where('menu_id', $value)->get();
        // }
        // $sub_menu = UserSubmenu::all();


        // $model = Model::find(1);
        // View::make('view')->withModel($model);
        return view('layouts/main', ['submenu' => $submenu]);
    }
}
