@extends('layouts.pelayan')

@section('content')
{{-- @dump($sum) --}}


{{-- @dump($cart) --}}
           <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                            
                                   @foreach ($cart as $item)
                                   <form action="{{ url('pelayan/cart/'.$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                       @csrf
                                  <input type="hidden" name="_method" id="_method" value="PUT">
                                  <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><img src="{{ url('storage/img'.'/'.$item->Picture->picture_name) }}" width="96px" height="65px">
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">{{ $item->Product->product_name }}</div>
                                        <div class="stat-digit">Rp. {{ $item->Product->product_price }}</div>
                                    </div>
                                    
                                    <div class="float-right">
                                       <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                    <div class="float-right">
                                            <div class="row form-group">
                                            <div class="col-12 col-md-9"><input type="number" id="cart_qty" name="cart_qty" placeholder="Nama product" value="{{ $item->cart_qty }}" class="form-control"></div>
                                    </div>                                    
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
                <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="card br-0">
                                        <div class="card-body">
                                            <div class="chart-container ov-h">
                                                Ringkasan Order
                                                    <hr />
                                                Rp. {{ $sum }}
                                            </div>
                                            <div class="text-center">
                                                    <form action="{{ url('pelayan/cart/checkout') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                          
                                            <button class="btn btn-success">
                                                Checkout
                                            </button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div><!-- /.card -->
                                </div>
                            </div>
                </div>

 
@endsection


