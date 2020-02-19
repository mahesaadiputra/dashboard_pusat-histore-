@extends('layouts.master')

@section('title')
    <title>Edit Data Produk</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('bank.index') }}">Bank</a></li>
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
                            <form action="{{ route('bank.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input type="text" name="nama_bank" required 
                                        value="{{ $bank->nama_bank }}"
                                        class="form-control {{ $errors->has('nama_bank') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama_bank') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pemilik</label>
                                    <input type="text" name="nama_pemilik" required 
                                        value="{{ $bank->nama_pemilik }}"
                                        class="form-control {{ $errors->has('nama_pemilik') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama_pemilik') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">No Rek</label>
                                    <input type="text" name="no_rek" required 
                                        value="{{ $bank->no_rek }}"
                                        class="form-control {{ $errors->has('no_rek') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('no_rek') }}</p>
                                </div>
                                
                                
                                  <div class="form-group">
                                    <label for="">Foto</label>
                                    @role('admin')
                                    <input type="file" name="photo"  class="form-control">
                                    @endrole
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($bank->photo))
                                        <hr>
                                        <img src="{{ asset('uploads/bank/' . $bank->photo) }}" 
                                            alt="{{ $bank->nama_bank }}"
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