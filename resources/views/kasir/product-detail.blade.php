@extends('layouts.kasir')
@section('content')
  
            @dump($product)
            
        <div class="content">
            <div class="animated fadeIn">
  <!-- Widgets  -->
                <div class="row">

                    @foreach ($picture as $item)
                         <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$item->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                   
                  
                </div>
            <div>
          
            </div>
            
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail</h4>
                        </div>
                        <div class="Vector-map-js">
                           
                               @foreach ($product as $p)
                                   Nama Product :  {{ $p->product_name }} <br>
                                   Harga Product : Rp.  {{ $p->product_price }} <br>
                                   Status Product : Rp.  {{ $p->status }} <br>
                                   Status Product : Rp.  {{ $p->category->category_name }}
                               @endforeach
                            
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

        </div>
                                   
                         
{{-- @endforeach --}}
                    

@endsection

