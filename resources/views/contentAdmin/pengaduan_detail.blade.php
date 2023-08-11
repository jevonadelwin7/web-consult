
@extends('layoutsAdmin.template')

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
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">ID</label>
                                        <div class="col-md-9 p-0">
                                        
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->roomID}}" name="idroom" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Data Pembuat Aduan</label>
                                        <div class="col-md-9 p-0">
                                           
                                            <a type="button" class="btn btn-primary  btn-xs text-white" data-toggle="modal" data-target="#exampleModal">
                                                Lihat Data User
                                            </a>

                                        </div>
                                    </div>
                                    
                                </div>     
                                <div class="col-md-12 col-lg-12">
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
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Nama Terlapor</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->nama_terlapor}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Jabatan/Pekerjaan</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->jabatan_pekerjaan}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Alamat</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->alamat}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Tempat Kejadian</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->tempat_kejadian}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Waktu Kejadian</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->waktu_kejadian}}" name="idroom" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Uraian Kejadian</label>
                                    <div class="col-md-9 p-0">
                                        <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="uraian" maxlength="1500"  readonly>{{$item->uraian}}</textarea>
                                    </div>
                                </div>
                            </div> 
                            @if ($item->aduan_file != null )
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Dokumentasi/Lampiran</label>
                                    <div class="col-md-9 p-0">
                                        <a class="btn btn-success  btn-xs text-white" href="/adminfrontend/aduanfile/{{$item->aduan_file}}" target="_blank" data-placement="top" title="Lihat Lampiran"> <i class="far fa-eye"></i> </a>

                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Dokumentasi/Lampiran</label>
                                    <div class="col-md-9 p-0">
                                        <a class="btn btn-danger  btn-xs text-white" > Tidak ada file yang dilampirkan</a>

                                    </div>
                                </div>
                            </div>
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
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Balasan</label>
                                        <div class="col-md-9 p-0 text-center">
                                           
                                            <h2>
                                                Laporan Pengaduan ini belum diberi tanggapan, silahkan mengisi tanggapan pada kolom dibawah.
                
                                            </h2>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">File</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <a class="btn btn-danger  btn-xs text-white"  target="_blank"> Belum ada file yang dikirimkan</a>

                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Ditanggapi Oleh</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <a>-</a>

                                    </div>
                                </div>
                                @else
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Balasan</label>
                                        <div class="col-md-9 p-0">
                                            <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="uraian" maxlength="1500"  readonly>{{$item->message}}</textarea>
                                        </div>
                                    </div>
                                </div> 
                                @endif
                                @if ($item->message_file != null )
                                <div class="col-md-12 col-lg-12">
                                   
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">File</label>
                                        <div class="col-md-9 p-0">
                                           
                                            <a class="btn btn-success  btn-xs text-white" href="/adminfrontend/aduanfile/{{$item->message_file}}" target="_blank"> <i class="far fa-eye"></i> Lihat File</a>

                                        </div>
                                    </div>
                                    
                                </div>  
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Ditanggapi Oleh</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <a>{{$UserRespon}}</a>

                                    </div>
                                </div> 
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Waktu Respon</label>
                                    <div class="col-md-9 p-0">
                                       
                                        <a>{{$item->updated_at}}</a>

                                    </div>
                                </div>      
                                @endif
                          
                                <div class="col-md-12 col-lg-12">
                                    <form method="post" action="{{route('addMessage_aduan', $item->id)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PUT')
                                        <div class="form-group">        
                                            <input class="form-control"  name="idroom" rows="5" style="border:solid 1px orange" value="{{$roomID}}" hidden>
                                        </div>
                                    <div class="form-group">
                                        <label for="comment">Berikan / Update  tanggapan aduan </label>
                                        <textarea class="form-control" id="comment" name="comment" rows="5" style="border:solid 1px orange"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="largeInput">Upload File</label>
                                        <input type="file" class="form-control-file @error('files') is-invalid @enderror" name="files">
                                        @error('files')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror 
        
                                    </div> 
                                    <div class="card-action">
                                        <button  type="submit" class="btn btn-success">Kirim</button>
                                        {{-- <button class="btn btn-danger">Cancel</button> --}}
                                    </div>
                                    </form>
                                </div> 
                                 @endforeach
                            </div>
                        </div>
                        @foreach ($DataUser as $key => $item )
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                       
                                   
                                    <div class="form-group">
                                        <label class="control-label">
                                            Nama
                                        </label> 
                                        <p class="form-control-static">{{$item->name}}</p> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            Email
                                        </label> 
                                        <p class="form-control-static">{{$item->email}}</p> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
                                            No. HP/WA
                                        </label> 
                                        <p class="form-control-static">{{$item->phone}}</p> 
                                    </div>
                                    
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                                </div>
                                    
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
