<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Exports\OrderInvoice;
use Carbon\Carbon;
use App\Customer;
use App\Product;
use App\Order;
use App\User;
use App\Category;
use App\stock_kasir;
use App\Order_detail;
use App\stock_level;
use App\Kota;
use RajaOngkir;
use Cookie;
use DB;
use PDF;
use Auth;
use GuzzleHttp\Client;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\voucher;
use App\jurnal;
use App\komisi;
use Illuminate\Support\Facades\Input;
use Route;
use App\atur_profit;
use App\subsidi;
use App\batas_pembelian;
use App\anggota;


class OrderController extends Controller
{

    public function addOrder()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('orders.add', compact('products'));
    }

    public function getProductlist()
    {
        if (Auth::user()->hasPermissionTo('user')) 
         {
              $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.harga_user as price',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->get();
         }elseif (Auth::user()->hasPermissionTo('level1')) 
         {
              $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level1 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->get();
         }elseif (Auth::user()->hasPermissionTo('level2')) 
         {
              $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level2 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->get(); 
         }elseif (Auth::user()->hasPermissionTo('level3')) 
         {
              $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level3 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->get();
         }elseif (Auth::user()->hasPermissionTo('level4')) 
         {
              $products = 
              Product::select(
                  'products.id',
                  'code',
                  'name',
                  'products.price_level4 as price',
                  'products.harga_user as price_user',
                  'product_stock_id',
                  'stock_kasirs.Jakarta as stock',
                  'description',
                  'weight',
                  'category_id',
                  'photo',
                  'photo_2',
                  'photo_3',
                  'created_at',
                  'updated_at')
                  ->join('stock_kasirs','products.product_stock_id','=','stock_kasirs.id')
                  ->get();  
         }
     
     
            if ($products) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $products,
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);

    }

   
    
    
    
    
    public function ambilbarang(Request $request){
        $cek = auth()->user()->userid;
        $cekpro = auth()->user()->provinsi;
        
        $gayus = null;
            $provinsi1 = 'JAWA BARAT';
        
        $this->validate($request, [
                    'id' => 'required',
                ]);
                
               if ($request->data !== null)
                {
        
                    $result = json_decode($request->data);
                    
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('GET', 'http://ipehapp.intek.id/histore/level3.php?userid='.$cek);
                    $data = $response->getBody();
                    
                    $wek = json_decode($data, true);
                    $hasil = $wek['jaringan'];
                
                     //ambil array 1,2,3
                    
                    if(!empty($hasil[0])){
                    $userid = $hasil[0]['userid'];
                    $ceout = user::where('userid', $userid)->first();
                    $ids = $ceout['id'];
                    }
                    
                    if(!empty($hasil[1])){
                    $userid1 = $hasil[1]['userid'];
                    $ceout = user::where('userid', $userid1)->first();
                    $ids1 = $ceout['id'];
                    }
                    
                    
                    if(!empty($hasil[2])){
                    $userid2 = $hasil[2]['userid'];
                    $ceout = user::where('userid', $userid2)->first();
                    $ids2 = $ceout['id'];
                    }
                    
                    DB::beginTransaction();
                    try {
                        
                        $sum_amount = 0;
                        $tot = 0;
                        foreach($result as $item => $value  ){

                                $number = $value->product_stock_id;
                                $convert = number_format($number, 0, '.', ',');
                                
                                $products = Product::findOrFail($value->id);
                                
                                // cek stock
                                if (!empty($ids)){
                                $stock_level = stock_level::where('user_id', $ids)->where('product_id', $value->id)->first();
                                }
                                if (!empty($ids1)){
                                $stock_level1 = stock_level::where('user_id', $ids1)->where('product_id', $value->id)->first();
                                }
                                if (!empty($ids2)){
                                $stock_level2 = stock_level::where('user_id', $ids2)->where('product_id', $value->id)->first();
                                }
                                
                                $stocks = stock_kasir::findOrFail($convert);
                                
                                // beli stock level
                                if(!empty($stock_level) && $value->qty <= $stock_level->stock){
                                    $beli = $ids;
                                    $ceklevel = user::where('id', $ids)->first();
                                    $sesat = $ceklevel->karir;
                                    $stock_level->stock = $stock_level->stock - $value->qty;
                                    $stock_level->save();
                                }else if(!empty($stock_level1) && $value->qty <= $stock_level1->stock){
                                    $beli = $ids1;
                                    $ceklevel = user::where('id', $ids1)->first();
                                    $sesat = $ceklevel->karir;
                                    $stock_level1->stock = $stock_level1->stock - $value->qty;
                                    $stock_level1->save();
                                }else if(!empty($stock_level2) && $value->qty <= $stock_level2->stock){
                                    $beli = $ids2;
                                    $ceklevel = user::where('id', $ids2)->first();
                                    $sesat = $ceklevel->karir;
                                    $stock_level2->stock = $stock_level2->stock - $value->qty;
                                    $stock_level2->save();
                                }else{
                                    $stocks->Jawa_barat -= $value->qty;
                                    $sesat = "cabang";
                                    $gayus = auth()->user()->provinsi;
                                    $beli = null;
                                    $products->save();
                                    $stocks->save();
                                    
                                    $products->save();
                                }
                                if(!empty($beli)){
                                $user = user::where('id', $beli)->first();
                                $name = $user->userid;
                                $karir = $user->karir;
                                }
                                
                                $sum_amount = $tot += $value->price * $value->qty;
                            
                            
                        }
                        
                        
                        if(!empty($beli)){
                            
                            if(!empty($name) && $karir == "Bintang 1"){
                                $u1= $name;
                                $u2= null;
                                $u3= null;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 2"){
                                $u1= "untuk histore";
                                $u2= $name;
                                $u3= null;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 3"){
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= $name;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 4"){
                                $u1=  "untuk histore";
                                $u2=  "untuk histore";
                                $u3=  "untuk histore";
                                $u4 = $name;
                            }
                            
                            if(!empty($name) && $karir == "Bintang 2"){
                                $u1= "untuk histore";
                                $u2= $name;
                                $u3= null;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 3"){
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= $name;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 4"){
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= "untuk histore";
                                $u4 = $name;
                            }
                            
                            if(!empty($name) && $karir == "Bintang 3"){
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= $name;
                                $u4 = null;
                            }else if(!empty($name) && $karir == "Bintang 4"){
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= "untuk histore";
                                $u4 = $name;
                            }
                            
                            }else{
                                $u1= "untuk histore";
                                $u2= "untuk histore";
                                $u3= "untuk histore";
                                $u4 = "untuk histore";
                        }
                        
                        
        
                        $order = Order::create([
                            'invoice' => $this->generateInvoiceMobile(),
                            'customer_id' => $request->id,
                            'user_id' => auth()->user()->id,
                            'total' => $sum_amount,
                            'harga_jual' => $sum_amount,
                            'karir' => $sesat,
                            'nama_cabang' => $gayus,
                            'usrid_level1' => $u1,
                            'usrid_level2' => $u2,
                            'usrid_level3' => $u3,
                            'usrid_level4' => $u4,
                            'status' => 0,
                            'type' => 1
                        ]);
                        
                        $proses = User::where('userid',$cek)->first();
                            $jumlah_poin = $proses->poin;
                            $itungpoin = $jumlah_poin - $sum_amount;
                            User::where('userid',$proses->userid)->update([
                                'poin' => $itungpoin,
                            ]);
                        
                        
                        foreach ($result as $key => $row) {
                            $order->order_detail()->create([
                                'product_id' => $row->id,
                                'qty' => $row->qty,
                                'buy_to' => $beli,
                                'user_id' => auth()->user()->id,
                                'price' => $row->price
                            ]);
                        }
                        
                    
                        
                        DB::commit();
            
                        return response()->json([
                            'state' => true,
                            'data' => $order,
                            // 'kode barang' => $order->invoice,
                            // 'message' => 'harap masukan barang kembali sebelum checkout ( membeli )',
                            'message' => 'Sukses melakukan checkout silahkan lakukan pembayaran dengan invoice '.$order->invoice.' bayar sampai 3 digit terakhir',
                        ], 200);
                        
                        
                    } catch (\Exception $e) {
                        DB::rollback();
                        return response()->json([
                            'state' => false,
                            'message' => 'hanya bisa membeli 1 jenis barang / masukan barang '.$e->getMessage()
                        ], 400);
                    }
                }else{
                    return response()->json([
                        'state' => false,
                        'message' => 'harap masukan barang kembali sebelum checkout ( membeli )',
                    ], 400);
                }
    }
    
    
    
    
    public function get()
    {
        $order_detail = order_detail::all();
            if ($order_detail) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $order_detail
                ], 200);
            }
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
    }
    
    

    public function generateInvoice()
    {
        $order = Order::orderBy('created_at', 'DESC');
        if ($order->count() > 0) {
            $order = $order->first();
            $explode = explode('-', $order->invoice);
            $count = $explode[1] + 1;
            return 'INV-' . $count;
        }
        return 'INV-0';
    }
    
    public function generateInvoiceMobile() {
        $t=time();
        $rand = rand(1000,9999);
        return 'INV-'.$t.'-'. $rand;
    }
    
    public function refid() {
        $order = Order::orderBy('created_at', 'DESC');
        if ($order->count() > 0) {
            $order = $order->first();
            $explode = explode('-', $order->invoice);
            $count = $explode[1] + 1;
            return $count;
        }
        return '0';
    }
    

    public function index(Request $request)
    {
        
        $customers = Customer::orderBy('name', 'ASC')->count();
        $users = anggota::orderBy('name', 'ASC')->get();
         $countbeli=Order::count();
        $orders = Order::orderBy('created_at', 'DESC')->with('order_detail', 'customer');
          $counttotal=Order::sum('total');

        if (!empty($request->customer_id)) {
            $orders = $orders->where('customer_id', $request->customer_id);
        }
         if (!empty($request->invoice)) {
            $orders = $orders->where('invoice','like', "%$request->invoice%");
        }
 if (!empty($request->email)) {
            $orders = $orders->whereHas('anggota', function ($query) use ($request){$query->where('email', 'like', '%'.$request->email.'%');
                
            })->with(['anggota' => function($query) use ($request){$query->
            where('email', 'like', '%'.$request->email.'%');}]);
        }
if (!empty($request->nama)) {
            $orders = $orders->whereHas('anggota', function ($query) use ($request){$query->where('name', 'like', '%'.$request->nama.'%');
                
            })->with(['anggota' => function($query) use ($request){$query->
            where('name', 'like', '%'.$request->nama.'%');}]);
        }
        if (!empty($request->hp)) {
            $orders = $orders->whereHas('Customer', function ($query) use ($request){$query->where('phone', 'like', '%'.$request->hp.'%');
                
            })->with(['Customer' => function($query) use ($request){$query->
            where('phone', 'like', '%'.$request->hp.'%');}]);
        }
        if (!empty($request->alamat)) {
            $orders = $orders->whereHas('Customer', function ($query) use ($request){$query->where('address', 'like', '%'.$request->alamat.'%');
                
            })->with(['Customer' => function($query) use ($request){$query->
            where('address', 'like', '%'.$request->alamat.'%');}]);
        }
      if (!empty($request->status)) {
          if($request->status == "9"){
$orders=Order::orderBy('created_at', 'DESC')->with('order_detail', 'customer')->where('status',0)->paginate($countbeli);


        return view('orders.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $counttotal,
            'total_customer' => $countbeli,
            'customers' => $countbeli,
            'users' => $users
        ]);

          }
        $orders=Order::orderBy('created_at', 'DESC')->with('order_detail', 'customer')->where('status',$request->status)->paginate($countbeli);

        return view('orders.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $counttotal,
            'total_customer' => $countbeli,
            'customers' => $countbeli,
            'users' => $users
        ]);
        }



        if (!empty($request->user_id)) {
            $orders = $orders->where('user_id', $request->user_id);
        }
        
        if (!empty($request->start_date) && !empty($request->end_date)) {
            $this->validate($request, [
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date'
            ]);
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01';
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59';

            $orders = $orders->whereBetween('created_at', [$start_date, $end_date])->paginate(10);
        } else {
            $orders = $orders->take(100)->skip(0)->paginate(10);
        }

        return view('orders.index', [
            'orders' => $orders,
            'sold' => $this->countItem($orders),
            'total' => $this->countTotal($orders),
            'total_customer' => $this->countCustomer($orders),
            'customers' => $customers,
            'users' => $users
        ]);
    }

    private function countCustomer($orders)
    {
        $customer = [];
        if ($orders->count() > 0) {
            foreach ($orders as $row) {
                $customer[] = $row->customer->email;
            }
        }
        return count(array_unique($customer));
    }

    private function countTotal($orders)
    {

       $total=0;{ 
        $total = Order::sum('total');
       }
       return $total;
    }



    private function countItem($order)
    {
        $data = 0;{ 
        $data = Order_detail::sum('qty');
           
           
           
           
       }
        return $data;
    }

    public function invoicePdf($invoice)
    {
        $order = Order::where('invoice', $invoice)
            ->with('customer', 'order_detail', 'order_detail.product')->first();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadView('orders.report.invoice', compact('order'));
        return $pdf->stream();
    }

    public function invoiceHtml($invoice)
    {
        $orders = Order::where('invoice', $invoice)->with('customer', 'order_detail', 'order_detail.product')->first();
        $order_detail = order_detail::where('order_id',$orders->id)->get();
        $users = anggota::where('id', $orders->user_id)->first();
        $users_mitra = anggota::where('id', $orders->buy_to)->first();
        

        return view('orders.report.invoice_html', [
            'orders' => $orders,
            'order_detail' => $order_detail,
            'users' => $users,
            'users_mitra' => $users_mitra,


        ]);
    }

    public function invoiceExcel($invoice)
    {
        return (new OrderInvoice($invoice))->download('invoice-' . $invoice . '.xlsx');
    }
    
    public function addToCartapi(Request $request)
    {
        // $this->validate($request, [
        //     'product_id' => 'required|exists:products,id',
        //     'qty' => 'required|integer'
        // ]);
        
        if (empty($request->product_id) || empty($request->qty)){
            return response()->json([
                    'state' => false,
                    'message' => 'Product ID atau QTY is required',
                    'data' => null
                ], 400);;
        }
        
        $product = Product::find($request->product_id);
        
        if($product != null){
            $getCart = json_decode($request->cookie('cart'), true);

            if ($getCart) {
                if (array_key_exists($request->product_id, $getCart)) {
                    $getCart[$request->product_id]['qty'] += $request->qty;
                    return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $getCart
                    ], 200)->cookie('cart', json_encode($getCart), 120);
                    
                } 
            }
            
            $getCart[$request->product_id] = [
                'stock_id' => $product->product_stock_id,
                'code' => $product->code,
                'name' => $product->name,
                'price' => $product->price,
                'price_level1' => $product->price_level1,
                'price_level2' => $product->price_level2,
                'price_level3' => $product->price_level3,
                'stock_jakarta' => $product->stock_kasir->Jakarta,
                'stock_bandung' => $product->stock_kasir->Jumlah,
                'qty' => $request->qty,
                
            ];
            
            
            
            return response()->json([
                        'state' => true,
                        'message' => 'succes post data',
                        'data' => $getCart
                    ], 200)->cookie('cart', json_encode($getCart), 120);
        }else{
            return response()->json([
                    'state' => false,
                    'message' => 'Product not found',
                    'data' => null
                ], 400);;
        }
            
    }

    public function getCartapi()
    {
        
        $cart = json_decode(request()->cookie('cart'), true);
            if ($cart) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $cart
                ], 200);
            }
            
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
        
        
    }

    public function removeCartapi($id)
    {
        $cart = json_decode(request()->cookie('cart'), true);
        unset($cart[$id]);
        return response()->json($cart, 200)->cookie('cart', json_encode($cart), 120);
    }
    
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = anggota::orderBy('name', 'ASC')->get();
        $customers = Customer::orderBy('name', 'ASC')->get();
        return view('orders.edit', compact('order', 'customers','users'));
    }




    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice' => 'required|string|max:100',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'total' => 'required|string|max:100',
            'status' => 'required|string|max:100',
        ]);

        try {
            $order = Order::findOrFail($id);
 
           $order->update([
                'invoice' => $request->invoice,
                'customer_id' => $request->customer_id,
                'user_id' => $request->user_id,
                'total' => $request->total,
                'status' => $request->status,
            ]);
            
            // pembayaran ditolak
            if($request->status == -1){
                
                
                if(empty($order->nama_cabang)){
                    
                      $order_detail=Order_detail::where('order_id',$order->id)->first();
                      
                      
                      
                      
                      $stock_level=stock_level::where('product_id',$order_detail->product_id)->first();
                      
                    $jumlah=  $stock_level->stock;
                      $stock_level->update([
                          
                          'stock'=> $jumlah+$order_detail->qty,
                      
                      
                      ]);
                      
                      
                      
                    
                    
                }
                
                
                
                
                
          if($order->karir=='cabang'){
              
              
               $order_detail=Order_detail::where('order_id',$order->id)->first();
          
          
          
                if($order->nama_cabang== 'JAWA BARAT'){
                    
                    $cabang="Jawa_barat";
                    
                    
                }
                
                
                   if($order->nama_cabang== 'JAWA TENGAH'){
                    
                    $cabang="Jawa_tengah";
                    
                    
                }
                    
                    $product=Product::where('id',$order_detail->product_id)->first();
                    
                    $id=$product->product_stock_id;
                    
                    
                
                    
                    $stock_level=stock_kasir::where('id',$product->product_stock_id)->first();
   $jumlah= $stock_level->$cabang;
                        
                   stock_kasir::where('id',$product->product_stock_id)->update([
                        
                        $cabang=>$jumlah+$order_detail->qty,
                        
                        
                        
                        
                        ]);
              
          }
          
                
         
                    
            // pembayaran diterima
            }elseif($request->status == 1){
                   
            // barang dikirim
            }elseif($request->status == 2){
                
                // order kirim ke KURIR
                if($order->type == 0){
                    
                    $msg_notif = 'Barang telah dikirim dengan RESI '.$request->resi;
                    $order->update([
                        'message' => $msg_notif
                    ]);
                    
                // order ambil sendiri
                }else if($order->type == 1){
                    
                    $msg_notif = 'Silahkan mengambil barang anda di Cabang Jakarta';
                    $order->update([
                        'message' => $msg_notif
                    ]);
                    
                // order kirim ke VIRTUAL STOCK
                }else if($order->type == 2){
                    $msg_notif = 'Telah ditambahkan ke virtual stock anda';
                    $order->update([
                        'message' => $msg_notif
                    ]);
                    
                    // tambah ke virtual stock
                    $order_detail = Order_detail::where('order_id', $order->id)->get();
                    foreach($order_detail as $item){
                        $product = Product::find($item->product_id);
                        
                        $stock_level = stock_level::where('user_id', $item->user_id)->where('product_id', $item->product_id)->first();
                        if($stock_level != null){
                            $stock_level->stock = $stock_level->stock + $item->qty;
                            $stock_level->save();
                        }else{
                            $stock_level = new stock_level();
                            $stock_level->user_id = $item->user_id;
                            $stock_level->product_id = $item->product_id;
                            $stock_level->stock = $item->qty;
                            $stock_level->save();
                        }
                    }
                }
                
            }elseif($request->status == 3){ 
                
                
                
                
                $user=User::where('hp',$request->id_akun)->first();
                
                $jumlah=$user->saldopoin1;
                
                
                $user->update([
                    
                    'saldopoin1'=>$request->jumlah+$jumlah,
                    
                    
                    
                    
                    
                    ]);
                
                
                
                
                
                
                
                
                $order=order::where('invoice',$request->invoice)->first();
                $order_detail=Order_detail::where('order_id',$order->id)->first();
                $product=Product::where('id',$order_detail->product_id)->first();
                $no_hp1=User::where('userid',$order->usrid_level1)->first();
                 $no_hp2=User::where('userid',$order->usrid_level2)->first();
                $no_hp3=User::where('userid',$order->usrid_level3)->first();
                 $no_hp4=User::where('userid',$order->usrid_level4)->first();
                $no_hp_intek=User::where('userid','intek')->first();
                 $no_hp_sellhbm=User::where('userid','sellshbm')->first();
                  $no_hp_penjualan=User::where('userid','penjualan')->first();
                    $no_hp_komisi=User::where('userid','pendapatankomisi')->first();
                    $bebanongkirhp=User::where('userid','bebanongkir')->first();
                       $tampungongkir=User::where('userid','penampunganongkir')->first();
                    $bebanvocher=User::where('userid','bebanvoucher')->first();
                     $tampungvoucher=User::where('userid','penampunganvoucher')->first();
                    $jurnal_sellhbm=jurnal::create([
                    
                    'id_akun' =>$no_hp_sellhbm->hp,
                    'id_nama'=>$no_hp_sellhbm->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual-(50/100*$order->harga_jual+1500),
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                    
                    ]);
                 
                    if(!empty($order->usrid_level1)){
                        
                        
                $jurnal=jurnal::create([
                 
                    'id_akun' =>$no_hp1->hp,
                    'id_nama'=>$no_hp1->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*5/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                    
                       'no_inv'=>$order->invoice,
                    ]);
                    
                   
                
           
                        
                        
                    }
                    if(!empty($order->usrid_level2)){
                    $jurnal2=jurnal::create([
                    
                    'id_akun' =>$no_hp2->hp,
                    'id_nama'=>$no_hp2->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*10/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                      'no_inv'=>$order->invoi
                    
                    ]);
                    }
                    if(!empty($order->usrid_level3)){
                      $jurnal3=jurnal::create([
                     
                    'id_akun' =>$no_hp3->hp,
                       'id_nama'=>$no_hp3->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*15/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                      'no_inv'=>$order->invoi
                    
                    ]);}
                    
                     if(!empty($order->usrid_level4)){
                      $jurnal4=jurnal::create([
                     
                    'id_akun' =>$no_hp4->hp,
                     'id_nama'=>$no_hp4->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>$order->harga_jual*20/100,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                      'no_inv'=>$order->invoi
                    
                    ]);}
                    
                    
                    
                    
                    
                       $jurnal_intek=jurnal::create([
                    
                    'id_akun' =>$no_hp_intek->hp,
                     'id_nama'=>$no_hp_intek->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>1500,
                    'kredit'=>"0",
                    'ref_jurnal'=>$order->invoice,
                      'no_inv'=>$order->invoi
                    
                    ]);
                    
                    $jurnal_penjualan=jurnal::create([
                    
                    'id_akun' =>$no_hp_penjualan->hp,
                    'id_nama'=>$no_hp_penjualan->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>($order->harga_jual*50/100)+1500,
                    'ref_jurnal'=>$order->invoice,
                    
                      'no_inv'=>$order->invoi
                    ]);
                    
                    
                     $pendapatanhbm=jurnal::create([
                    
                    'id_akun' =>$no_hp_komisi->hp,
                    'id_nama' =>$no_hp_komisi->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->harga_jual-($order->harga_jual*50/100+1500),
                    'ref_jurnal'=>$order->invoice,
                    
                      'no_inv'=>$order->invoi
                    ]);
                    
                    if(!empty($order->nilai_ongkir)){
                    $bebanongkir=jurnal::create([
                    
                    'id_akun' =>$bebanongkirhp->hp,
                    'id_nama' =>$bebanongkirhp->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>$order->nilai_ongkir,
                    'kredit'=>0,
                    'ref_jurnal'=>$order->invoice,
                    
                      'no_inv'=>$order->invoi
                    ]);
                   }
                    
                    
                    
                    
                    
                     if(!empty($order->potongan_voucher)){
                    $bebanvocher=jurnal::create([
                    
                    'id_akun' =>$bebanvocher->hp,
                    'id_nama' =>$bebanvocher->name,
                    'keterangan'=>"pembelian ".$product->name,
                    'debet'=>$order->potongan_voucher,
                    'kredit'=>0,
                    'ref_jurnal'=>$order->invoice,
                    
                      'no_inv'=>$order->invoi
                    ]);}
                    
                    
                    if(!empty($order->nilai_ongkir)){
                     $penampunganongkir=jurnal::create([
                    
                    'id_akun' =>$tampungongkir->hp,
                    'id_nama' =>$tampungongkir->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->nilai_ongkir,
                    'ref_jurnal'=>$order->invoice,
                    
                      'no_inv'=>$order->invoi
                    ]);}
                    if(!empty($order->potongan_voucher)){
                     $penampunganvocher=jurnal::create([
                    
                    'id_akun' =>$tampungvoucher->hp,
                    'id_nama' =>$tampungvoucher->name,
                    'keterangan'=>"pemebelian ".$product->name,
                    'debet'=>0,
                    'kredit'=>$order->potongan_voucher,
                    'ref_jurnal'=>$order->invoice,
                      'no_inv'=>$order->invoice
                    
                    ]);}
                    
                    
    
            }

            return redirect(route('order.index'))
                ->with(['success' => '<strong>' . $order->invoice . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function updatestatus(Request $request, $id)
    {
       
            $order = Order::findOrFail($id);
 
           
    
              
            
            
           
           
             if($order->karir == "cabang" &&  !empty($order->nama_cabang) && empty($order->usrid_level1)&& empty($order->usrid_level2)&& empty($order->usrid_level3)&& empty($order->usrid_level4) && $order->invoice == $request->inv && $request->status==3){
                 
                 
                 $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
                
               $rand=rand(00000000,99999999);
              $jurnal=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' => ($order->harga_jual*$profit->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$order->nama_cabang,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                    $jurnal_reseller_cabang=  jurnal::create([
                       
                       
                       'id_akun'=> $user->hp,
                                    'id_nama'=>$user->name,
                                    'debet' => 0,
                                    'kredit'=>($order->harga_jual*$profit->profit /100) ,
                                    'ref_jurnal'=>$jurnal->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$order->nama_cabang,
                                    'ref_id'=>$order->ref_id
                
                ]);
                
                   return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
                
                
                
                
                
             }
                   if($order->karir == "cabang" &&!empty($order->nama_cabang) && !empty($order->usrid_level1)&&!empty($order->usrid_level2)&&!empty($order->usrid_level3)&&!empty($order->usrid_level4) && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
              $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' => ($order->harga_jual*$profit->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> '#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$order->nama_cabang,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_1->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_tampungjual2=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_2->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                 $jurnal_tampungjual3=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_3->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                 $jurnal_tampungjual4=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' => ($order->harga_jual*$profit_bintang_4->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                 $jurnal_histore_1=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_1->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                
                 $jurnal_histore_2=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_2->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                
                 $jurnal_histore_3=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_3->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                 $jurnal_histore_4=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_4->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                
                
                   $jurnal_reseller_cabang=  jurnal::create([
                       
                       
                       'id_akun'=> $user->hp,
                                    'id_nama'=>$user->name,
                                    'debet' => 0,
                                    'kredit'=>($order->harga_jual*$profit->profit /100) ,
                                    'ref_jurnal'=>$jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$order->nama_cabang,
                                    'ref_id'=>$order->ref_id
                
                ]);

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
              
              
              
              
              if($order->karir == "Bintang 3" && empty($order->nama_cabang) && !empty($order->usrid_level1)&&!empty($order->usrid_level2) && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
            
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_1->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=>'#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
                  $jurnal_tampungjual2=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_2->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                 $jurnal_tampungjual3=  jurnal::create(['id_akun'=> $user_bintang3->hp,
                                    'id_nama'=>$user_bintang3->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_3->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang3->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
              
                 $jurnal_histore_1=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_1->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                
                 $jurnal_histore_2=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_2->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                 $jurnallevel3=  jurnal::create(['id_akun'=> $user_bintang3->hp,
                                    'id_nama'=>$user_bintang3->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_3->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang3->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
               
                
               

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
              
              
              
              
                if($order->karir == "Bintang 3" && empty($order->nama_cabang) && empty($order->usrid_level1)&&empty($order->usrid_level2) && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
            
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_3->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=>'#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang3->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
    
                
                 $jurnallevel3=  jurnal::create(['id_akun'=> $user_bintang3->hp,
                                    'id_nama'=>$user_bintang3->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_3->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang3->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
               
                
               

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
              
              
            
            
            
            if($order->karir == "Bintang 2" && empty($order->nama_cabang) && !empty($order->usrid_level1) && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
            
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_1->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=>'#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
              
                
                 $jurnal_tampungjual2=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_2->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang2->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
              
                 $jurnal_histore_1=  jurnal::create(['id_akun'=> $user_histore->hp,
                                    'id_nama'=>$user_histore->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_1->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_histore->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
                
        
                
                 $jurnallevel2=  jurnal::create(['id_akun'=> $user_bintang2->hp,
                                    'id_nama'=>$user_bintang2->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_2->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang2->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
               
                
               

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
                
                
                
                if($order->karir == "Bintang 2" && empty($order->nama_cabang) && empty($order->usrid_level1) && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
            
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_2->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=>'#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang2->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
              
                
                 
              
                
        
                
                 $jurnallevel2=  jurnal::create(['id_akun'=> $user_bintang2->hp,
                                    'id_nama'=>$user_bintang2->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_2->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang2->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
               
                
               

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
            
            
            
            
            
            
            
              if($order->karir == "Bintang 1" && empty($order->nama_cabang)  && $order->invoice == $request->inv && $request->status==3){
                
               $tampungjual=user::where('userid','tampungjual')->first();
        $order=Order::where('invoice',$request->inv)->first();
     $profit=atur_profit::where('nama_karir','cabang')->first();
       $profit_bintang_1=atur_profit::where('nama_karir','Bintang 1')->first();
     $profit_bintang_2=atur_profit::where('nama_karir','Bintang 2')->first();
       $profit_bintang_3=atur_profit::where('nama_karir','Bintang 3')->first();
       $profit_bintang_4=atur_profit::where('nama_karir','Bintang 4')->first();
     $komisicabang=komisi::where('id_nama',$order->nama_cabang)->first();
$user=User::where('userid',$order->nama_cabang)->first();
$user_bintang1=User::where('userid',$order->usrid_level1)->first();
$user_bintang2=User::where('userid',$order->usrid_level2)->first();
$user_bintang3=User::where('userid',$order->usrid_level3)->first();
$user_bintang4=User::where('userid',$order->usrid_level4)->first();
$user_histore=User::where('userid',$order->usrid_level1)->first();
              $order->update([
                
                'status' => $request->status,
            ]);
           
           
           
                
                $rand=rand(00000000,99999999);
            
                
                
                  $jurnal_tampungjual1=  jurnal::create(['id_akun'=> $tampungjual->hp,
                                    'id_nama'=>$tampungjual->name,
                                    'debet' =>($order->harga_jual*$profit_bintang_1->profit /100),
                                    'kredit'=> 0,
                                    'ref_jurnal'=>'#'.$rand,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang1->name,
                
                                    'ref_id'=>$order->ref_id
                        
                
                
                
             
                
                
                
                
                ]);
                
                
              
                
                 
              
                
        
                
                 $jurnallevel2=  jurnal::create(['id_akun'=> $user_bintang1->hp,
                                    'id_nama'=>$user_bintang1->name,
                                    'debet' =>0,
                                    'kredit'=>  ($order->harga_jual*$profit_bintang_1->profit /100),
                                    'ref_jurnal'=> $jurnal_tampungjual1->ref_jurnal,
                                    'no_inv' =>$request->inv,
                                    'keterangan'=>"profit ".$user_bintang1->name,
                
                                    'ref_id'=>$order->ref_id
                
                
                
             
                
                
                
                
                ]);
                
               
                
               

                
                    return response()->json([
                    'state' => true,
                    'message' => 'barang sudah di terima',
                ], 200);  
                
               
            }
              
              
           
           
           
           
           
           
           
           else{
    
    
    
     return response()->json([
                'message' => 'barang bukan punya anda !!!',
              
            ],401);
}
            
    }
                
            
            
                   
            
               
           
    
    
    
    
    
    
    
    
    
            
    
    
    
    
    
    
    
    
    
    
    
    
    public function mystockies($auth){
        $auth = auth()->user()->id;
        
        $stock_level =  stock_level::select(
                  'stock_level.id as id',
                  'products.id',
                  'products.code',
                  'products.name',
                  'products.price as price',
                  'products.description',
                  'products.weight',
                  'products.lebar',
                  'products.tinggi',
                  'products.volume',
                  'products.category_id',
                  'products.photo',
                  'products.photo_2',
                  'products.photo_3',
                  'stock_level.stock as stock',
                  'users.name as milik'
                  )
                  ->join('products','stock_level.product_id','=','products.id')
                   ->join('users','stock_level.user_id','=','users.id')
                  ->where('user_id', $auth)->get();
        
        if ($stock_level) {
                return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $stock_level
                ], 200);
            }
            
            return response()->json([
                'message' => 'failed get data',
                'data' => []
            ]);
        
    }
    
    
     public function validasivoucher(Request $request){
        
        
        $voucher=voucher::where('kode_voucher',$request->voucher)->first();
        
        if($voucher->status=="r"){
              return response()->json([
                    'state' => true,
                    'message' => 'succes get data',
                    'data' => $voucher
                ], 200);
            
            
            
            
        }
        
        
        else{
            
             return response()->json([
                 'state' =>false,
                'message' => 'voucher tidak valid atau kadaluarsa',
            ],401);
            
            
        }
        
        
        
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    public function getnotif(){
        
        
        $notif['data']=Order::getnotif();
        echo json_encode($notif);
        exit;
        
        
        
    }
    
    
    
    



    
    
}
