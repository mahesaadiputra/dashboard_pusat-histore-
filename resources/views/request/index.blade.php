@extends('layouts.master')

@section('title')
    <title>Manajemen Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
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
                            Filter Barang
                            @endslot

                            <form action="{{ route('cari_nama_order') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama barang</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >
                                        </div>
                                     
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">category</label>
                                             <select name="categories" class="form-control">
                                                <option value="">Pilih</option>
                                                @foreach ($categories as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                        @endforeach
                                                </option>
                                               
                                            </select>
                                        </div>
                     
                                </div>
                            </form>
                            

                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                    
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            @role('admin')
                            <a href="{{ route('produk.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endrole
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th></th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Harga level 1</th>
                                            <th>Harga level 2</th>
                                            <th>Harga level 3</th>
                                            <th>Harga level 4</th>
                                            <th>Kategori</th>
                                            <th>Last Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody> @php
                                            $nama = Auth::user()->name;
                                          @endphp
                                          
                                @php $no = ($products->currentpage()-1)* $products->perpage() + 1; @endphp
                                        @forelse ($products as $row)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            
                                            <td>
                                               
                                                    <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                                        alt="{{ $row->name }}" width="50px" height="50px">
                                          
                                            </td>
                                            <td>
                                                <sup class="label label-success">({{ $row->code }})</sup>
                                                <strong>{{ ucfirst($row->name) }}</strong>
                                            </td>
                                         
                                       
                                            <td>{{$row->stock_kasir->$nama}}</td>
                                            <td>Rp {{ number_format($row->price) }}</td>
                                          
                                            <td>Rp {{ number_format(floatval($row->price_level1)) }}</td>
                                            
                                            <td>Rp {{ number_format(floatval($row->price_level2)) }}</td>
                                         
                                            <td>Rp {{ number_format(floatval($row->price_level3)) }}</td>
                                            
                                            <td>Rp {{ number_format(floatval($row->price_level4)) }}</td>
                                            <td>{{ $row->category->name }}</td>
                                            <td>{{ $row->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('produk.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    @role('admin')
                                                    <a href="{{ route('produk.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endrole
                                                    
                                                  
                                               
                                                </form>
                                                
                                                <a href="{{ route('proses.stock', $row->id) }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> add Stock
                            </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                               {{ $products->links() }}
                            </div>
                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection