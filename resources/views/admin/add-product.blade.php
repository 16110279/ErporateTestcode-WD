@extends('layouts.admin')
{{-- @extends('layouts.admin-rig') --}}

           

@section('content')
   <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambahkan</strong> Product
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ url('admin/add-product') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                       @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="nama" class=" form-control-label">Nama</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="Nama product" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="harga" class=" form-control-label">Harga</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="harga" name="harga" placeholder="Harga product" class="form-control"></div>
                                    </div>
                            
                                   
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="nama" class=" form-control-label">Kategori</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="kategori" id="nama" class="form-control">
                                                <option value="">Please select</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="status" class=" form-control-label">Status</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Please select</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
{{-- 
                                      <div class="form-group" id="field-pariwisata_gambar">
                            <label>Gambar</label>
                            <input type="file" id="pariwisata_gambar" name="pariwisata_gambar" class="form-control">
                        </div>
                                     --}}
                                     
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="pariwisata_gambar" class="form-control-label">Foto Utama</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="pariwisata_gambar" name="pariwisata_gambar" class="form-control"></div>
                                        </div>
{{--                                    
                                     
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-multiple-input" class="form-control-label">Multiple File input</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="file-multiple-input" name="file-multiple-input" multiple="" class="form-control-file"></div>
                                        </div> --}}

                            <div class="form-group float-right">
                                 <input type="submit" value="Simpan" class="btn btn-sm btn-primary px-5">
                             </div>

                                    </form>
                                </div>
                                {{-- <div class="card-footer">
                                    <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                 
                                    </div>
                            </div> --}}
                        </div>
                       
@endsection

