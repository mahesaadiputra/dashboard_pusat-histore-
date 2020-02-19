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
                            <li class="breadcrumb-item"><a href="{{ route('retur.index') }}">Retur</a></li>
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
                            <form action="{{ route('retur.update', $retur->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                   
                                <div class="form-group">
                                    <label for="">Invoice</label>
                                    <input type="text" name="kode_invoice" required 
                                        readonly
                                        value="{{ $retur->kode_invoice }}"
                                        class="form-control {{ $errors->has('kode_invoice') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kode_invoice') }}</p>
                                </div>


                                <div class="form-group">
                                    <label for="">Status</label>
                                    <frame id="frame_select">
                                        <select name="status" id="status" 
                                            required class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                            <option value="">Pilih</option>
                                            @if($retur->status == 0)
                                            <option value="1">Terbayar</option>
                                            @endif

                                        </select>
                                    </frame>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                    <input type="text" name="type" value="{{$retur->status}}" style="display:none"/>
                                </div>

                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <p class="text-danger">{{ $errors->first('bukti') }}</p>
                                    @if (!empty($retur->bukti))
                                        <hr>
                                        <img src="{{ asset('../historeadm/uploads/retur/' . $retur->bukti) }}" 
                                            alt="{{ $retur->bukti }}"
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