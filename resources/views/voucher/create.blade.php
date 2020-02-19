@extends('layouts.master')

@section('title')
    <title>Tambah voucher</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah voucher</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('voucher.index') }}">Voucher</a></li>
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
                            <form action="{{ route('voucher.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                               
                              
                                <div class="form-group">
                                    <label for="">kode voucher</label>
                                    <input type="text" name="kode" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">judul voucher</label>
                                    <input type="text" name="nama" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">potongan</label>
                                    <input type="text" name="potongan" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('potongan') }}</p>
                                </div>
                                   <div class="form-group">
                                    <label for="">potongan tampil</label>
                                    <input type="text" name="tampil" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('tampil') }}</p>
                                </div>
                                </div>
                                   <div class="form-group">
                                    <label for="">pemakaian</label>
                                    <input type="text" name="pemakaian" required 
                                        maxlength="100"
                                        class="form-control">
                                    <p class="text-danger">{{ $errors->first('pemakaian') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                             <label for="">Maks Diskon</label>
                             <input type="text" name="maks" required 
                                 maxlength="100"
                                 class="form-control">
                             <p class="text-danger">{{ $errors->first('maks') }}</p>
                         </div>
                                
                                
                                
                                     <div class="form-group">
                                    <label for="">status</label>
                                    <select  name="status"  class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                        <option value="">pilih</option>
                                          <option value="r" >Ready</option>
                                          <option value="d">Done</option>
                                        </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
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