@extends('layouts.master')

@section('title')
    <title>Edit Data category</title>
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
                            <form action="{{ route('update.category', $categories->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">nama category</label>
                                    <input type="text" name="name" required 
                                        maxlength="150"
                                        
                                        value="{{ $categories->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">unggulan</label>
                                    <select name="unggulan" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $categories->unggulan == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $categories->unggulan == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>


                                <div class="form-group">
                                    <label for="">induk Kategori</label>
                                    <select name="induk_id" id="induk_id" 
                                        required class="form-control {{ $errors->has('category_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($indukkategori as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $categories->induk_id ? 'selected':'' }}>
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $categories->tampil == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $categories->tampil == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                                
                                
                                
                                <!-- role nama -->
                               
                                @role('admin')
                                <div class="form-group">
                                    <label for="">deskripsi</label>
                                    <textarea name="deskripsi" id="content" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">{{ $categories->uggulan }}</textarea>
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                </div>
                                @endrole
                                
                               
                                <!-- end role desc-->
                                
                                <!-- role stok -->
                              
                                
                                 <div class="form-group">
                                    <label for="">Foto</label>
                                    @role('admin')
                                    <input type="file" name="photo"  class="form-control">
                                    @endrole
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($categories->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/category/' . $categories->photo) }}" 
                                            alt="{{ $categories->name }}"
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