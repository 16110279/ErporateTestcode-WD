@extends('layouts.kasir')
@section('content')
{{-- @dump($transaction) --}}
  <div class="content">
            <div class="animated fadeIn">

             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Transaction</h4>
                        </div>
                       <div class="card-body">
          <table id="data_product_reguler" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Status</th>
                <th>Total</th>
                <th>Pelayan</th>
                <th>Aksi</th>
                {{-- <th>Created_at</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @dump($product) --}}
            @foreach ($transaction as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->transaction_code }}</td>
                    <td>{{ $item->transaction_status }}</td>
                    <td>{{ $item->transaction_total }}</td>
                    <td>{{ $item->user->name }}</td>
                 
                        <td><a href="{{ url("kasir/manage-product/$item->id/edit") }}" class="btn btn-success"><i class="fa fa-pencil"></i> </a>
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

