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
                        <h1 class="m-0 text-dark">Tambah kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">kategori</a></li>
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
                            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                    <input type="hidden" name="jumlah"
                                        value="0">
                              
                                <div class="form-group">
                                    <label for="">nama kategori</label>
                                    <input type="text" name="name" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                               
                                <div class="form-group">
                                    <label for="">deskripsi</label>
                                    <textarea name="description" id="content" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label for="">category unggulan</label>
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
                                    <label for="">induk Kategori</label>
                                    <select name="induk_id" id="induk_id" 
                                        required class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($indukkategori as $row)
                                            <option value="{{ $row->id }}">
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
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