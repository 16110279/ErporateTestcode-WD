@extends('layouts.pelayan')

@section('content')
@dump($test)


{{-- @dump($cart) --}}
           <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Detail Pesanan</h4>
                                        <hr />
                                    
                                             <div class="form-group">
                                                {{-- <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span> --}}
                                                  Total :   Rp.  {{ $sum }}
                                        <br>
                                        Status : @foreach ($status as $key)
                                            {{ $key->transaction_status  }}
                                          <div class="float-right">
                                                    {{ $key->created_at }}
                                                </div>
                                        @endforeach
                                              
                                             </div>
                                   <hr />
                                  
                                   @foreach ($laporan as $item)
                                   <form action="{{ url('pelayan/cart/'.$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                       @csrf
                                  <input type="hidden" name="_method" id="_method" value="PUT">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><img src="{{ url('storage/img'.'/'.$item->Picture->picture_name) }}" width="96px" height="65px">
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">{{ $item->Product->product_name }}</div>
                                        <div class="stat-digit">Rp. {{ $item->Product->product_price }} * {{ $item->item_qty }} = Rp. {{ $item->item_subtotal }}</div>
                                    </div>
                                    
                          

                                    <div class="float-right">
                                            {{-- <div class="row form-group">
                                            <div class="col-12 col-md-9"><input type="number" id="cart_qty" name="cart_qty" placeholder="Nama product" value="{{ $item->item_qty }}" class="form-control"></div>
                                    </div>                                     --}}
                                </div>
                                   </form>
                        

                          
                                </div>
                                <br>

                                       
                                   @endforeach 
                                    
                                     
                                    
                               
                                </div>
                                <div class="card-body--">
                                    
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->
               

 
@endsection


