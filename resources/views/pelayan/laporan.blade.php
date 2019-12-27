@extends('layouts.pelayan')
@section('content')
{{-- @dump($item) --}}
  <div class="content">
            <div class="animated fadeIn">

             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Order</h4>
                        </div>
                       <div class="card-body">
          <table id="data_product_reguler" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Transaksi</th>
                <th>Total</th>
                <th colspan="1">Status</th>
                {{-- <th>Created_at</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @dump($product) --}}
            @foreach ($laporan as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->transaction_code }}</td>
                    <td>Rp. {{ $item->transaction_total }}</td>
                    <td>{{ $item->transaction_status }}</td>
                    {{-- <td>{{ $item->transactionItem[1]->id }}</td> --}}
           

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
            <div class="float-right">
                  <a href="{{ url(('pelayan/cetak-laporan')) }}" target="_BLANK">
    <button class="btn-primary">Cetak
    </button>
      </a>

</div>
  </div>
<script>
    $(document).ready(function() {
    $('#data_product_reguler').DataTable();
} );
</script>


                <!--  /Traffic -->
@endsection

