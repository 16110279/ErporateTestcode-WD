@extends('layouts.kasir')
@section('content')
  
            
        <div class="content">
            <div class="animated fadeIn">
  <!-- Widgets  -->
                <div class="row">
{{-- 
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
                    @endforeach --}}

                   
                  
                </div>
            <div>
          
            </div>
            
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product</h4>
                        </div>
                        {{-- <form action="{{ url('/kasir/manage-product/'.$picture->id) }}" method="POST" enctype="multipart/form-data" id="content" class="card mb-5 text-left"> --}}
                <div class="card-body">
                            @method('patch')

                    @csrf


                    <div>
                        {{-- <img src="{{ url('storage/img'.'/'.$product->picture[0]->picture_name) }}" class="card-img-top"> --}}
                        @foreach ($picture as $img)
                        {{-- {{ $im->id }} --}}
                        <img src="{{ url('storage/img'.'/'.$img->picture_name) }}" class="card-img-top"  style="width:100px;height:100px;border:0;">&nbsp
                            
                        @endforeach
                        <a href="{{ url('kasir/manage-product/edit-img') }}" class="btn btn-success"><i class="fa fa-pencil"></i> </a>
                    </div>
                    <br>
                    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

        </div>
                                   
                         
{{-- @endforeach --}}
                    


@endsection

