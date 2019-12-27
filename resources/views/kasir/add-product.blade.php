@extends('layouts.kasir')

           

@section('content')
   <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            Tambahkan Product
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ url('kasir/add-product') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                       @csrf

                
 <div>
                     
                    </div>
                    <br>
                    <div class="form-group" id="field-product_name">
                        <label>Nama</label>
                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="Nama Product" value="{{old('product_name')}}">
                        
                        @error('product_name')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="form-group" id="field-product_price">
                        <label>Harga</label>
                        <input type="text" class="form-control @error('product_price') is-invalid @enderror" id="product_price" name="product_price" placeholder="Harga product" value="{{old('product_price')}}">
                        
                        @error('product_price')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                       @foreach ($category as $c)
                            <option value='{{ $c->id }}'>{{ $c->category_name }}</option>

                       @endforeach
                        
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                                           <select name="status" id="status" class="form-control">

                                                    <option value="Ready">Ready</option>
                                                    <option value="Sold Out">Sold Out</option>
                                            </select>

                        
                    </div>

                                   
                                                 
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="product_gambar" class="form-control-label">Foto Utama</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="product_gambar" name="product_gambar" class="form-control"></div>
                                        </div>

                            <div class="form-group float-right">
                                 <input type="submit" value="Simpan" class="btn btn-sm btn-primary px-5">
                             </div>

                                    </form>
                                </div>
                             
                        </div>
                       
@endsection

