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
                        <h1 class="m-0 text-dark">Manajemen pelanggan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                            Filter pelanggan
                            @endslot

                         <form action="{{ route('cari_nama_pelanggan') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" 
                                                class="form-control ">
                                        </div>
                                        <div class="form-group">
                                            <label for="">email</label>
                                            <input type="email" name="email" 
                                                class="form-control"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">alamat</label>
                                            <input type="text" name="alamat" 
                                                class="form-control ">
                                        </div>
                                        <div class="form-group">
                                              <label for="">no telepon</label>
                                            <input type="number" name="telepon" 
                                                class="form-control ">
                                              
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
                            <a href="{{ route('customer.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr><th>#</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Phone</th>
                                            <th>Last Update</th>
                                          @role('admin')   <th>Aksi</th>@endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @php $no = ($customer->currentpage()-1)* $customer->perpage() + 1; @endphp
                                        @forelse ($customer as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->address }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{{ $row->updated_at }}</td>
                                            <td>
                                                
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @role('admin')
                                                    <a href="{{ route('customer.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endrole
                                                    @role('admin')
                                                      <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" 
data-target="#myModal" class="btn btn-xs btn-danger"><i class="fa fa-trash">
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
                                {{ $customer->render() }}
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
         var url = '{{ route("hapus.pelanggan", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endsection