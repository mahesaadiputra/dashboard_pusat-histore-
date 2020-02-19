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
                            <li class="breadcrumb-item"><a href="{{ route('voucher.index') }}">voucher</a></li>
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
                            <form action="{{route('update.voucher',$voucher->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">Kode Voucher</label>
                                    <input type="text" name="kode" 
                                    
                                        value="{{ $voucher->kode_voucher }}"
                                        class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode') }}</p>
                                </div>
                                
                                <!-- role nama -->
                               
                                @role('admin')
                                  <div class="form-group">
                                    <label for="">Judul Voucher</label>
                                    <input type="text" name="judul" required 
                                     
                                   
                                        value="{{ $voucher->nama }}"
                                        class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode') }}</p>
                                </div>
                                @endrole
                                <div class="form-group">
                                    <label for="">potongan</label>
                                    <input type="text"  name="potongan" required 
                                     
                                        value="{{ $voucher->potongan }}"
                                        class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">potongan tampil</label>
                                    <input  type="text" name="potongan_tampil"  
                                  
                                        value="{{ $voucher->potongan_tampil }}"
                                        class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">pemakaian</label>
                                    <input  type="text" name="pemakaian"  
                                  
                                        value="{{ $voucher->pemakaian }}"
                                        class="form-control {{ $errors->has('pemakaian') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('pemakaian') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Maks Diskon</label>
                                    <input  type="text" name="maks"  
                                  
                                        value="{{ $voucher->maks }}"
                                        class="form-control {{ $errors->has('maks') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('maks') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">status</label>
                                    <select  name="status"  class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                        <option value="">pilih</option>
                                          <option value="r" {{ $voucher->status == "r" ? 'selected':'' }}>Ready</option>
                                          <option value="d" {{ $voucher->status == "d" ? 'selected':'' }}>Done</option>
                                        </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
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