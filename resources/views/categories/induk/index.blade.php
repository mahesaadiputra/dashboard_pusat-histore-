
@extends('layouts.master')

@section('title')
    <title>Manajemen induk kategori</title>
 
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen induk kategori</h1>
                    </div>
                        
                    <div class="col-sm-6">
                   
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"></li>
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
                            Filter induk kategori
                            @endslot

                            <form action="{{ route('cari.induk') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama induk kategori</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"
                                                >
                                        </div>
                                     
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
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
                            @role('admin')
                            <a href="{{ route('tambah.induk') }}" 
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
                                            <th> </th>
                                            <th>name</th>
                                            <th>unggulan</th>
                                            <th>tampil</th>
                                            <th>next</th>
                                            <th>next product</th>
                                            <th>next content</th>
                                            <th>Posisi</th>
                                            <th>deksripsi</th>
                                            
                                           @role('admin')  <th>Aksi</th> @endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @php $no = ($indukkategori->currentpage()-1)* $indukkategori->perpage() + 1; @endphp
                                        @forelse ($indukkategori as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                @if (!empty($row->photo))
                                                    <img src="{{ asset('uploads/category/' . $row->photo) }}" 
                                                        alt="{{ $row->name }}" width="50px" height="50px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $row->title }}">
                                                @endif
                                            </td>
                                            <td>
                                            {{ $row->name }}
                                            </td>
                                            <td>{{$row-> unggulan}}</td>
                                            <td>{{$row->tampil}}</td>
                                                                                       
                                                @if ($row->next == 1)
                                                    <td>Ya</td>
                                                @else
                                                    <td>Tidak</td>
                                                @endif

                                                @if ($row->next_product == 1)
                                                    <td>Ya</td>
                                                @else
                                                    <td>Tidak</td>
                                                @endif
                                                 @if ($row->next_content == 1)
                                                    <td>Ya</td>
                                                @else
                                                    <td>Tidak</td>
                                                @endif
                                                <td>{{$row->posisi}}</td>  
                                        <td>{{ $row-> deskripsi}}</td>

                                       
                                         
                                            <td>
                                                
                                                    @csrf
                                                     @role('admin')
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('edit.induk', $row->id) }}" 
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
                           {!! $indukkategori->render() !!}
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
         var url = '{{ route("hapus.induk", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
@endsection
