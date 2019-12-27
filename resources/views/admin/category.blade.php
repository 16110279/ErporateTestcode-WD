@extends('layouts.admin')
@section('content')
<div class="card-body">
          <table id="data_product_reguler" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Image</th>
                <th colspan="1">Action</th>
                {{-- <th>Created_at</th> --}}
            </tr>
        </thead>
        <tbody>
            {{-- @dump($product) --}}
         


            
    </table>   

</div>
    <div class="float-right">
            <button type="button" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#newMenuModal">+</button>
    </div>
         <!-- Modal -->
   <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
            <form action="{{ url('api/v0/product') }}" method="post" id="product_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Add New Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="_method" id="_method" value="POST">

                        <div class="form-group" id="field-product_nama">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="product_nama" name="product_nama" placeholder="Nama product">
                        </div>

                        <div class="form-group" id="field-product_alamat">
                            <label>Harga</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Harga product">
                        </div>

                        <div class="form-group" id="field-Kategori">
                            <label>Kategori</label>
                            <input type="text" class="form-control" id="product_category" name="product_price" placeholder="Kategori product">
                        </div>
 
                        <div class="form-group" id="field-product_gambar">
                            <label>Gambar</label>
                            <input type="file" id="product_gambar" name="product_gambar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
               </form>
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

