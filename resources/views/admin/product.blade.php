@extends('layouts.admin')
@section('content')
  <div class="content">
            <div class="animated fadeIn">

             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Makanan</h4>
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

                    {{-- <td><img src="{{ storage('img'.'/'.$item->picture[0]->picture_name) }}" alt="Italian Trulli"></td> --}}
                    <td><img src="{{ url('storage/img'.'/'.$item->picture[0]->picture_name) }}" width="96px" height="65px"></td>
                    {{-- <td>{{ $item->picture[0]->picture_name }}</td> --}}
                    {{-- <td><button>Detail</button></td> --}}
                    <td><a href="{{ url('admin/manage-product/'.$item->id)}}" class="btn-primary">Edit</a><form action="basic/{{$item ->id}}" method="post"></td>

                </tr>
            @endforeach


            
    </table>   
</div>
 
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

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

