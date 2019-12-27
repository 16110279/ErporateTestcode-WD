@extends('layouts.admin')
@section('content')
   <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $p)
                                            
                                        <tr>
                                            <th scope="row"> {{ $loop->iteration}} </th>
                                            <td>{{ $p->product_name }}</td>
                                            <td>Rp. {{ $p->product_price }}</td>
                                            <td>{{ $p->category->category_name }}</td>
                                            <td>$320,800</td>
                                        </tr>
                                        
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="float-right">
            <button class="btn btn-primary">+
            </button
        </div>



                <!--  /Traffic -->
@endsection