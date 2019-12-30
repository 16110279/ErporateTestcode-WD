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
                        <form action="{{ url('/kasir/manage-product/'.$product->id) }}" method="POST" enctype="multipart/form-data" id="content" class="card mb-5 text-left">
                <div class="card-body">
                            @method('patch')

                    @csrf


                    <div>
                        {{-- <img src="{{ url('storage/img'.'/'.$product->picture[0]->picture_name) }}" class="card-img-top"> --}}
                        @foreach ($product->picture as $img)
                        {{-- {{ $img->id }} --}}
                        <img src="{{ url('img'.'/'.$img->picture_name) }}" class="card-img-top"  style="width:100px;height:100px;border:0;">&nbsp
                            
                        @endforeach
                        <a href="{{ url('kasir/manage-product/'.$product->id.'/edit-img') }}" class="btn btn-success"><i class="fa fa-pencil"></i> </a>
                    </div>
                    <br>
                    <div class="form-group" id="field-product_name">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="name product" value="{{ $product->product_name }}">
                        
                        @error('product_name')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="form-group" id="field-product_price">
                        <label>Harga</label>
                        <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" placeholder="price product" value="{{ $product->product_price }}">
                        
                        @error('product_price')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                        <option value="{{ $product->category_id }}">{{ $product->category->category_name }}</option>
                       @foreach ($category_lain as $c)
                            <option value='{{ $c->id }}'>{{ $c->category_name }}</option>
                          
                       @endforeach
                        
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                        <option value="{{ $product->status }}">{{ $product->status }}</option>
                        @php
                            if($product->status == 'Ready')
                            {
                                echo "<option value='Sold Out'>Sold Out</option>";
                            }
                            else if($product->status == 'Sold Out')
                            {
                                echo "<option value='Ready'>Ready</option>";
                            }

                        @endphp
                        
                            </select>
                    </div>

                    
    
                
    
                    {{-- <div class="form-group" id="field-product_gambar">
                        <label>Gambar</label>
                        <input type="file" id="product_gambar" name="product_gambar" class="form-control @error('product_gambar') is-invalid @enderror">
                    
                        @error('product_gambar')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div> --}}

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

