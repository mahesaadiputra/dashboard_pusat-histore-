@extends('layouts.master')

@section('title')
    <title>Edit Atur Subisdi</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('subsidi.index') }}">subsidi</a></li>
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
                            <form action="{{ route('update.subsidi', $subsidi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">Nama Karir</label>
                                    <input type="text" name="nama_karir" required 
                                        value="{{ $subsidi->level_bintang }}"
                                        readonly
                                        class="form-control {{ $errors->has('nama_karir') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama_karir') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">subsidi</label>
                                    <input type="number" name="subsidi" required 
                                        value="{{ $subsidi->potongan }}"
                                        class="form-control {{ $errors->has('subisidi') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('subisidi') }}</p>
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