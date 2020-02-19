@extends('layouts.master')

@section('title')
    <title>Request stock barang</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Request stock barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                            
                               @php
                                $nama = Auth::user()->name;
                            @endphp
                            <form action="{{ route('proses.send') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                 <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="hidden" name="nama_cabang" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $nama }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->code }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                
                                <!-- role nama -->
                               
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="hidden" name="stock_id"  value="{{ $product->product_stock_id }}">
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                              
                                @role('level1')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                @role('level2')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                @role('level3')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                
                                <!-- end role nama-->
                                
                                <!-- role desc -->
                           
                                
                                @role('level1')
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                        cols="5" rows="5" 
                                        readonly
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                @endrole
                                
                                @role('level2')
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                        cols="5" rows="5" 
                                        readonly
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                @endrole
                                
                                @role('level3')
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                        cols="5" rows="5" 
                                        readonly
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                @endrole
                                
                                <!-- end role desc-->
                                
                                <!-- role stok -->
                                
                                <div class="form-group">
                                    <label for="">Stock</label>
                                    <input type="number" name="stock" required 
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                               <div class="form-group">
                                    
                                  
                                    <input type="hidden" name="photo"  class="form-control" value="{{  $product->photo }}" >
                                   
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $product->photo) }}" 
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                
                                @role('level1')
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                        value="{{ $product->stock }}"
                                        readonly
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                @endrole
                                
                                @role('level2')
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                        value="{{ $product->stock }}"
                                        readonly
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                @endrole
                                
                                @role('level3')
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                        value="{{ $product->stock }}"
                                        readonly
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                @endrole
                                
                                <!-- end role stok-->
                                
                                <!-- role harga -->
                                
                                
                                <!-- end role harga-->
                                
                                 <!-- role kategori-->
                           
                                
                                @role('level1')
                                <div class="form-group">
                                    <input type="hidden" name="category_id" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->category_id }}"
                                        class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                @endrole
                                
                                @role('level2')
                                <div class="form-group">
                                    <input type="hidden" name="category_id" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->category_id }}"
                                        class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                @endrole
                                
                                @role('level3')
                                <div class="form-group">
                                    <input type="hidden" name="category_id" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->category_id }}"
                                        class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                @endrole
                                
                                <!-- end role kategori-->
                                
                                
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> request stock
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