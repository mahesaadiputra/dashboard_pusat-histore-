@extends('layouts.master')

@section('title')
    <title>Edit Batas Pembelian</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('batas_pembelian.index') }}">batas_pembelian</a></li>
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
                            <form action="{{ route('update.batas_pembelian', $batas_pembelian->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">point</label>
                                    <input type="text" name="karir" required 
                                        value="{{ $batas_pembelian->karir }}"
                                        readonly
                                        class="form-control {{ $errors->has('karir') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('karir') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">nilai tukar</label>
                                    <input type="number" name="batas" required 
                                        value="{{ $batas_pembelian->batas }}"
                                        class="form-control {{ $errors->has('batas') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('batas') }}</p>
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