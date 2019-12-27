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
                    <td>Rp. {{ $item->transaction_total }}</td>
                    <td>{{ $item->user->name }}</td>
                 
                        <td>
                            <a href="{{ url("kasir/transaction/$item->id/") }}" class="btn btn-success"><li class="fa fa-pencil"></li></a>
                            <a href="{{ url("kasir/transaction/$item->id/bayar") }}" class="btn btn-warning" name="bayar" id="bayar"><li class="fa fa-money"></li></a>
                            <br>
                            <br>
                            <form action="{{ url("kasir/transaction/$item->id") }}" method="post">
                                @method('delete')
                                @csrf
                                    <button type="submit" class="btn btn-danger" name="delete" id="delete"><i class="fa fa-trash-o"></i> </a></button>
                            </form>                          </td>
                </tr>
            @endforeach


            
    </table>   
</div>
 
                    </div>
                    <!-- /# card -->
                </div>
                <!-- /# column -->

         

  </div>
<script>
    $(document).ready(function() {
    $('#data_product_reguler').DataTable();
} );
</script>
<script>
    $(".bayar").on("submit", function(){
        return confirm("Are you sure?");
    });
    $(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });
</script>

                <!--  /Traffic -->
@endsection

