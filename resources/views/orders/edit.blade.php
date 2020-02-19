@extends('layouts.master')

@section('title')
    <title>Edit Data Order</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
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
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Status Order</label>
                                            @if($order->status == '-1')
                                            <input type="text" readonly value="Di batalkan" class="form-control">
                                            @elseif ($order->status == '1')
                                            <input type="text" readonly value="Di proses" class="form-control">
                                             @elseif ($order->status == '2')
                                             <input type="text" readonly value="pesanan di kirim" class="form-control">
                                              @elseif ($order->status == '0')
                                             <input type="text" readonly value="Menunggu konfirmasi" class="form-control">
                                               @elseif ($order->status == '3')
                                             <input type="text" readonly value="pesanan selesai" class="form-control">
                                              @elseif ($order->status == '4')
                                             <input type="text" readonly value="pesanan tiba" class="form-control">
                                             @endif





                                </div>
                                <div class="form-group">
                                    <label for="">Invoice</label>
                                    <input type="text" name="invoice" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $order->invoice }}"
                                        class="form-control {{ $errors->has('invoice') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('invoice') }}</p>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="customer_id" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $order->customer_id }}"
                                        class="form-control {{ $errors->has('customer_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('customer_id') }}</p>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <input type="hidden" name="user_id" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $order->user_id }}"
                                        class="form-control {{ $errors->has('user_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('user_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Total</label>
                                    <input type="text" name="total" required 
                                        maxlength="10"
                                        readonly
                                        value="{{ $order->total }}"
                                        class="form-control {{ $errors->has('total') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('total') }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <frame id="frame_select">
                                        <select name="status" id="status" 
                                            required class="form-control {{ $errors->has('status') ? 'is-invalid':'' }}">
                                            <option value="">Pilih</option>
                                            @if($order->status == 0)
                                            <option value="-1">dibatalkan</option>
                                            <option value="1">di proses</option>
                                            @elseif($order->status == 1 && $order->type==0)
                                            <option value="2">pesanan di kirim </option>
                                            @elseif($order->status == 1)
                                            <option value="3">pesanan selesai</option>
                                             @elseif($order->status == 2)
                                            <option value="4">pesanan tiba</option>
                                             @elseif($order->status == 4 )
                                            <option value="3">pesanan selesai</option>
                                            @endif



                                        </select>
                                    </frame>
                                    <p class="text-danger">{{ $errors->first('status') }}</p>
                                    <input type="text" name="type" value="{{$order->type}}" style="display:none"/>
                                </div>
                                
                                @if($order->type == 0)
                                <div class="form-group" id="resi" style="display:none">
                                    <label for="">Nomor Resi</label>
                                    <input type="text" name="resi" class="form-control">
                                </div>
                                @endif
                                
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
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

            $(function () {
                console.log('asds');
                $('select').on('change', function() {
                //   alert( $("input[name=type]").val() );
                  $type = $("input[name=type]").val();
                  $status = $(this).val();
                  if($type == 0 && $status == 2){
                      $("#resi").attr("style", "visibility: visible")

                  }
                });

                $('#foobar input[type=file]').change(function(){
                    var myfile= $( this ).val();
                    console.log(myfile);
                    var ext = myfile.split('.').pop();
                    if(ext=="pdf" || ext=="png" || ext=="jpg" || ext=="jpeg"){
                     
                 } else{
                    alert('File harus gambar atau pdf !');
                     $( this ).val('');
                 }
             });
            })
        </script>