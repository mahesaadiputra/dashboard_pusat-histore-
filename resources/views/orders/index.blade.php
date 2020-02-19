@extends('layouts.master')

@section('title')
    <title>Manajemen Order</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">List Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            Filter Transaksi
                            @endslot

                            <form action="{{ route('order.index') }}" method="get">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mulai Tanggal</label>
                                            <input type="date" name="start_date" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                id="start_date"
                                                value="{{ request()->get('start_date') }}"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sampai Tanggal</label>
                                            <input type="date" name="end_date" 
                                                class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}"
                                                id="end_date"
                                                value="{{ request()->get('end_date') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">nama</label>
                                           <input type="text" name="nama" 
                                                class="form-control">
                                            </div>
                                               <div class="form-group">
                                            <label for="">invoice</label>
                                           <input type="text" name="invoice" 
                                                class="form-control">
                                            </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                           <input type="text" name="email" 
                                                class="form-control">
                                            </div>
                                            <div class="form-group">
                                             <label for="">status</label>
                                            <select name="status" class="form-control">
                                                <option value="">pilih</option>
                                                 <option value="-1">di batalkan</option>
                                                 <option value=9>menunggu konfirmasi</optio>
                                                  <option value="1">di proses</option>
                                                    <option value="2">di kirim</option>
                                                         <option value="4">pesanan tiba</option>
                                                      <option value="3">pesanan selesai</option>
                                                      
                                               
                                             
                                            </select>
                                        </div>
                                           <div class="form-group">
                                            <label for="">no hp</label>
                                           <input type="number" name="hp" 
                                                class="form-control">
                                            </div>
                                             <div class="form-group">
                                            <label for="">alamat</label>
                                           <input type="text" name="alamat" 
                                                class="form-control">
                                            </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                            </form>

                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            Data Transaksi
                            @endslot

                            <div class="row">
                              
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Nama</th>
                                            <th>email</th>
                                            <th>No Telp</th>
                                            <th>Total Belanja</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Permintaan Kurir</th>
                                            <th>Resi</th>
                                            <th>Checkout</th>
                                            <th>Tgl Transaksi</th>
                                     <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $row)
                                        <tr>
                                            <td><strong>#{{ $row->invoice }}</strong></td>
                                            <td>{{ $row->anggota->name }}</td>
                                            <td>{{ $row->anggota->email }}</td>
                                            <td>{{ $row->customer->phone }}</td>
                                            <td>Rp {{ number_format($row->total) }}</td>
                                            <td>{{ $row->customer->address }}</td><td>
                                                
                                                
                                            
                                           @if($row->status == '-1')
                                            <strong> pesanan di batalkan</strong>
                                            @elseif ($row->status == '1')
                                             <strong>pesanan di proses</strong>
                                             @elseif ($row->status == '2')
                                             <strong>pesanan di kirim</strong>
                                             
                                              @elseif ($row->status == '0')
                                             <strong>menunggu konfirmasi</strong>
                                               @elseif ($row->status == '3')
                                             <strong>pesanan selesai</strong>
                                             
                                               @elseif ($row->status == '4')
                                             <strong>pesanan tiba</strong>
                                             @endif</td>
                                               <td>{{$row->type_ongkir}}</td>
                                             <td>{{$row->message}}</td>

                                            <td><strong>
                                            @if($row->type == '0')
                                            <strong>Kurir</strong>
                                            @elseif ($row->type == '1')
                                             <strong>Ambil Barang</strong>
                                             @elseif ($row->type == '2')
                                             <strong>Virtual Stock</strong>
                                             @endif
                                            </strong></td>

                                            <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                                      <td>
                                                <a href="{{ route('order.pdf', $row->invoice) }}" 
                                                    target="_blank"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-print" title="print invoice"></i>
                                                </a>
                                                <a href="{{ route('order.excel', $row->invoice) }}" 
                                                    target="_blank"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-file-excel-o" title="import exel"></i>
                                                </a>
                                                <a href="{{ route('order.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit" title="ubah status pengiriman"></i>
                                                    </a>
                                            </td>
                                      
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center" colspan="7">Tidak ada data transaksi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
                            <div class="float-right">
                               
                            </div>
                            @endslot
                             <div class="float-right">
                                {{ $orders->render() }}
                            </div>
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('#start_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#end_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection