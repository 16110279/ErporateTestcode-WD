@extends('layouts.admin')
@section('content')
  @php
                $test = array();

            @endphp
            @foreach ($product as $item => $v)
              @php  array_push($test,$v);
         
              @endphp

            @endforeach

            <?php
            // $img_0 = $test[0]->picture_name;
            // $img_1 = $test[1]->picture_name;
            // $img_2 = $test[2]->picture_name;

            $test[3] = array("product_name"=>"rfjsk");

            ?>
            @dump($test)
            
        <div class="content">
            <div class="animated fadeIn">
  <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$test[0]->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$test[1]->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$test[2]->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$test[2]->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
          

            <!-- Animated -->
                <!-- Widgets  -->
                {{-- <div class="row">
                    @foreach ($product as $item)
                        <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div style="margin: 0 auto">
                                    <img src="{{ url('storage/img'.'/'.$item->picture_name) }}" alt="Italian Trulli" width="192px" height="130px">
                                    </div>
                                     
                                </div>
                                
                            </div>
                            <div class="row form-group">
                                    
                                            <div class="col-12 col-md-9" style="margin: 0 auto"><input type="file" id="pariwisata_gambar" name="pariwisata_gambar" class="form-control"></div>
                                        </div>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
            
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>World</h4>
                        </div>
                        <div class="Vector-map-js">
                            <div id="vmap" class="vmap"></div>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

        </div>
                                   
                         
{{-- @endforeach --}}
                    

@endsection

