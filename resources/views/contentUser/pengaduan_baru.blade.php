
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pengaduan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a>Konsultasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/Konsultasi">Buat Konsultasi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Data Terlapor</div>
                        </div>
                        <div class="card-body">
                            <div class="row d-block">
                                <form method="post" action="{{route('add_aduan')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach ($userData as $key => $item )
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">ID</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$id_room}}" name="idroom" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Nama Terlapor</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="nama_terlapor" >
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Jabatan/Pekerjaan</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="jabatan_pekerjaan">
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Alamat</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="alamat">
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Tempat Kejadian</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="tempat_kejadian">
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Waktu Kejadian</label>
                                        <div class="col-md-9 p-0">
                                            <input type="date" class="form-control input-full" id="inlineinput" name="waktu_kejadian">
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Uraian Singkat Aduan</label>
                                        <div class="col-md-9 p-0">
                                            <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="uraian" maxlength="1500">{{ old('pertanyaan') }}</textarea>
                                            <a class="text-danger">max. 1500 karakter</a>    
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Foto/Dokumentasi terkait</label>
                                        <div class="col-md-9 p-0">
                                            <input type="file" class="form-control-file input-full" id="inlineinput" name="aduan_file">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Kirim Aduan</button>
                                    
                                </div>
                                </form>
                            
                            </div>
                        </div>
                        {{-- <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div> --}}
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
