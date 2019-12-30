@extends('layouts.kasir')
@section('content')
  
            
        {{-- <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                        @foreach ($picture as $img)
                        <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ url('storage/img'.'/'.$img->picture_name) }}" alt="Card image cap">
                            <div class="card-body">
                                      <div class="row form-group">
                                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="file-input" class="form-control-file"></div>
                                        <button class="btn btn-success"><li class="fa fa-upload"></li></button>
                                    </div>
                            </div>
                        </div>
                    </div>     
                        @endforeach
                </div></div></div> --}}



     <div id="content" class="row"></div>
 <!-- Modal -->
            <form action="{{ url('api/v1/picture') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" id="product_form">
{{-- <form action="{{ url('kasir/add-product') }}" method="POST" enctype="multipart/form-data" class="form-horizontal"> --}}

                                           @csrf

   <div class="modal fade" id="addImgModal" tabindex="-1" role="dialog" aria-labelledby="addImgModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
            {{-- <form action="{{ url('api/v0/product/'.$product->id .'/picture') }}" enctype="multipart/form-data" method="post" id="product_form"> --}}
        
                <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Tambahkan Gambar Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" id="_method" value="POST">

                        <div class="form-group" id="field-product_id">
                        
                            <input type="text" hidden class="form-control" id="product_id" name="product_id" placeholder="Product Id" value="{{ $product->id }}">
                        </div>

                        <div class="form-group" id="field-picture_name">
                             <input type="file" id="picture_name" name="picture_name" class="form-control">
                        </div>
                    </div>


                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
               </form>
           </div>
       </div>
   </div>

             <script>

            $(document).ready(function(){
                loadData({{ $product->id }});
            });
            </script>     

                    
         
<div class="float-right">
                 <button type="button" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#addImgModal"> Add New</button>
</div>
        
                                   
                         
{{-- @endforeach --}}
                    


@endsection

