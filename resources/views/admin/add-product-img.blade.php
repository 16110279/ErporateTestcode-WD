@extends('layouts.admin')
{{-- @extends('layouts.admin-rig') --}}

           

@section('content')
   <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambahkan</strong> Product
                            </div>
                            <div class="card-body card-block">
                                <form action="{{ url('admin/add-product') }}" method="POST" class="form-horizontal">
                                       @csrf
                                       
                                     
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-multiple-input" class=" form-control-label">Multiple File input</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="file-multiple-input" name="file-multiple-input" multiple="" class="form-control-file"></div>
                                        </div>
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

