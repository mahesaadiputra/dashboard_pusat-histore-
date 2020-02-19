@extends('layouts.master')

@section('title')
    <title>Manajemen anggota</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen anggota</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">anggota</li>
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
                            Filter Anggota
                            @endslot

                            <form action="{{ route('cari.anggota') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama </label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"
                                                >
                                                <label for="">email</label>
                                            <input type="email" name="email" 
                                                class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                                >
                                                
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
                                              
                                            <option value=1>aktif</option>
                                              <option value="2">non aktif</option>
                                      
                                                </option>
                                               
                                            </select>
                                            
                                            
                                            
                                          
                                        </div>
                     
                                </div>
                            </form>

                            @slot('footer')

                            @endslot
                        @endcard
            
            
            
            
            
            
            
            
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            @role('admin')   
                            <a href="{{ route('tambah.anggota') }}" class="btn btn-primary btn-sm">Tambah Baru</a>
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
                                        	<td colspan="2">Total  : {{$hitung}}</td>
                                            <td colspan="6"> <a href="{{route('anggota.exel')}}" class="btn btn-warning btn-sm"><i class="fa fa-file-excel-o"></i></a></td>

                                        </tr>

                                        <tr>
                                            <td>#</td>
                                            <td>userid</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Hp 1</td>
                                            <td>Hp 2</td>

                                            <td>karir</td>
                                            <td>Status</td>
                                               @role('admin')  <td>Aksi</td>@endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = ($users->currentpage()-1)* $users->perpage() + 1; @endphp
                                      
                                        @forelse ($users as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{$row->userid}}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{$row->hp}}</td>

                                            <td>{{$row->hp_mitra}}</td>
                                            <td>
                                                
                                             
                                                <label for="" class="badge badge-info">{{ $row->karir}}</label>
                                               
                                            </td>
                                            @if ($row->status_mitra=="1")
                                            <td>
                                                
                                                <label class="badge badge-success">Aktif</label>
                                             
                                              </td>
                                               @endif
                                               @if ($row->status_mitra=="0")
                                              <td>
                                               
                                                <label for="" class="badge badge-default">Non Aktif</label>
                                                
                                            </td>
                                            @endif
                                              @role('admin')   <td>
                                                
                                                    <input type="hidden" name="_method" value="DELETE">
                                                   
                                                    <a href="{{ route('edit.anggota', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" 
data-target="#myModal" class="btn btn-xs btn-danger"><i class="fa fa-trash">
                                            </td>@endrole
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                               {!! $users->render() !!}
                            </div>
                            @slot('footer')

                            @endslot
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
         var url = '{{ route("hapus.anggota", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
    
@endsection
