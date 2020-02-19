
@extends('layouts.master')

@section('title')
    <title>Atur Profit</title>
 
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">atur profit</h1>
                    </div>
                        
                    <div class="col-sm-6">
                   
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">atur profit</li>
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
                                            <th>nama karir</th>
                                            <th>profit</th>
                                        @role('admin')      <th>Action</th>@endrole
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @php $no = ($atur_profit->currentpage()-1)* $atur_profit->perpage() + 1; @endphp
                                        @forelse ($atur_profit as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{$row->nama_karir}}</td>
                                            <td>{{$row->profit}}%</td>
                                          @role('admin')     <td>
                                               <a href="{{ route('atur_profit.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                            </td>
                                            @endrole
                                            
                                         
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
                           {!! $atur_profit->render() !!}
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

