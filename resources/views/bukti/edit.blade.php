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
                            <li class="breadcrumb-item"><a href="{{ route('bukti.index') }}">Topup</a></li>
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
                            <form action="{{ route('bukti.update', $bukti->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                   
                                <div class="form-group">
                                    <label for="">Invoice</label>
                                    <input type="text" name="invoice" required 
                                        readonly
                                        value="{{ $bukti->invoice }}"
                                        class="form-control {{ $errors->has('invoice') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('invoice') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="user_id" required 
                                        readonly
                                        value="{{ $bukti->anggota->name }}"
                                        class="form-control {{ $errors->has('user_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('user_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Bank</label>
                                    <input type="text" name="bank_id" required 
                                        readonly 
                                        value="{{ $bukti->bank->nama_bank }}"
                                        class="form-control {{ $errors->has('bank_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('bank_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input type="text" name="jumlah" required 
                                        readonly
                                        value="{{ $bukti->jumlah }}"
                                        class="form-control {{ $errors->has('jumlah') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('jumlah') }}</p>
                                </div>


                                <div class="form-group">
                                    <label for="">Status</label>
                                    <frame id="frame_select">
                                        <select name="status" id="status" 
                                            required class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                            <option value="">Pilih</option>
                                            @if($bukti->status == 1)
                                            <option value="2">Terbayar</option>
                                            @endif

                                        </select>
                                    </frame>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                    <input type="text" name="type" value="{{$bukti->status}}" style="display:none"/>
                                </div>

                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                    @if (!empty($bukti->photo))
                                        <hr>
                                        <img src="{{ asset('../historeadm/uploads/bukti/' . $bukti->photo) }}" 
                                            alt="{{ $bukti->name }}"
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