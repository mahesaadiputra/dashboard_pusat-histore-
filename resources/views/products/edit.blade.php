@extends('layouts.master')

@section('title')
    <title>Edit Data Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kode Produk</label>
                                    <input type="text" name="code" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $product->code }}"
                                        class="form-control {{ $errors->has('code') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                                
                                <!-- role nama -->
                                @role('admin')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                
                                @endrole
                                @role('level1')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                @role('level2')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                @role('level3')
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="name" required 
                                        value="{{ $product->name }}"
                                        readonly
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                @endrole
                                
                                <!-- end role nama-->
                                
                                <!-- role desc -->
                                @role('admin')
                                <div class="form-group">
                                        <label for="">Nama Toko</label>
                                        <input type="text" name="nama_umkm"  
                                            value="{{ $product->nama_umkm }}"
                                            class="form-control {{ $errors->has('nama_umkm') ? 'is-invalid':'' }}">
                                        <p class="text-danger">{{ $errors->first('nama_umkm') }}</p>
                                    </div>
                                    <div class="form-group">
                                            <label for="">Alamat UMKM</label>
                                            <input type="text" name="alamat_umkm"  
                                                value="{{ $product->alamat_umkm }}"
                                                class="form-control {{ $errors->has('alamat_umkm') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('alamat_umkm') }}</p>
                                        </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="description" 
                                        cols="5" rows="5" 
                                        class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $product->description }}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                @endrole
                              
                             
                                
                                @role('admin')
                                <div class="form-group">
                                    <label for="">harga HPP</label>
                                    <input type="number" name="price"  required 
                                        value="{{ $product->price }}"
                                        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="">Harga level 4</label>
                                    <input type="number" name="price_level4"  required 
                                        value="{{ $product->price_level4 }}"
                                        class="form-control {{ $errors->has('price_level4') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price_level4') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">Harga level 3</label>
                                    <input type="number" name="price_level3"  required 
                                        value="{{ $product->price_level3 }}"
                                        class="form-control {{ $errors->has('price_level3') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price_level3') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">Harga level 2</label>
                                    <input type="number" name="price_level2"  required 
                                        value="{{ $product->price_level2 }}"
                                        class="form-control {{ $errors->has('price_level2') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price_level2') }}</p>
                                </div>
                                 <div class="form-group"> -->
                                    <label for="">harga HET</label>
                                    <input type="number" name="harga_user"  required 
                                        value="{{ $product->price_level1 }}"
                                        class="form-control {{ $errors->has('price_level1') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('price_level1') }}</p>
                                </div>
                                <!--  <div class="form-group">
                                    <label for="">Harga user</label>
                                    <input type="number" name="harga_user"  required 
                                        value="{{ $product->harga_user }}"
                                        class="form-control {{ $errors->has('harga_user') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('harga_user') }}</p>
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="">minimum pembelian level 1</label>
                                    <input type="number" name="minimum1"  required 
                                        value="{{ $product->minimum_level_1 }}"
                                        class="form-control {{ $errors->has('minimum1') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum1') }}</p>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="">minimum pembelian level 2</label>
                                    <input type="number" name="minimum2"  required 
                                        value="{{ $product->minimum_level_2 }}"
                                        class="form-control {{ $errors->has('minimum2') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum2') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">minimum pembelian level 3</label>
                                    <input type="number" name="minimum3"  required 
                                        value="{{ $product->minimum_level_3 }}"
                                        class="form-control {{ $errors->has('minimum3') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum3') }}</p>
                                </div>
                                
                                  <div class="form-group">
                                    <label for="">minimum pembelian level 4</label>
                                    <input type="number" name="minimum4"  required 
                                        value="{{ $product->minimum_level_4 }}"
                                        class="form-control {{ $errors->has('minimum4') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('minimum4') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Weight</label>
                                    <input type="float" name="weight"  required 
                                        value="{{ $product->weight }}"
                                        class="form-control {{ $errors->has('weight') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('weight') }}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="">tinggi</label>
                                    <input type="float" name="tinggi"  required 
                                        value="{{ $product->tinggi }}"
                                        class="form-control {{ $errors->has('tinggi') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('tinggi') }}</p>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="">lebar</label>
                                    <input type="float" name="lebar"  required 
                                        value="{{ $product->lebar }}"
                                        class="form-control {{ $errors->has('lebar') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('lebar') }}</p>
                                </div>
                                 <div class="form-group">
                                    <label for="">volume</label>
                                    <input type="float" name="volume"  required 
                                        value="{{ $product->volume }}"
                                        class="form-control {{ $errors->has('volume') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('volume') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">unggulan</label>
                                    <select name="unggulan" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $product->unggulan == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $product->unggulan == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('unggulan') }}</p>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <label for="">tampil</label>
                                    <select name="tampil" id="unggulan" 
                                        required class="form-control {{ $errors->has('unggulan') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $product->tampil == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $product->tampil == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>



                                <div class="form-group">
                                    <label for="">itki</label>
                                    <select name="itki" id="unggulan" 
                                        required class="form-control {{ $errors->has('itki') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $product->itki == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $product->itki == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">histore</label>
                                    <select name="histore" id="unggulan" 
                                        required class="form-control {{ $errors->has('histore') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        <option value="ya" {{ $product->histore == "ya" ? 'selected' : '' }}>ya</option>
                                            <option value="tidak"  {{ $product->histore == "tidak" ? 'selected' : '' }}>tidak</option>
                                      
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                           
                                @endrole
                                
                                <!-- end role harga-->
                                
                                 <!-- role kategori-->
                                @role('admin')

                                <div class="form-group">
                                    <label for="">Induk Category</label>
                                    <select name="induk_id" id="induk_id" 
                                        required class="form-control {{ $errors->has('induk_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($induk_id as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $product->induk_id ? 'selected':'' }}>
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="category_id" 
                                        required class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $product->category_id ? 'selected':'' }}>
                                                {{ ucfirst($row->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Category</label>
                                    <select name="sub_cat_id" id="sub_cat_id" 
                                        required class="form-control {{ $errors->has('sub_cat_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($sub_categories as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $product->sub_cat_id ? 'selected':'' }}>
                                                {{ ucfirst($row->sub_nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('sub_cat_id') }}</p>
                                </div>
                                @endrole
                                
                             
                                
                                <div class="form-group">
                                    <label for="">Foto </label>
                                    @role('admin')
                                    <input type="file" name="photo"  class="form-control">
                                    <br> 
@if($product->photo != null)
                                    <a href="{{route('hapus.photo',$product->photo)}}"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" ></i></a>
                                    @endif
                                    @endrole
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                   
                                        <hr>
                                        @if (!empty($product->photo))
                                                    <img src="{{ asset('uploads/product/' . $product->photo) }}" 
                                                        alt="{{ $product->name }}" width="50px" height="50px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $product->name }}">
                                                @endif


                                </div>
                                
                                <div class="form-group">
                                    <label for="">Foto 2</label>
                                    @role('admin')
                                    <input type="file" name="photo2"  class="form-control">
                                    @endrole
                                    <br>
                                    @if($product->photo_2 != null)
                                    <a href="{{route('hapus.photo2',$product->photo_2)}}"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                   
                                        <hr>
                                     @if (!empty($product->photo_2))
                                                    <img src="{{ asset('uploads/product/' . $product->photo_2) }}" 
                                                        alt="{{ $product->name }}" width="150px" height="150px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $product->name }}">
                                                @endif

                                    
                                </div>
                                <div class="form-group">
                                    <label for="">Foto 3</label>
                                    @role('admin')
                                    <input type="file" name="photo3"  class="form-control">
                                    @endrole
                                    <br>
                                      @if($product->photo_3 != null)
                                    <a href="{{route('hapus.photo3',$product->photo_3)}}"  class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                    <p class="text-danger">{{ $errors->first('photo') }}</p>
                                   
                                        <hr>
                                       @if (!empty($product->photo_3))
                                                    <img src="{{ asset('uploads/product/' . $product->photo_3) }}" 
                                                        alt="{{ $product->name }}" width="150px" height="150px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $product->name }}">
                                                @endif
                                 
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </form>
                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    
     <script type='text/javascript'>

    $(document).ready(function(){

      // Department Change
      $('#category').change(function(){

         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#sub_cat').find('option').not(':first').remove();

         // AJAX request 
         $.ajax({
           url: '/dashboard/ajax-subcat/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var id = response['data'][i].id;
                 var sub_nama = response['data'][i].sub_nama;

                 var option = "<option value='"+id+"'>"+sub_nama+"</option>"; 

                 $("#sub_cat").append(option); 
               }
             }

           }
        });
      });

    });

    </script>

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
                <p>hapus photo 1?</p>
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
         var url = '{{ route("hapus.photo", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
        
@endsection
