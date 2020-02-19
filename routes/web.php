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

use App\Sub_Category;
use Illuminate\Support\Facades\Input;

Route::get('/', function() {
    return redirect(route('login'));
});
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
Route::get('/otp', 'HomeController@otp')->name('otp');
Route::post('/verify/otp','HomeController@verifyotp')->name('verify.otp');


});
Route::group(['middleware' => 'checkotp'], function() {

   Route::get('/home', 'HomeController@index')->name('home');



});

Route::group(['middleware' => ['auth','checkotp']], function() {

 
    Route::group(['middleware' => ['role:admin|cs']], function () {
Route::get('/penampungan','penampungan@index')->name('penampungan');
Route::post('/penampungan/update','penampungan@update')->name('penampungan.update');
Route::post('/penampungan/store','penampungan@store')->name('penampungan.store');
Route::post('/penampungan/delete','penampungan@delete')->name('penampungan.delete');



Route::get('/anggota','anggotaController@index')->name('anggota');
Route::get('/hapus/anggota/{id}','anggotaController@destroy')->name('hapus.anggota');
Route::get('/anggota/edit/{id}','anggotaController@edit')->name('edit.anggota');
Route::post('/update/anggota/{id}','anggotaController@update')->name('anggota.update');
Route::get('/anggota/tambah','anggotaController@create')->name('tambah.anggota');
Route::post('/anggota/add','anggotaController@store')->name('store.anggota');
Route::get('/cari/anggota','anggotaController@cari_user_status')->name('cari.anggota');


Route::get('/hapus/photo/{photo}','ProductController@hapusphoto')->name('hapus.photo');
Route::get('/hapus/photo2/{photo}','ProductController@hapusphoto2')->name('hapus.photo2');
Route::get('/hapus/photo3/{photo}','ProductController@hapusphoto3')->name('hapus.photo3');


        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);

        Route::resource('/users', 'UserController')->except([
            'show'
        ]);

        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
        Route::get('/vendor','vendor@index')->name('vendor.index');
        Route::post('/store/vendor','vendor@store')->name('vendor.store');
        Route::post('/update/vendor','vendor@update')->name('update.vendor');
        Route::post('/delete/vendor','vendor@destroy')->name('vendor.destroy');
        Route::get('/pre_order/list','pre_ordercontroller@index')->name('pre_order.index');
        Route::post('/store/po','pre_ordercontroller@store')->name('preorder.store');
        Route::post('/delete/po','pre_ordercontroller@destroy')->name('destroy.po');
        Route::post('/proses/po','pre_ordercontroller@proses')->name('proses.po');
        Route::get('/mystock','mystockcontroller@index')->name('mystock.index');


    });

    Route::group(['middleware' => ['role:admin|cs']], function() {
        Route::resource('/kategori', 'CategoryController')->except([
            'create', 'show'
        ]);
        Route::resource('/sub', 'SubController');
        Route::get('/cari/sub','SubController@carisub')->name('cari.sub');

        Route::resource('/produk', 'ProductController');
        Route::resource('/customer', 'CustomerController');

        Route::get('/users/cabang/list','usercabang@index')->name('users.cabang');
        Route::get('/tambah/users/cabang','usercabang@tambah')->name('tambah.cabang');
        Route::post('/post/users/cabang','usercabang@store')->name('store.cabang');
        Route::get('/usercabang/edit/{id}','usercabang@edit')->name('edit.cabang');
        Route::get('/cari/jurnal','jurnalController@cari')->name('cari.jurnal');
        Route::post('/usercabang/update/{id}','usercabang@update')->name('update.cabang');
        Route::post('/hapus/usercabang/{id}','usercabang@destroy')->name('hapus.cabang');
        Route::get('download/exel','anggotaController@export_excel')->name('anggota.exel');

        Route::get('/edu/content','beritaController@contentedu')->name('konten.edu');
        Route::get('/tambah/konten/edu','beritaController@tambahedu')->name('tambah.edu');
        Route::get('/edit/konten/{id}','beritaController@editedu')->name('edit.edu');
        Route::post('/tambah/konten/edu','beritaController@storekonten')->name('tambah.konten.edu');
        Route::post('/hapus/edu/{id}','beritaController@hapusedu')->name('hapus.edu');
        Route::post('/update/edu/{id}','beritaController@updateedu')->name('update.edu');

        Route::get('/mag/content','beritaController@contentmag')->name('konten.mag');
        Route::get('/tambah/konten/mag','beritaController@tambahmag')->name('tambah.mag');
        Route::get('/edit/mag/{id}','beritaController@editmag')->name('edit.mag');
        Route::post('/tambah/konten/mag','beritaController@storekontenmag')->name('tambah.konten.mag');
        Route::post('/hapus/mag/{id}','beritaController@hapusmag')->name('hapus.mag');
        Route::post('/update/mag/{id}','beritaController@updatemag')->name('update.mag');

    });

    Route::group(['middleware' => ['role:admin|cs']], function() {
        Route::resource('/produk', 'ProductController')->except([
            'create', 'destroy'
        ]);
          Route::get('hapus/produk/{id}', 'ProductController@destroy')->name('hapus.produk');
             Route::get('view/produk/{id}', 'ProductController@view')->name('view.produk');
    });

    Route::group(['middleware'], function() {
        Route::get('/transaksi', 'OrderController@addOrder')->name('order.transaksi');
        Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
        Route::post('/checkout', 'OrderController@storeOrder')->name('order.storeOrder');
    });


    Route::group(['middleware' => ['role:admin|cs']], function() {
        Route::get('/order', 'OrderController@index')->name('order.index');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::put('/order/edit/{id}', 'OrderController@update')->name('order.update');
        Route::get('/order/pdf/{invoice}', 'OrderController@invoicePdf')->name('order.pdf');
        Route::get('/order/excel/{invoice}', 'OrderController@invoiceExcel')->name('order.excel');
        Route::get('/order/html/{invoice}', 'OrderController@invoiceHtml')->name('order.html');
        Route::resource('/bank', 'BankController');
        Route::resource('/bukti', 'BuktiController');
        Route::resource('/retur', 'ReturController');
    });

    

             Route::get('/content/', 'beritaController@index' )->name('berita.index');
           Route::get('/content/tambah', 'beritaController@tambah' )->name('berita.tambah');
              Route::post('/content/store', 'beritaController@store' )->name('berita.store');
              Route::get('/content/edit/{id}', 'beritaController@edit' )->name('berita.edit');
                Route::post('/content/update/{id}', 'beritaController@update' )->name('berita.update');
                Route::get('/hapus/{id}', 'beritaController@destroy')->name('hapus.berita');
                 Route::get('/cari/konten', 'beritaController@cari')->name('cari.berita');

                 Route::get('/banner/', 'BannerController@index' )->name('banner.index');
           Route::get('/banner/tambah', 'BannerController@tambah' )->name('banner.tambah');
              Route::post('/banner/store', 'BannerController@store' )->name('banner.store');
              Route::get('/banner/edit/{id}', 'BannerController@edit' )->name('banner.edit');
                Route::post('/banner/update/{id}', 'BannerController@update' )->name('banner.update');
                Route::get('/banner/hapus/{id}', 'BannerController@destroy')->name('hapus.banner');
                 Route::get('/cari/banner', 'BannerController@cari')->name('cari.banner');

                Route::get('/voucher','voucherController@index')->name('voucher.index');
          Route::get('/voucher/edit/{id}','voucherController@edit')->name('edit.voucher');
           Route::post('/voucher/update/{id}','voucherController@update')->name('update.voucher');
           Route::get('voucher/delete/{id}','voucherController@destroy')->name('delete.voucher');

           Route::get('/voucher/tambah', 'voucherController@tambah')->name('tambah.voucher');
           Route::post('/voucher/post','voucherController@store')->name('voucher.store');
           Route::get('/cari/voucher','voucherController@cari')->name('cari.voucher');

           Route::get('/request/barang','StockController@index')->name('request.index');
Route::get('/request/barang/{id}','prosesstock@edit')->name('proses.stock');
Route::post('/request/kirim','prosesstock@store')->name('proses.send');
Route::get('/request/status','prosesstock@index')->name('proses.status');
Route::get('/request/review/{id}','prosesstock@review')->name('proses.review');
Route::post('request/kirim/barang','prosesstock@kirim')->name('stock.kirim');

Route::Post('/kirim/barang/cabang','prosesstock@kirimkecabang')->name('send.cabang');
Route::get('/product/cabang','prosesstock@index_admin')->name('proses.status.admin');
Route::get('/kirim/barang/{id}','prosesstock@kirimcabang')->name('kirimcabang');



Route::get('/search/product','ProductController@cari')->name('cari_nama');
Route::get('/search/customer','CustomerController@search_nama')->name('cari_nama_pelanggan');
Route::get('/search/bukti','BuktiController@search_bukti')->name('cari_nama_bukti');
Route::get('/search/product/cabang','StockController@cari_order')->name('cari_nama_order');
Route::get('/search/proses/order','prosesstock@cari_proses')->name('cari_proses');
Route::get('/search/proses/order/admin','prosesstock@cari_proses_admin')->name('cari_proses_admin');

Route::get('/search/proses/order','prosesstock@cari_proses')->name('cari_proses');
Route::get('/search/users','UserController@cari_user_status')->name('cari_user_status');

Route::get('/search/akun/users','UserController@cari_user_status')->name('cari_account');


  Route::get('/produk/hapus/{id}', 'ProductController@destroy')->name('hapus.produk');
    Route::get('/kategory/hapus/{id}', 'CategoryController@destroy')->name('hapus.kategori');
     Route::get('/pelanggan/hapus/{id}', 'CustomerController@destroy')->name('hapus.pelanggan');
     Route::get('/bank/hapus/{id}', 'BankController@destroy')->name('hapus.bank');
      Route::get('/bank/hapus/bukti/{id}', 'BuktiController@destroy')->name('hapus.bukti');
      Route::get('/retur/hapus/{id}', 'ReturController@destroy')->name('hapus.retur');
        Route::get('/role/hapus/{id}', 'RoleController@destroy')->name('hapus.role');
        Route::get('/hapus/user/{id}', 'UserController@destroy')->name('hapus.user');
        Route::get('hapus/sub/{id}', 'SubController@destroy')->name('hapus.subprod');
        Route::post('/create/category','CategoryController@store')->name('category.store');
        Route::get('/category/index','CategoryController@index')->name('index.category');
        Route::get('/category/tambah','CategoryController@create')->name('tambah.category');
        Route::post('/update/category/{id}','CategoryController@update')->name('update.category');
        Route::get('/cari/kategori','CategoryController@cari')->name('cari.category');
        Route::get('/notif/get','OrderController@getnotif');




     Route::get('/index/coba', 'CobaController@coba' );


     Route::get('/ajax-subcat/{id}','ProductController@getsubcat');

     Route::get('/jurnal','jurnalController@index')->name('jurnal');

     Route::get('/komisi','komisiController@index')->name('komisi');


     Route::resource('atur_hargajual','bagi_profitController');

     Route::get('/bagi_profit/hapus/{id}','bagi_profitController@destroy')->name('bagi_profit.hapus');


     Route::get('/edit/status/profit/{id}','komisiController@edit')->name('komisi.edit');
     Route::post('/update/profit/status/{id}','komisiController@update')->name('update.profit');


     Route::get('/atur_profit','atur_profitController@index')->name('atur_profit.index');
     Route::post('/atur_profit/update/{id}','atur_profitController@update')->name('atur_profit.update');
     Route::get('/atur_profit/edit/{id}','atur_profitController@edit')->name('atur_profit.edit');

     Route::get('cair_komisi','cair_komisiController@index')->name('cair_komisi.index');

     Route::get('/atur/subsidi','subsidiController@index')->name('subsidi.index');
     Route::get('/edit/subsidi/{id}','subsidiController@edit')->name('subsidi.edit');
     Route::post('/update/subsidi/{id}','subsidiController@update')->name('update.subsidi');

     Route::get('/atur_poin','batas_pembelianController@index')->name('batas_pembelian.index');

     Route::get('/edit/atur_poin/{id}','batas_pembelianController@edit')->name('batas_pembelian.edit');
     Route::post('/update/batas_pembelian/{id}','batas_pembelianController@update')->name('update.batas_pembelian');
     Route::get('/edit/admin/{id}','UserController@editadmin')->name('editadmin');
     Route::post('/admin/update/{id}','UserController@updateadmin')->name('adminupdate');
     Route::get('/induk/kategori','CategoryController@induk')->name('induk');
     Route::get('/induk/tambah','CategoryController@createinduk')->name('tambah.induk');
     Route::post('/tambah/induk','CategoryController@storeinduk')->name('store.induk');
     Route::get('/hapus/induk/{id}','CategoryController@destroyinduk')->name('hapus.induk');
     Route::get('/edit/induk/{id}','CategoryController@editinduk')->name('edit.induk');
     Route::post('/edit/post/induk/{id}','CategoryController@editindukpost')->name('edit.induk.post');
     Route::get('/cari/nama/induk/','CategoryController@cariinduk')->name('cari.induk');


});
Auth::routes();














Route::get('refresh_captcha', 'Auth\LoginController@refreshCaptcha')->name('refresh_captcha');









    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

















