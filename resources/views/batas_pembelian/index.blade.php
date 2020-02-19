
@extends('layouts.master')

@section('title')
    <title>Penukaran Poin</title>
 
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Atur penukaran poin</h1>
                    </div>
                        
                    <div class="col-sm-6">
                   
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Nilai tukar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                   
                    
                    <div class="col-md-12">
                        
                         <!-- Button trigger modal -->
                  
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{route('atur_hargajual.store')}}" method="post">
                              {{csrf_field()}}
                              <div class="modal-body">
                                
                                    <div class="form-group">
                                        <label for="jenis_bintang">Jenis Bintang</label>
                                        <input type="text" name="jenis_bintang" id="jenis_bintang" class="form-control"/>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="profit">Profit</label>
                                        <input type="text" name="profit" id="profit" class="form-control"/>
                                    </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                   
                   
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
                                            <th>Poin</th>
                                            <th>nilai tukar</th>
                                         @role('admin')     <th>action</th>@endrole
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @php $no = ($batas_pembelian->currentpage()-1)* $batas_pembelian->perpage() + 1; @endphp
                                        @forelse ($batas_pembelian as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{$row->karir}}</td>
                                            <td>Rp.{{$row->batas}}</td>
                                         @role('admin')     <td>
                                               <a href="{{ route('batas_pembelian.edit', $row->id) }}" 
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
                           {!! $batas_pembelian->render() !!}
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
         var url = '{{ route("bagi_profit.hapus", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
@endsection

