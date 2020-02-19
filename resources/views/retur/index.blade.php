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
                        <h1 class="m-0 text-dark">Manajemen Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Topup</li>
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
                            Filter customer
                            @endslot

                         <form action="{{ route('cari_nama_bukti') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">invoice</label>
                                            <input type="text" name="invoice" 
                                                class="form-control ">
                                        </div>
                                       
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama</label>
                                            <input type="text" name="nama" 
                                                class="form-control ">
                                        </div>
                                       
                                              
                                            </select>
                                        </div>
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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nama Mitra</th>
                                            <th>Kode Invoice</th>
                                            <th>Tanggal Order</th>
                                            <th>Alasan Retur</th>
                                            <th>Alamat Retur</th>
                                            <th>Bukti</th>
                                            <th>status</th>
                                           @role('admin')   <th>Aksi</th>@endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($retur as $row)
                                        <tr>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->email }}</td>
         
                                            <td>Rp {{ $row->nama_mitra }}</td>
                                            <td>{{ $row->kode_invoice }}</td>
                                            <td>{{ $row->tanggal_order }}</td> 
                                            <td>{{ $row->alasan_retur }}</td>
                                            <td>{{ $row->alamat_retur }}</td> 
                                            <td>
                                                @if (!empty($row->bukti))
                                                    <img src="{{ asset('../historeadm/uploads/retur/' . $row->bukti) }}" 
                                                        alt="{{ $row->bukti }}" width="50px" height="50px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $row->bukti }}">
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->status == '0')
                                                <strong> Belum Diterima</strong>
                                                @elseif ($row->status == '1')
                                                <strong> Diterima</strong>
                                                @endif
                                            </td>
                                         @role('admin')     <td>
                                                <a href="{{ route('retur.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                               
                                                    <input type="hidden" name="_method" value="DELETE">
                                                   
                                                    @role('admin')
                                               <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" 
data-target="#myModal" class="btn btn-xs btn-danger"><i class="fa fa-trash">
                                                    @endrole
                                               
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
                           
                            </div>
                            @slot('footer')

                            @endslot
                             <div class="float-right">
                                {{ $retur->render() }}
                            </div>
                            
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    
      <div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
		     <form action="" id="deleteForm" method="get">
		            {{ csrf_field() }}
                 
			<div class="modal-header">			
				<h4 class="modal-title">konfirmasi</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Yakin hapus?</p>
			</div>
			<div class="modal-footer">
                <button type="button"  class="btn btn-info" data-dismiss="modal">jangan :(</button>
			 <button type="button"  class="btn btn-danger" onclick="formSubmit()">Iya Hapussss !!!!</button>
			</div>
			</form>
		</div>
	</div>
</div>
   <script type="text/javascript">
 function deleteData(id)
     {
         var id = id;
         var url = '{{ route("hapus.retur", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
    
    
    
    
    
@endsection