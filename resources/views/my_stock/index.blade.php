@extends('layouts.master')

@section('title')
    <title>Stock saya</title>
    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    </head>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Stock Saya</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Stock Saya</li>
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

                            <form role="form" action="{{ route('preorder.store') }}" method="POST">
                                @csrf
                                @role('admin')
                                <!-- <div class="form-group">   
                                    <label for="">vendor</label>
                                    <select name="category_id" id="category_id" 
                                        required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                       
                                            <option value="">
                                              
                                            </option>

                                    </select>
                                    <p class="text-danger">{{ $errors->first('') }}</p>
                                </div> -->
                                @endrole

                                <div class="form-group">
                                    <label for="nama">vendor</label>
                                   <select name="vendor"  class="form-control {{ $errors->has('vendor') ? 'is-invalid':'' }}" id="vendor" required>
                                     <option value="">pilih</option>
                                     @foreach($vendor as $row)
                                     <option value="{{$row->nama}}">{{$row->nama}}</option>
                                    @endforeach
                                   </select>
                                </div>
                                  <div class="form-group">
                                    <label for="description">product</label>
                                  <select class="form-control" name="product" required>
                                    <option value="">Pilih</option>
                                    
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">qty</label>
                                  <input type="number" 
                                    name="qty"
                                    class="form-control {{ $errors->has('qty') ? 'is-invalid':'' }}" id="qty" required>
                                </div>
                                  <div class="form-group">
                                    <label for="description">harga</label>
                                  <input type="number" 
                                    name="harga"
                                    class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="qty" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">resi</label>
                                  <input type="text" 
                                    name="resi"
                                    class="form-control {{ $errors->has('resi') ? 'is-invalid':'' }}" id="resi" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">alamat tujuan kirim</label>
                                <select class="form-control"  name="alamat">
                                  <option value="">pilih</option>
                                 
                                </select> 
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
                            list pre order
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <form action="{{ route('pre_order.index') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">vendor</label>
                                            <input type="text" name="nama" 
                                                class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"
                                                >
                                                  <label for="">nama product</label>
                                            <input type="text" name="product" 
                                                class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}"
                                                >
                                        </div>
                                     
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>



                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">resi</label>
                                            <input type="text" name="resi" 
                                                class="form-control {{ $errors->has('resi') ? 'is-invalid':'' }}"
                                                >
                                                  <label for="">status</label>
                                        <select name="status" class="form-control">
                                          <option value="" >pilih</option>
                                          <option value="1">open</option>
                                          <option value="2">close</option>
                                          <option value="3">cancel</option>



                                        </select>
                                        </div>
                                     
                                      
                                        


                                    </div>
                               
                     
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>vendor</td>
                                            <td>nama product</td>
                                            <td>qty</td>
                                            <td>harga</td>
                                            <td>status</td>
                                            <td>resi</td>
                                            <td>alamat kirim</td>
                                            <td>tanggal kirim</td>
                                            <td>tanggal terima</td>
                                         @role('admin')    <td>Aksi</td>@endrole
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @php $no = ($stock->currentpage()-1)* $stock->perpage() + 1; @endphp
                                        @forelse ($stock as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->vendor }}</td>
                                            <td>{{ $row->nama_product }}</td>
                                            <td>{{ $row->qty }}</td> 
                                            <td>{{ $row->harga }}</td>
                                            @if($row->status == 1 )           
                                            <td>open</td>
                                            @elseif($row->status == 2 )
                                            <td>close</td>   
                                            @elseif($row->status == 3 )
                                            <td>cancel</td>
                                            @endif 
                                            <td>{{ $row->resi }}</td> 
                                            <td>{{ $row->alamat_kirim }}</td>
                                            <td>{{$row->tgl_kirim}}</td>
                                            <td>{{$row->tgl_terima}}</td>                          
                                                      
                                            <td>
                                             
                                                   
                                                    <input type="hidden" name="_method" value="DELETE">
                                                     @role('admin')
                                                     @if($row->status == 1)
                                                 <button class="btn btn-info" 
                                                 data-mytitle="{{$row->vendor}}"
                                                  data-harga="{{$row->harga}}"
                                                  data-status="{{$row->status}}"
                                                  data-resi="{{$row->resi}}"
                                                  data-alamat="{{$row->alamat_kirim}}"


                                                 data-qty={{$row->qty}} data-nama="{{$row->nama_product}}" data-catid={{$row->id}} data-toggle="modal" data-target="#edit">
                <i class="fa fa-edit"></i></button>
              </button>
              @endif
              <button class="btn btn-danger" data-catid={{$row->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
                                             
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
                                {{ $stock->render() }}
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
    
  






<!-- Attachment Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"></button>
        <h4 class="modal-title" id="myModalLabel">proses pre order</h4>
      </div>
      <form action="{{route('proses.po')}}" method="POST">
            {{csrf_field()}}
          <div class="modal-body">
                <input type="hidden" name="id" id="cat_id" value="">
                @include('pre_order.form')
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">proses</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- /Attachment Modal -->



<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('destroy.po')}}" method="post">
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
            <input type="hidden" name="id" id="cat_id" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-warning">Yes, Delete</button>
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


  
  $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var title = button.data('mytitle')
      var nama = button.data('nama')      
      var qty = button.data('qty')
      var harga = button.data('harga')
      var status = button.data('status')
      var alamat = button.data('alamat') 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #nama').val(nama); 
      modal.find('.modal-body #vendor').val(title);
      modal.find('.modal-body #cat_id').val(cat_id);
       modal.find('.modal-body #qty').val(qty);
       modal.find('.modal-body #harga').val(harga);
       modal.find('.modal-body #alamat').val(alamat); 
       modal.find(".modal-body #status").val(this.status);


})

 $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #cat_id').val(cat_id);
})

</script>

<!-- <script type="text/javascript">
 $(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
    var name = row.children(".name").text();
    var description = row.children(".description").text();

    // fill the data in the input fields
    $("#modal-input-id").val(id);
    $("#modal-input-name").val(name);
    $("#modal-input-description").val(description);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})   



</script> -->




@endsection