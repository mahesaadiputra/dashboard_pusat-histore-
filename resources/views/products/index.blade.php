
@extends('layouts.master')

@section('title')
    <title>Manajemen Produk</title>
    
          
    
 
@endsection
@include('products.modal')


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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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

                            <form action="{{ route('cari_nama') }}" method="get">



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">nama barang</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}"
                                                >
                                                <label for="">induk kategori</label>
                                           <select name="induk" class="form-control">
                                                <option value="">Pilih</option>
                                                @foreach ($induk_id as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                        @endforeach
                                                </option>
                                               
                                            </select>
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
                                            <th> </th>
                                          
                                            <th>Nama Produk</th>
                                             <th>Histore</th> 
                                        <!--     <th>harga user</th> -->
                                            <th>level 1</th>
                                            <th>level 2</th>
                                            <th>level 3</th>
                                            <th>level 4</th>
                                           <th>induk kategori</th>
                                            
                                            <th>itki</th>
                                            <th>histore</th>

                                            <th>Kategori</th>
                                              <th>unggulan</th>
                                              <th>tampil</th>
                                            <th colspan="3">Aksi</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @php $no = ($products->currentpage()-1)* $products->perpage() + 1; @endphp
                                        @forelse ($products as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                @if (!empty($row->photo))
                                                    <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                                        alt="{{ $row->name }}" width="50px" height="50px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $row->name }}">
                                                @endif
                                            </td>
                                            
                                             
                                            <td>
                                                <sup class="label label-success">({{ $row->code }})</sup>
                                                <strong>{{ ucfirst($row->name) }}</strong>
                                            </td>
                                           
                                        
                                            <td>Rp {{ number_format($row->price) }}</td>
                                 
                                          
                                            <td> Rp {{ number_format( $row->price_level1) }}</td>
                                            
                                            <td>Rp {{ number_format($row->price_level2 )}}</td>
                                         
                                            <td>Rp {{ number_format($row->price_level3) }}</td>
                                            
                                            <td>Rp {{ number_format($row->price_level4 )}}</td>
                                          
                                           <td>{{$row->induk_kategori->name}}</td>
                                            
                                            <td>{{$row->itki}}</td>
                                            <td>{{$row->histore}}</td>

                                            <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->unggulan }}</td>
                                        <td>{{ $row->tampil }}</td>
                                                
                                                
                                                 <td>
                                                   
                                                    <a href="{{ route('view.produk', $row->id) }}" class="btn btn-info"><i class="far fa-eye"></i></a>
                                                    
                                                
                                                
                                                      
                                                 @role('admin')
                                                    <a href="{{ route('produk.edit', $row->id) }}" 
                                                        class="btn btn-warning ">
                                                        <i class="fa fa-edit"></i>
                                                    </a>


                                                       <a href="{{ route('kirimcabang', $row->id) }}" 
                                                        class="btn btn-warning ">
                                                        <i class="fa fa-send" title="kirim produk cabang"></i>

                                                    </a>
                                                    @endrole
                                                        @role('admin')

                                                    
                                                
                                                        
                     <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$row->id}})" 
data-target="#myModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
    
    
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
                           {!! $products->render() !!}
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
         var url = '{{ route("hapus.produk", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
@endsection
