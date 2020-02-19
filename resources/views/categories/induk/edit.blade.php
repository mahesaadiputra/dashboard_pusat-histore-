@extends('layouts.master')

@section('title')
    <title>Edit Data induk kategori</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">kategori</a></li>
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
                            <form action="{{ route('edit.induk.post', $indukkategori->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">nama induk kategori</label>
                                    <input type="text" name="name" required 
                                        maxlength="150"
                                        
                                        value="{{ $indukkategori->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">unggulan</label>
                                    <select name="unggulan" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $indukkategori->unggulan == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $indukkategori->unggulan == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>


                           
                                
                                <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $indukkategori->tampil == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $indukkategori->tampil == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>

                                 <div class="form-group">
                                    <label for="">posisi</label>
                                    <select name="posisi" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $indukkategori->posisi == "1" ? 'selected' : '' }}>1</option>
                                            <option value="2"  {{ $indukkategori->posisi == "2" ? 'selected' : '' }}>2</option>
                                              <option value="3"  {{ $indukkategori->posisi == "3" ? 'selected' : '' }}>3</option>
                                                <option value="4"  {{ $indukkategori->posisi == "4" ? 'selected' : '' }}>4</option>
                                                <option value="5"  {{ $indukkategori->posisi == "5" ? 'selected' : '' }}>4</option>
                                      <option value="6"  {{ $indukkategori->posisi == "6" ? 'selected' : '' }}>6</option>
                                      <option value="7"  {{ $indukkategori->posisi == "7" ? 'selected' : '' }}>7</option>
                                      <option value="8"  {{ $indukkategori->posisi == "8" ? 'selected' : '' }}>8</option>
                                      <option value="9"  {{ $indukkategori->posisi == "9" ? 'selected' : '' }}>9</option>
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>
                               
                                <div class="form-group">
                                    <label for="">next</label>
                                    <select name="next" id="next" 
                                        required class="form-control {{ $errors->has('next') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $indukkategori->next == "1" ? 'selected' : '' }}>ya</option>
                                            <option value="0"  {{ $indukkategori->next == "0" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('next') }}</p>
                                </div>

                                    <div class="form-group">
                                    <label for="">next product</label>
                                    <select name="next_product" id="next_product" 
                                        required class="form-control {{ $errors->has('next_product') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $indukkategori->next_product == "1" ? 'selected' : '' }}>ya</option>
                                            <option value="0"  {{ $indukkategori->next_product == "0" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('next_product') }}</p>
                                </div>


                                    <div class="form-group">
                                    <label for="">next content</label>
                                    <select name="next_content" id="next_content" 
                                        required class="form-control {{ $errors->has('next_content') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $indukkategori->next_content == "1" ? 'selected' : '' }}>ya</option>
                                            <option value="0"  {{ $indukkategori->next_content == "0" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('next_product') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">deskripsi</label>
                                    <input type="text" name="deskripsi" required 
                                        maxlength="150"
                                        
                                        value="{{ $indukkategori->deskripsi }}"
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                              
                                
                                 <div class="form-group">
                                    <label for="">Foto</label>
                                    @role('admin')
                                    <input type="file" name="photo"  class="form-control">
                                    @endrole
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($indukkategori->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/category/' . $indukkategori->photo) }}" 
                                            alt="{{ $indukkategori->name }}"
                                            width="150px" height="150px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
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