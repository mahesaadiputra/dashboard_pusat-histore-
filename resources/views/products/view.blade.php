@extends('layouts.master')

@section('title')
    <title>view Data Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">view Data product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">edit</li>
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
                         
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->code }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                
                            
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                    readonly
                                        value="{{ $product->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                <div class="form-group">
                                        <label for="">Nama Toko</label>
                                        <input type="text" name="nama_umkm" required 
                                        readonly
                                            value="{{ $product->nama_umkm }}"
                                            class="form-control {{ $errors->has('nama_umkm') ? 'is-invalid':'' }}">
                                        <p class="text-danger">{{ $errors->first('nama_umkm') }}</p>
                                    </div>
                                    <div class="form-group">
                                            <label for="">Alamat UMKM</label>
                                            <input type="text" name="alamat_umkm" required 
                                            readonly
                                                value="{{ $product->alamat_umkm }}"
                                                class="form-control {{ $errors->has('alamat_umkm') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('alamat_umkm') }}</p>
                                        </div>
                          
                              
                               
                           
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                      readonly
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $product->description }}</textarea>
                                      
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                           
                           
                           
                             <div class="form-group">
                                    <label for="">minimum pembelian level 1</label>
                                    <input type="number" name="" required 
                                    readonly
                                        value="{{ $product->minimum_level_1 }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                
                                
                                
                                 
                           
                             <div class="form-group">
                                    <label for="">minimum pembelian level 2</label>
                                    <input type="number" name="" required 
                                    readonly
                                        value="{{ $product->minimum_level_2 }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                
                                
                                   
                             <div class="form-group">
                                    <label for="">minimum pembelian level 3</label>
                                    <input type="number" name="" required 
                                    readonly
                                        value="{{ $product->minimum_level_3 }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                
                                
                                   
                             <div class="form-group">
                                    <label for="">minimum pembelian level 4</label>
                                    <input type="number" name="" required 
                                    readonly
                                        value="{{ $product->minimum_level_4 }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                
                         
                             
                             
                                <div class="form-group">
                                    <label for="">Weight</label>
                                    <input type="float" name="weight"  required 
                                        value="{{ $product->weight }}"
                                        readonly
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                               
                               
                                <div class="form-group">
                                    <label for="">lebar</label>
                                    <input type="float" name="weight"  required 
                                        value="{{ $product->lebar }}"
                                        readonly
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="">tinggi</label>
                                    <input type="float" name="weight"  required 
                                        value="{{ $product->tinggi }}"
                                        readonly
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                               
                                 <div class="form-group">
                                    <label for="">volume</label>
                                    <input type="float" name="weight"  required 
                                        value="{{ $product->volume }}"
                                        readonly
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                               
                               
                        
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <input type="text" name="name" required 
                                    readonly
                                        value="{{ $product->category->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                </div>
                        
                                <div class="form-group">
                                    <label for="">sub category</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->Sub_Category->sub_nama }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">unggulan</label>
                                    <input  name="weight"  required 
                                        value="{{ $product->unggulan }}"
                                        readonly
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                            
                                
                                
                                
                                <div class="form-group">
                                    <label for="">Foto 1</label>
                                  
                                
                             
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $product->photo) }}" 
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                    
                                    
                                    
                                </div>
                                
                                
                                              <div class="form-group">
                                    <label for="">Foto 2</label>
                                  
                                
                             
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo_2))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $product->photo_2) }}" 
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                              <div class="form-group">
                                    <label for="">Foto 3</label>
                                  
                                
                             
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo_2))
                                        <hr>
                                        <img src="{{ asset('uploads/product/' . $product->photo_3) }}" 
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                
                                
                                
                                              <div class="form-group">
                                    <label for="">Barcode  </label>
                                  
                                
                             
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($product->photo_2))
                                        <hr>
                                        <img src="{{ asset('uploads/barcode/' . $product->barcode) }}" 
                                            alt="{{ $product->name }}"
                                            width="150px" height="150px">
                                    @endif
                                    
                                    
                                    
                                </div>
                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection