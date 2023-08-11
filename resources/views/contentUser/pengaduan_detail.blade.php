
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Aduan</h4>
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
                        <a>Pengaduan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/Konsultasi">Detail Aduan</a>
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
                                @foreach ($room as $key => $item )
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">ID</label>
                                        <div class="col-md-9 p-0">
                                        
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->roomID}}" name="idroom" readonly>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-lg-8">
                                    @if ($item->file_name !='' )
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">File</label>
                                        <div class="col-md-9 p-0">
                                           
                                            <a class="btn btn-success  btn-xs text-white" href="/adminfrontend/consultfile/{{$item->file_name}}" target="_blank"> <i class="far fa-eye"></i> Lihat File</a>

                                        </div>
                                    </div>
                                    @endif
                                </div>        
                            @endforeach
                            @foreach ($chat as $key => $item )
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Nama Terlapor</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->nama_terlapor}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Jabatan/Pekerjaan</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->jabatan_pekerjaan}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Alamat</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->alamat}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Tempat Kejadian</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->tempat_kejadian}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Waktu Kejadian</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->waktu_kejadian}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Uraian Kejadian</label>
                                    <div class="col-md-9 p-0">
                                        <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="uraian" maxlength="1500"  readonly>{{$item->uraian}}</textarea>
                                    </div>
                                </div>
                            </div> 
                            @if ($item->aduan_file != null )
                            <div class="col-md-6 col-lg-8">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Dokumentasi/Lampiran</label>
                                    <div class="col-md-9 p-0">
                                        <a class="btn btn-success  btn-xs text-white" href="/adminfrontend/aduanfile/{{$item->aduan_file}}" target="_blank" data-placement="top" title="Lihat Lampiran"> <i class="far fa-eye"></i> </a>

                                    </div>
                                </div>
                            </div>
                            @else
                            @endif

                            @endforeach

                            
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Detail Tindak Lanjut</div>
                        </div>
                        <div class="card-body">
                            <div class="row d-block">
                                @foreach ($chat as $key => $item )
                                @if ($item->message == null)
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto"></label>
                                        <div class="col-md-9 p-0 text-center">
                                           
                                            <h2> Terima kasih telah mengirimkan aduan, laporan anda telah diterima & dalam proses peninjauan. </h2>

                                           
                                        </div>
                                    </div>
                                </div> 
                                @else
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto"></label>
                                        <div class="col-md-9 p-0">
                                            <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="uraian" maxlength="1500"  readonly>{{$item->message}}</textarea>
                                        </div>
                                    </div>
                                </div> 
                                @endif
                                
                                <div class="col-md-6 col-lg-8">
                                    @if ($item->message_file != null )
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">File</label>
                                        <div class="col-md-9 p-0">
                                           
                                            <a class="btn btn-success  btn-xs text-white" href="/adminfrontend/aduanfile/{{$item->message_file}}" target="_blank"> <i class="far fa-eye"></i> Lihat File</a>

                                        </div>
                                    </div>
                                    @endif
                                </div>        
                            @endforeach


                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
