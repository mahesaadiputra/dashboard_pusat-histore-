
@extends('layouts.master')

@section('title')
    <title>kirim profit</title>
 
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">kirim profit</h1>
                    </div>
                        
                    <div class="col-sm-6">
                   
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">kirim profit</li>
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
                            Filter kirim profit
                            @endslot

                           <form action="{{ route('komisi') }}" method="get">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Id-Akun</label>
                                            <input type="text" name="id_akun" 
                                                class="form-control {{ $errors->has('id_akun') ? 'is-invalid':'' }}"
                                                id="id_akun"
                                                value="{{ request()->get('id_akun') }}"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label for="">Id-Nama</label>
                                            <input type="nama" name="nama" 
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"
                                                id="end_date"
                                                value="{{ request()->get('nama') }}">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    
                                            
                                        
                                        
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
                                            <th>id-akun</th>
                                            <th>id-nama</th>
                                            <th>jumlah</th>
                                           <th>status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @php $no = ($komisi->currentpage()-1)* $komisi->perpage() + 1; @endphp
                                        @forelse ($komisi as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{$row->id_akun}}</td>
                                            <td>{{$row->id_nama}}</td>
                                            <td>{{$row->jumlah}}</td>
                                            <td>{{$row->status}}</td>
                                            
                                            
                                         @role('admin')      <td>
                                                   
                                                 
                                                    
                                                
                                                
                                                      
                                                 
                                                    <a href="{{ route('komisi.edit', $row->id) }}" 
                                                        class="btn btn-warning ">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                       
    
                                            
                           
                        </td>@endrole
                        
                                         
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
                           {!! $komisi->render() !!}
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
         var url = '{{ route("hapus.berita", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
@endsection
