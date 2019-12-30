{{-- @dump($tr) --}}
<title>Cetak Laporan</title>                                  
                                                             
                     <div class="col">  <h1>LAPORAN</h1> </div>                 
                     <div class="col"> Nama Karyawan :   {{ Auth::user()->name }}</div>                 
                     <div class="col"> Tanggal dicetak :    {{ $date }}</div>                 
                     <div class="col"> Total uang masuk semua transaksi : Rp. {{ $total }}</div>
                     <br>                 

                     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Order ID</th>
      <th scope="col">Total</th>
      <th scope="col">Status</th>
      <th scope="col">Item</th>
      <th scope="col">Tanggal Order</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($tr as $item)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{ $item->transaction_code }}</td>
      <td>Rp. {{ $item->transaction_total }}</td>
      <td>{{ $item->transaction_status }}</td>
      <td>
        @foreach ($item->transactionItem as $i)
          {{ $i->product->product_name .' ' .$i->item_qty .',' }} 
        @endforeach
      </td>
      <td>{{ $item->created_at }}</td>
  
    </tr>
      @endforeach
    
  </tbody>
</table>    
<script>
		window.print();
	</script>
