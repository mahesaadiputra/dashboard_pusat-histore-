@extends('layouts.master')

@section('title')
    <title>Tambah Data Produk</title>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
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
                            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                    <input type="hidden" name="jumlah"
                                        value="0">
                              
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="kode" required 
                                        maxlength="10"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                        <label for="">Nama Toko</label>
                                        <input type="text" name="nama_umkm" required 
                                            class="form-control {{ $errors->has('nama_umkm') ? 'is-invalid':'' }}">
                                        <p class="text-danger">{{ $errors->first('nama_umkm') }}</p>
                                    </div>
                                    <div class="form-group">
                                            <label for="">Alamat UMKM</label>
                                            <input type="text" name="alamat_umkm" required 
                                                class="form-control {{ $errors->has('alamat_umkm') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('alamat_umkm') }}</p>
                                        </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga HPP</label>
                                    <input type="number" name="price" required 
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="">Harga level 1</label>
                                    <input type="number" name="price_level1" required 
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">Harga level 2</label>
                                    <input type="number" name="price_level2" required 
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                      <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">Harga level 3</label>
                                    <input type="number" name="price_level3" required 
                                        class="form-control {{ $errors->has('price_level3') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price_level3') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">Harga level 4</label>
                                    <input type="number" name="price_level4" required 
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div> -->
                                <div class="form-group">
                                    <label for="">Harga HET</label>
                                    <input type="number" name="harga_user" required 
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>

                                
                                
                                <div class="form-group">
                                    <label for="">minimum pembelian level 1</label>
                                    <input type="number" name="minimum1" required 
                                        class="form-control {{ $errors->has('minimum1') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum1') }}</p>
                                </div>
                                
                                   
                                <div class="form-group">
                                    <label for="">minimum pembelian level 2</label>
                                    <input type="number" name="minimum2" required 
                                        class="form-control {{ $errors->has('minimum2') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum2') }}</p>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label for="">minimum pembelian level 3</label>
                                    <input type="number" name="minimum3" required 
                                        class="form-control {{ $errors->has('minimum2') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum2') }}</p>
                                </div>
                                
                                
                                    <div class="form-group">
                                    <label for="">minimum pembelian level 4</label>
                                    <input type="number" name="minimum4" required 
                                        class="form-control {{ $errors->has('minimum2') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum2') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Weight ( Gram )</label>
                                    <input type="number" name="weight" required 
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">Lebar ( cm )</label>
                                    <input type="number" name="lebar" required 
                                        class="form-control {{ $errors->has('lebar') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('lebar') }}</p>
                                </div>
                                    <div class="form-group">
                                    <label for="">Tinggi ( cm )</label>
                                    <input type="number" name="tinggi" required 
                                        class="form-control {{ $errors->has('tinggi') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('tinggi') }}</p>
                                 </div>
                                  <div class="form-group">
                                    <label for="">volume ( cm )</label>
                                    <input type="number" name="volume" required 
                                        class="form-control {{ $errors->has('volume') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('volume') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">produk unggulan</label>
                                    <select name="unggulan" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="ya">Iya</option>
                                              <option value="tidak">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="ya">Iya</option>
                                              <option value="tidak">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>



                                <div class="form-group">
                                    <label for="">itki</label>
                                    <select name="itki" id="unggulan" 
                                        required class="form-control {{ $errors->has('itki') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya">ya</option>
                                            <option value="tidak" >tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">histore</label>
                                    <select name="histore" id="unggulan" 
                                        required class="form-control {{ $errors->has('histore') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya">ya</option>
                                            <option value="tidak" >tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Induk Category</label>
                                    <select name="induk_id" id="induk_id" 
                                        required class="form-control {{ $errors->has('induk_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        
                                        @foreach ($induk_id as $row)
                                            <option value="{{ $row->id }}">{{ $row->name  }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('induk_id') }}</p>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category" id="category" 
                                        required class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                        <option value="0">Pilih</option>
                                        
                                        @foreach ($categories['data'] as $row)
                                            <option value="{{ $row->id }}">{{ $row->name  }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Kategori</label>
                                    <select name="sub_cat" id="sub_cat" 
                                        required class="form-control {{ $errors->has('sub_cat_id') ? 'is-invalid':'' }}">
                                        <option value='0'>Pilih</option>
                                       
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">Foto 2</label>
                                    <input type="file" name="photo2" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo2') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">Foto 3</label>
                                    <input type="file" name="photo3" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo3') }}</p>
                                </div>
                                
                                </div>
                                   
                                
                                
                                
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
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
    
    <script type='text/javascript'>

    $(document).ready(function(){

      // Department Change
      $('#category').change(function(){

         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#sub_cat').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url: '/dashboard/ajax-subcat/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var id = response['data'][i].id;
                 var sub_nama = response['data'][i].sub_nama;

                 var option = "<option value='"+id+"'>"+sub_nama+"</option>"; 

                 $("#sub_cat").append(option); 
               }
             }

           }
        });
      });

    });

    </script>
    
    
    
@endsection