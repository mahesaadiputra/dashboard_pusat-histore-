@extends('layouts.master')

@section('title')
    <title>Manajemen Kategori</title>
@endsection
@include('products.modal')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen sub Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">sub Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-md-4">
                        @card
                            @slot('title')
                            Tambah
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif

                            <form role="form" action="{{ route('sub.store') }}" method="POST">
                                @csrf
                                @role('admin')
                                <div class="form-group">   
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="category_id" 
                                        required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}">
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                @endrole
                                <div class="form-group">
                                    <label for="sub_nama">Sub Kategori</label>
                                    <input type="text" 
                                    name="sub_nama"
                                    class="form-control {{ $errors->has('sub_nama') ? 'is-invalid':'' }}" id="sub_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="5" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                </div>
                            @slot('footer')   @role('admin')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                                @endrole
                            </form>
                            @endslot
                            
                            
                        @endcard
                    </div>
                    <div class="col-md-8">
                        @card
                            @slot('title')
                            List sub Kategori
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <form action="{{ route('cari.sub') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama sub kategori</label>
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
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Kategori</td>
                                            <td>Sub Kategori</td>
                                            <td>Deskripsi</td>
                                         @role('admin')    <td>Aksi</td>@endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @php $no = ($sub_categories->currentpage()-1)* $sub_categories->perpage() + 1; @endphp
                                        @forelse ($sub_categories as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->category->name }}</td>
                                            <td>{{ $row->sub_nama }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>
                                             
                                                   
                                                    <input type="hidden" name="_method" value="DELETE">
                                                     @role('admin')
                                                    <a href="{{ route('sub.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                   <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" 
                                                        data-target="#myModal" class="btn btn-xs btn-danger"><i class="fa fa-trash">
                                             
                                            </td> @endrole
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
                            
                            @endslot
                            <div class="float-right">
                                {{ $sub_categories->render() }}
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
         var url = '{{ route("hapus.subprod", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>>
@endsection