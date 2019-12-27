    <?php

    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('welcome');
    });

    // Route::get('/admin/', function () {
    //     return view('admin.index');
    // });

    Auth::routes();


    // Route::get('/admin/add-product', 'AdminController@addproduct')->middleware('admin');
    // Route::get('/admin/add-product-img', 'AdminController@addproductimg');

    // Route::post('/admin/add-product', 'AdminController@store')->name('admin')->middleware('admin');
    // Route::get('/admin/manage-product', 'AdminController@allproduct')->name('admin')->middleware('admin');
    // Route::get('/admin/manage-product/{id}', 'AdminController@show')->name('admin')->middleware('admin');
    // Route::get('/admin/category', 'AdminController@category')->name('admin')->middleware('admin');
    // Route::get('/admin/transaction', 'AdminController@alltransaction')->name('admin')->middleware('admin');
    // Route::get('/admin/', 'AdminController@index')->name('admin')->middleware('admin');



    // Route untuk user dengan role pelayan
    Route::get('/pelayan/laporan', 'PelayanController@laporan')->name('pelayan')->middleware('pelayan');
    Route::get('/pelayan/cetak-laporan', 'PelayanController@cetaklaporan')->name('pelayan')->middleware('pelayan');
    Route::get('/pelayan/laporan/{id}/detail', 'PelayanController@laporandetail')->name('pelayan')->middleware('pelayan');
    Route::get('/pelayan/cart', 'PelayanController@cart')->name('pelayan')->middleware('pelayan');
    Route::post('/pelayan/addtocart/{id}', 'PelayanController@addtocart')->name('pelayan')->middleware('pelayan');
    Route::post('/pelayan/transaction/{id}/update', 'PelayanController@updt')->name('pelayan')->middleware('pelayan');
    Route::post('pelayan/cart/checkout', 'PelayanController@checkout')->name('pelayan')->middleware('pelayan');
    Route::put('pelayan/cart/{id}', 'PelayanController@updateQty')->name('pelayan')->middleware('pelayan');
    Route::put('pelayan/transaction/{id}', 'PelayanController@updateQtyTransaction')->name('pelayan')->middleware('pelayan');
    Route::get('/pelayan/transaction', 'PelayanController@managetransaction')->name('pelayan')->middleware('pelayan');
    Route::get('/pelayan/transaction/{id}', 'PelayanController@showTransaction')->name('pelayan')->middleware('pelayan');
    Route::delete('/pelayan/transaction/item/{id}', 'PelayanController@destroyTransactionItem')->name('pelayan')->middleware('pelayan');

    Route::get('/pelayan/', 'PelayanController@index')->name('pelayan')->middleware('pelayan');



    Route::get('/kasir/manage-product', 'KasirController@manageProduct')->name('kasir')->middleware('kasir');
    Route::get('/kasir/add-product', 'KasirController@addproduct')->name('kasir')->middleware('kasir');
    Route::post('/kasir/add-product', 'KasirController@store')->name('kasir')->middleware('kasir');
    Route::get('/kasir/manage-product/{product}/edit', 'KasirController@edit')->name('kasir')->middleware('kasir');
    Route::patch('/kasir/manage-product/{product}', 'KasirController@update')->name('kasir')->middleware('kasir');
    Route::delete('/kasir/manage-product/{product}', 'KasirController@destroyProduct')->name('kasir')->middleware('kasir');
    Route::get('/kasir/manage-product/{product}/edit-img', 'KasirController@editpicture')->name('kasir')->middleware('kasir');
    Route::get('/kasir/transaction', 'KasirController@managetransaction')->name('kasir')->middleware('kasir');
    Route::delete('/kasir/transaction/{transaction}', 'KasirController@destroyTransaction')->name('kasir')->middleware('kasir');
    Route::post('/kasir/add-product', 'KasirController@store');
    Route::get('/kasir/transaction/{transaction}/bayar', 'KasirController@bayar')->name('kasir')->middleware('kasir');
    Route::get('/kasir/transaction/{id}', 'KasirController@showTransaction')->name('kasir')->middleware('kasir');
    Route::post('/kasir/transaction/{id}/update', 'KasirController@updt')->name('kasir')->middleware('kasir');
    Route::put('kasir/transaction/{id}', 'KasirController@updateQtyTransaction')->name('kasir')->middleware('kasir');
    Route::delete('/kasir/transaction/item/{id}', 'KasirController@destroyTransactionItem')->name('kasir')->middleware('kasir');

    Route::get('/kasir/', 'KasirController@index')->name('kasir')->middleware('kasir');


    // Route::get('/player', 'PlayerController@index')->name('player')->middleware('player');


    Route::get('/home', 'HomeController@index')->name('home');
