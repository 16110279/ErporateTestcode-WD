@extends('layouts.pelayan')

@section('content')
{{-- @dump($jr) --}}
{{-- {{ $jr }} --}}

{{-- @dump($transaction) --}}
           <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                            
                                   @foreach ($transaction_item as $item)
                                   <form action="{{ url('pelayan/transaction/'.$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                       @csrf
                                  <input type="hidden" name="_method" id="_method" value="PUT">
                                  <input type="hidden" name="idt" id="idt" value="{{ $idt }}">
                                  <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                    <div class="stat-widget-one">
                                        <div class="stat-icon dib"><img src="{{ url('img'.'/'.$item->product->picture[0]->picture_name) }}" width="96px" height="65px">
                                    </div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">{{ $item->Product->product_name }}</div>
                                        <div class="stat-digit">Rp. {{ $item->Product->product_price }}</div>
                                    </div>
                                    
                                    <div class="float-right">
                                       <button type="submit" class="btn btn-success"><li class="fa fa-pencil"></li></button>
                                                                          </form>

                                         <form action="{{ url('pelayan/transaction/item/'.$item->id) }}" method="post">
                                @method('delete')
                                @csrf
                                    <button type="submit" class="btn btn-danger"><li class="fa fa-trash"></li></button>
                                         </form>
                                    </div>

                                    <div class="float-right">
                                            <div class="row form-group">
                                            <div class="col-12 col-md-9"><input type="number" id="item_qty" name="item_qty" class="form-control  @error('item_qty') is-invalid @enderror" value="{{ $item->item_qty }}"></div>
                                                            @error('item_qty')
                        <div class='invalid-feedback'>{{ $message }}</div>
                        @enderror

                                        </div>                                    
                                </div>
                        

                                
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


                                            <br>
                                                <form action="{{ url('pelayan/transaction/updtmeja') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                        <input type="hidden" name="_method" id="_method" value="PUT">
                                  <input type="hidden" name="idt_a" id="idt_a" value="{{ $idt }}">
                                                                                                                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="no_meja" class=" form-control-label">Nomer Meja</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="no_meja" name="no_meja" placeholder="No Meja" class="form-control  @error('no_meja') is-invalid @enderror"  value="{{ $transaction->no_meja }}"></div>
                                                                @error('no_meja')
                                                                <div class='invalid-feedback'>{{ $message }}</div>
                                                                @enderror
                                    </div>

                                            <button class="btn btn-primary">
                                                Update
                                            </button>
                                                    </form>



                                            

                                            <div class="text-center">
                                                    {{-- <form action="{{ url('pelayan/cart/checkout') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                            @csrf
                                          
                                            <button class="btn btn-success">
                                                Update
                                            </button>
                                                    </form> --}}
                                            </div>
                                        </div>
                                    </div><!-- /.card -->
                                </div>
                            </div>
                </div>

                <div>
                {{-- @foreach ($all_product as $pr) --}}
 {{-- <form action="{{ url('pelayan/transaction/'.$idt.'/update') }}" method="POST">
                                       @csrf --}}
 
                                                              
                </div>
                

                       <div class="card-body">
          <table id="data_product_reguler" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Foto</th>
                <th>Aksi</th>
                {{-- <th>Created_at</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @dump($product) --}}
            @foreach ($all_product as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>Rp. {{ $item->product_price }}</td>
                    <td>{{ $item->category->category_name }}</td>
                    <td>
                        @foreach ($item->picture as $img)
                          <img src="{{ url('img'.'/'.$img->picture_name) }}"  style="width:50px;height:50px;border:0;">

                        @endforeach
                    </td>
                        

                 
                             
                        <td>
                            <form action="{{ url('pelayan/transaction/'.$item->id.'/update') }}" method="POST">
                                @csrf
                            <input type="number" name="idt" id="idt" value="{{ $idt }}" hidden>
                            <input type="number" name="idp" id="idp" value="{{ $item->id }}" hidden>
                            <button type="submit" class="btn btn-primary"><li class="fa fa-shopping-cart"></li></button>
                            </form>
                        {{-- <a }}<li class="fa fa-shopping-cart"></li></a></td> --}}
                </tr>
            @endforeach


            
    </table>   
</div>
 
                    </div>
                    <!-- /# card -->
 

  </div>
<script>
    $(document).ready(function() {
    $('#data_product_reguler').DataTable();
} );
</script>

                @endsection


