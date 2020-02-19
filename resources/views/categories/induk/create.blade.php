@extends('layouts.master')

@section('title')
    <title>Tambah Data category</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah induk kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('induk') }}">induk kategori</a></li>
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
                            <form action="{{ route('store.induk') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                    <input type="hidden" name="jumlah"
                                        value="0">
                              
                                <div class="form-group">
                                    <label for="">nama induk kategori</label>
                                    <input type="text" name="name" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                               
                            
                                
                                
                                 <div class="form-group">
                                    <label for="">induk kategori unggulan</label>
                                    <select name="unggulan" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="ya">Iya</option>
                                              <option value="tidak">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('unggulan') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="ya">Iya</option>
                                              <option value="tidak">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>


                                 <div class="form-group">
                                    <label for="">posisi</label>
                                    <select name="posisi" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" >1</option>
                                            <option value="2" >2</option>
                                              <option value="3" >3</option>
                                                <option value="4"  >4</option>
                                                <option value="5" >4</option>
                                      <option value="6" >6</option>
                                      <option value="7" >7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">next</label>
                                    <select name="next" id="next" 
                                        required class="form-control {{ $errors->has('next') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="1">Iya</option>
                                              <option value="0">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('next') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">next product</label>
                                    <select name="next_product" id="next_product" 
                                        required class="form-control {{ $errors->has('next_product') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="1">Iya</option>
                                              <option value="0">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('next_product') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">next content</label>
                                    <select name="next_content" id="next_content" 
                                        required class="form-control {{ $errors->has('next_content') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                      
                                            <option value="1">Iya</option>
                                              <option value="0">tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('next_product') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">deskripsi</label>
                                    <input type="text" name="deskripsi" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>

                                  
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
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
@endsection