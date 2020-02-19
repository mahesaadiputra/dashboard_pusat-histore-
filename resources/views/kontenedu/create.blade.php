@extends('layouts.master')

@section('title')
    <title>Tambah Data edu</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('konten.edu') }}">Konten edu</a></li>
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
                            <form action="{{ route('tambah.konten.edu') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                    <input type="hidden" name="jumlah"
                                        value="0">
                              
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                               
                               

                                <div class="form-group">
                                    <label for="">Content</label>
                                   <textarea id="konten" class="form-control" name="content" rows="10" cols="50" required></textarea>
                                    <p class="text-danger">{{ $errors->first('content') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="type" id="type" 
                                        required class="form-control {{ $errors->has('type') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="0" >HiStore</option>
                                            <option value="1" >Mitra</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="tampil" 
                                        required class="form-control {{ $errors->has('tampil') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" >ya</option>
                                            <option value="tidak" >tidak</option>
                                      
                                    </select>
                                    
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control">
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">document</label>
                                    <input type="file" name="file_document" class="form-control">
                                    <p class="text-danger">{{ $errors->first('file_document') }}</p>
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
      <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script>
  var konten = document.getElementById("konten");
    CKEDITOR.replace(konten,{
    language:'en-gb'
  });
  CKEDITOR.config.allowedContent = true;
</script>
@endsection