@extends('layouts.master')

@section('title')
    <title>kirim Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Proses produk cabang</h1>
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
               <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            Filter Barang
                            @endslot
@role('cabang')
                            <form action="{{ route('index_admin') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama barang</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >
                                                @role('admin')
                                                <label for="">nama cabang</label>
                                            <input type="text" name="cabang" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >@endrole
                                                
                                        </div>
                                     
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">status</label>
                                             <select name="status" class="form-control">
                                                <option value="">Pilih</option>
                                              
                                            <option value="1">Menunggu</option>
                                              <option value="2">terkirim</option>
                                      
                                                </option>
                                               
                                            </select>
                                        </div>
                     
                                </div>
                            </form>
@endrole


@role('admin')
                            <form action="{{ route('cari_proses_admin') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama barang</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >
                                                @role('admin')
                                                <label for="">nama cabang</label>
                                            <input type="text" name="cabang" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >@endrole
                                                
                                        </div>
                                     
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">status</label>
                                             <select name="status" class="form-control">
                                                <option value="">Pilih</option>
                                              
                                            <option value="1">Menunggu</option>
                                              <option value="2">terkirim</option>
                                      
                                                </option>
                                               
                                            </select>
                                        </div>
                     
                                </div>
                            </form>
@endrole
                            @slot('footer')

                            @endslot
                        @endcard
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                           
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
                                            <th></th>
                                            <th>Nama Produk</th>
                                            <th>Stok</th>
                                            <th>status</th>
                                            <th>nama cabang</th>
                                             @role('admin')
                                            <th>Aksi</th>
                                            @endrole
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                                                                   @php $no = ($proses_request->currentpage()-1)* $proses_request->perpage() + 1; @endphp
                                        @forelse ($proses_request as $row)
                                        <tr>
                                            
                                          <td>{{ $no++ }}</td>
                                          
                                            <td>
                                               
                                                    <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                                        alt="{{ $row->name }}" width="50px" height="50px">
                                          
                                            </td>
                                            <td>
                                                <strong>{{ ucfirst($row->nama_product) }}</strong>
                                            </td>
                                            
                                       
                                            <td>{{$row->jumlah_request}}</td>
                                            
                                            @if($row->status == 0)
                                            <td>menunggu</td>
                                            @endif
                                            
                                             @if($row->status == 1)
                                            <td>terkirim</td>
                                            @endif
                                            
                                            <td>{{$row->nama_cabang}}</td>
                                            <td>
                                                @role('admin')
                                                 @if($row->status == 0)
                                                <a href="{{ route('proses.review', $row->id	) }}" 
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i> proses barang
                                                </a>
                                                 @endif
                                                 @endrole
                                                 
                                                 
                                                 
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
                            
                            </div>
                            @slot('footer')

                            @endslot
                                                           <div class="float-right">
                                {{ $proses_request->render() }}
                            </div>
                        @endcard
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
@endsection