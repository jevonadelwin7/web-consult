
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Layanan Administrasi</h4>
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
                        <a href="/layanan_administrasi/surat_bebas_temuan_pemeriksaan">Data History</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a >E-Form</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Data Pemohon</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="post" action="{{route('addConsult')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach ($userData as $key => $item )
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="{{$item->name}}"readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">NIK</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="{{$item->nip}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">No. HP</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="{{$item->email}}" readonly>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="card-action">
                                    {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
                                    
                                </div>
                                </form>
                            
                            </div>
                        </div>
                        {{-- <div class="card-action">
                            <button class="btn btn-success">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div> --}}
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Proses Permohonan</div>
                            </div>
                            <div class="card-body">
                                <ol class="activity-feed">
                                    <li class="feed-item 
                                    @if ($sbt == 0)
                                    feed-item-warning
                                    @else
                                    feed-item-success
                                    @endif
                                    ">
                                        <time class="date" datetime="9-25"></time>
                                        <span class="text">Melengkapi Berkas</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sbt == 1)
                                    feed-item-warning
                                    @elseif ($sbt < 1)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-24"></time>
                                        <span class="text">Validasi Data</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sbt == 2)
                                    feed-item-warning
                                    @elseif ($sbt < 2)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-23"></time>
                                        <span class="text">Revisi Data</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sbt == 3)
                                    feed-item-warning
                                    @elseif ($sbt < 3)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-21"></time>
                                        <span class="text">Verifikasi EVLAP</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sbt == 4)
                                    feed-item-warning
                                    @elseif ($sbt < 4)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-18"></time>
                                        <span class="text">Disetujui</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sbt == 5)
                                    feed-item-warning
                                    @elseif ($sbt < 5)
                                    feed-item-info
                                    @elseif ($sbt > 5)
                                    feed-item-info
                                    @else
                                    
                                    @endif">
                                        <time class="date" datetime="9-18"></time>
                                        <span class="text">Surat Bebas temuan terbit</span>
                                    </li>
                                    
                                    @if ($sbt == 6)
                                    <li class="feed-item feed-item-danger"><time class="date" datetime="9-18"></time>
                                        <span class="text">Permohonan tidak dapat dilanjutkan</span>
                                    </li>                                   
                                    @endif
                                </ol>
                            </div>
                        </div>
                        
                    </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">E-Form</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                @foreach ($dt as $key => $item )
                                <form method="post" action="{{route('storeSKTP')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                    <div class="form-group">
                                        <input type="text" value="{{$item->id_permohonan}}" name="id_permohonan" hidden>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="{{$item->id}}" name="id" hidden>
                                    </div>
                                    <div class="form-group input-group">
                                        <label for="inlineinput" class="col-md-3 col-form-label mr-5"> SK Pangkat Terakhir</label>
                                        <div class="custom-file mr-2">
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="sk_pangkat">
                                            @if($item->sk_pangkat == NULL)
                                            
                                            @else
                                            <span>{{$item->sk_pangkat}}</span>                       
                                            @endif
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-xs btn-primary mr-1">Simpan</button>
                                            @if($item->sk_pangkat == NULL)
                                            @else
                                            <a type="button" class="btn btn-xs btn-success" href="/adminfrontend/sbt_file/{{$item->sk_pangkat}}" target="_blank">Lihat</a>                       
                                            @endif
                                        </div>
                                                          <div class="form-group input-group">
                                        <label for="inlineinput" class="col-md-3 col-form-label mr-5"> SK Tidak pernah dijatuhi hukuman sedang/berat </label>
                                        <div class="custom-file ">
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="sp_hukuman_disiplin">
                                            @if($item->sp_hukuman_disiplin == NULL)
                                            
                                            @else
                                            <span>{{$item->sp_hukuman_disiplin}}</span>                       
                                            @endif
                                        </div>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-xs btn-primary mr-1">Simpan</button>
                                            @if($item->sp_hukuman_disiplin == NULL)
                                            @else
                                            <a type="button" class="btn btn-xs btn-success" href="/adminfrontend/sbt_file/{{$item->sp_hukuman_disiplin}}">Lihat</a>                       
                                            @endif
                                        </div>
                                    </div>

                                    
                                </form>
                                </div>
                                <div class="card-action">
                                    @if(is_null($item->sp_hukuman_disiplin) || is_null($item->sk_pangkat) )
                                    <button class="btn btn-secondary" disabled="disabled">Upload Lampiran <i class="
                                        fas fa-upload"></i> </button>
                                        <span class="text-xs text-danger">*Lengkapi Formulir terlebih dahulu</span>
                                        
                                    @elseif(!is_null($item->is_upload))

                                    @else
                                    <form method="post" action="/is_upload_sktp/{{$item->id_permohonan}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" value="{{$item->id_permohonan}}" name="id_permohonan" hidden>
                                        </div>
                                    <button type="submit" class="btn btn-secondary">Upload Lampiran <i class="
                                        fas fa-upload"></i> </button>
                                    @endif
                                    <div class="form-group">
                                        <label for="comment">Catatan</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="5" style="border:solid 1px orange" readonly>{{$item->message}}</textarea>
                                    </div>
                                    </form>      
                                </div>`
                                
                            @endforeach
                            </div>
                        </div>
                       
                        @if ($errors->any())
                        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>

                            $(document).ready(function() {
                                $('#errorModal').modal('show');
                            });
                        </script>
                        <script>
                            function showFilename() {
                                var input = document.getElementById('file');
                                var output = document.getElementById('filename');
                                output.textContent = input.files[0].name;
                            }
                            </script>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
