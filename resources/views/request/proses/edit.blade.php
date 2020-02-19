@extends('layouts.master')

@section('title')
    <title>Edit Data Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Review jumlah stock</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            
                        
                            
                            <form action="{{ route('stock.kirim') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_order" value="{{$proses_request[0]['product_id']}}">
                                 <input type="hidden" name="id" value="{{$proses_request[0]['id']}}">
                                 <input type="hidden" name="userid" value="{{$proses_request[0]['user_id']}}">
                                 <input type="hidden" name="status" value="2">
                                  <input type="hidden" name="nama_stock" value="{{$proses_request[0]['nama_cabang']}}">
                                 
                                  
                                
                                
                                <!-- role nama -->
                              
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $proses_request[0]['nama_product'] }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                             
                            
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                        value="{{ $proses_request[0]['jumlah_request'] }}"
                                        readonly
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>




 <td>
                                               
                                                    <img src="{{ asset('uploads/barcode/' . $proses_request[0]['barcode']) }}" 
                                                        alt="{{ $proses_request[0]['nama_product'] }}" width="100px" height="100px">
                                          
                                            </td>
                                <!-- </div>
                         
                                    <div class="form-group">
                                    <label for="">Barcode</label>
                                    <input type="file" name="barcode" class="form-control">
                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                </div>
                              -->
                             
                                
                                
                                
                              
                                
                                <div class="form-group">
                                  
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $proses_request->photo) }}" 
                                            alt="{{ $proses_request->nama_product }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> kirim
                                    </button>
                                </div>
                            </form>
                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection