@extends('layouts.master')

@section('title')
    <title>Edit anggota</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit anggota</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.cabang') }}">anggota</a></li>
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
                            
                            <form action="{{ route('update.cabang', $user->id) }}" method="post">
                                @csrf
                             
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" 
                                        value="{{ $user->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" 
                                        value="{{ $user->email }}"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" 
                                        required>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">alamat</label>
                                    <input type="alamat" name="alamat" 
                                        value="{{ $user->alamat }}"
                                        class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}" 
                                        required>
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">role</label>
                                    <select name="role" 
                                        required class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="pusat" {{ $user->role == "pusat" ? 'selected' : '' }}>pusat</option>
                                         <option value="cabang" {{ $user->role == "cabang" ? 'selected' : '' }}>cabang</option>
                                        
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">status</label>
                                    <select name="status" 
                                        required class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value=1 {{ $user->status == 1 ? 'selected' : '' }}>aktif</option>
                                         <option value=0 {{ $user->status == 0 ? 'selected' : '' }}>suspend</option>
                                        
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" 
                                        class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Update
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