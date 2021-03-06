@extends('layouts.master')

@section('title')
    <title>Edit Data berita</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
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
                            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" required 
                                        
                                        value="{{ $berita->title }}"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                
                                <!-- role nama -->
                               
                                @role('admin')
                                <div class="form-group">
                                   
                                     <div class="form-group">
                                    <label for="">Content</label>
                                   <textarea id="konten" class="form-control" name="content" rows="10" cols="50">{{ $berita->content }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                  
                                @endrole
                                
                               
                                <!-- end role desc-->
                                
                                <!-- role stok -->
                              
                                 <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $berita->tampil == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $berita->tampil == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>

                                 <div class="form-group">
                                    <label for="">posisi</label>
                                    <select name="posisi" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="1" {{ $berita->posisi == "1" ? 'selected' : '' }}>1</option>
                                            <option value="2"  {{ $berita->posisi == "2" ? 'selected' : '' }}>2</option>
                                              <option value="3"  {{ $berita->posisi == "3" ? 'selected' : '' }}>3</option>
                                                <option value="4"  {{ $berita->posisi == "4" ? 'selected' : '' }}>4</option>
                    
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">Foto</label>
                                    @role('admin')
                                    <input type="file" name="photo"  class="form-control">
                                    @endrole
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($berita->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/berita/' . $berita->photo) }}" 
                                            alt="{{ $berita->title }}"
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
      <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>
@endsection