@extends('layouts.master')

@section('title')
    <title>Edit Data banner</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Berita</a></li>
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
                            <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" required 
                                       
                                        
                                        value="{{ $banner->title }}"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                
                                <!-- role nama -->
                               
                                @role('admin')
                                <div class="form-group">
                                    <label for="">conten</label>
                                    <textarea name="content" id="content" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('content') ? 'is-invalid':'' }}">{{ $banner->content }}</textarea>
                                    <p class="text-danger">{{ $errors->first('content') }}</p>
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
                                    @if (!empty($banner->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/banner/' . $banner->photo) }}" 
                                            alt="{{ $banner->title }}"
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