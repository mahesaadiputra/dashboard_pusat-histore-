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
                            <li class="breadcrumb-item"><a href="{{ route('komisi') }}">profit</a></li>
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
                            <form action="{{route('update.profit',$komisi->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">id_akun</label>
                                    <input type="text" name="idakun" required 
                                        maxlength="15"
                                        readonly
                                        value="{{ $komisi->id_akun }}"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                
                                <!-- role nama -->
                               
                              <div class="form-group">
                                    <label for="">id_nama</label>
                                    <input type="text" name="id_nama" required 
                                        maxlength="15"
                                        readonly
                                        value="{{ $komisi->id_nama }}"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" name="id_jumlah" required 
                                        maxlength="15"
                                        readonly
                                        value="{{ $komisi->jumlah }}"
                                        class="form-control {{ $errors->has('title') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                </div>
                                
                                
                                <div>
                                     <label for="status">status</label>
                                    <select name="status" id="status" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                           @if($komisi->status == "pending")
                                        <option value="pending" {{ $komisi->status == "pending" ? 'selected' : '' }}>pending</option>
                                     
                                            <option value="terkirim"  {{ $komisi->status == "terkirim" ? 'selected' : '' }}>terkirim</option>
                                      @endif
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                               
                                <!-- end role desc-->
                                
                                <!-- role stok -->
                              
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