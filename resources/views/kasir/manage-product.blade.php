@extends('layouts.kasir')
@section('content')
  <div class="content">
            <div class="animated fadeIn">

             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Product</h4>
                        </div>
                       <div class="card-body">
          <table id="data_product_reguler" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Image</th>
                <th colspan="1">Action</th>
                {{-- <th>Created_at</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @dump($product) --}}
            @foreach ($product as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>Rp. {{ $item->product_price }}</td>
                    {{-- <td>{{ $item->created_at}}</td> --}}
                    <td>{{ $item->category->category_name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                    @foreach ($item->picture as $img)
                        <img src="{{ url('storage/img'.'/'.$img->picture_name) }}"  style="width:50px;height:50px;border:0;">
                    @endforeach
                        </td>
                    {{-- <td>{{ $item->picture[0]->picture_name }}</td> --}}
                    {{-- <td><button>Detail</button></td> --}}
                    {{-- <td><a href="{{ url('admin/manage-product/'.$item->id)}}" class="btn-primary">Edit</a><form action="basic/{{$item ->id}}" method="post"></td> --}}
                        <td>
                            <a href="{{ url("kasir/manage-product/$item->id/edit") }}" class="btn btn-success"><i class="fa fa-pencil"></i> </a>
                            <br>
                            <br>
                            <form action="{{ url("kasir/manage-product/$item->id") }}" method="post">
                                @method('delete')
                                @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a></button>
                            </form>       
                        </td>
                </tr>
            @endforeach


            
    </table>   
</div>
 
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

         

             </div>
                    <div class="float-right">
                    <a href="{{ url("kasir/add-product/") }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
                </div>
            </div>
  </div>
<script>
    $(document).ready(function() {
    $('#data_product_reguler').DataTable();
} );
</script>


                <!--  /Traffic -->
@endsection

