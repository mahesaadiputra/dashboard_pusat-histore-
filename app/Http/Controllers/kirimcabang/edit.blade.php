@extends('layouts.master')

@section('title')
    <title>kirim produk ke cabang</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Kirim Product cabang</h1>
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
                            
                        
                            
                            <form action="{{ route('send.cabang') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                 <input type="hidden" name="id" value="{{$proses_request->id}}">
                                 
                                  
                                 
                                  
                                
                                
                                <!-- role nama -->
                              
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $proses_request->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">kategori</label>
                                    <input type="text" name="kategori" required 
                                        value="{{ $kategori->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('kategori') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kategori') }}</p>
                                </div>
                              <div class="form-group">
                                    <label for="">Barcode</label>
                                    <input type="file" name="barcode" class="form-control">
                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                </div>
                              
                            
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stock" required 
                                     
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>

                         
                                 <div class="form-group">
                                    <label for="">cabang</label>
                                    <select name="cabang" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach($cabang as $row)
                                       <option value="{{$row->id}} ">{{$row->name}}</option>
                                       @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                             
                                
                                
                                
                              
                                
                                <div class="form-group">
                                  
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($proses_request->photo))
                                        <hr>
                                        <input type="hidden" name="photo" value="{{$proses_request->photo}}">
                                        <img src="{{ asset('uploads/product/' . $proses_request->photo) }}" 
                                            alt="{{ $proses_request->name }}"
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