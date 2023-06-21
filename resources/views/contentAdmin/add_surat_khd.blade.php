
@extends('layoutsAdmin.template')

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
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="{{$item->name}}" readonly>
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
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi" value="{{$item->phone}}" readonly>
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
                                    @if ($sktp == 0)
                                    feed-item-warning
                                    @else
                                    feed-item-success
                                    @endif
                                    ">
                                        <time class="date" datetime="9-25"></time>
                                        <span class="text">Melengkapi Berkas</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sktp == 1)
                                    feed-item-warning
                                    @elseif ($sktp < 1)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-24"></time>
                                        <span class="text">Validasi Data</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sktp == 2)
                                    feed-item-warning
                                    @elseif ($sktp < 2)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-23"></time>
                                        <span class="text">Revisi Data</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sktp == 3)
                                    feed-item-warning
                                    @elseif ($sktp < 3)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-21"></time>
                                        <span class="text">Verifikasi EVLAP</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sktp == 4)
                                    feed-item-warning
                                    @elseif ($sktp < 4)
                                    feed-item-info
                                    @else
                                    feed-item-success
                                    @endif">
                                        <time class="date" datetime="9-18"></time>
                                        <span class="text">Disetujui</span>
                                    </li>
                                    <li class="feed-item 
                                    @if ($sktp == 5)
                                    feed-item-success
                                    @elseif ($sktp < 5)
                                    feed-item-info
                                    @elseif ($sktp > 5)
                                    feed-item-info
                                    @else
                                    
                                    @endif">
                                        <time class="date" datetime="9-18"></time>
                                        <span class="text">Surat Bebas temuan terbit</span>
                                    </li>
                                    
                                    @if ($sktp == 6)
                                    <li class="feed-item feed-item-danger"><time class="date" datetime="9-18"></time>
                                        <span class="text">Permohonan tidak dapat dilanjutkan</span>
                                    </li>                                   
                                    @endif
                                </ol>
                                <div class="dot-mean">
                                    <a><i class="fas fa-circle text-info"></i> Belum Diproses</a>
                                    <a><i class="fas fa-circle text-warning"></i> Dalam Proses </a>
                                    <a><i class="fas fa-circle text-success"></i> Proses selesai </a>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">E-Form</div>
                        </div>
                        <div class="card-body">
                            
                                
                                @foreach ($dt as $key => $item )
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Berkas</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Lihat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>SK Pangkat Terakhir</td>
                                            <td>@if($item->sk_pangkat == NULL)
                                                <p><i class="fas fa-window-close fa-2x" style="color:red"></i></p>
                                                @else
                                                <p><i class="fas fa-check-square fa-2x" style="color:green"></i></p>
                                                                
                                                @endif</td>
                                            <td>
                                                @if($item->sk_pangkat == NULL)
                                                <a>Data Belum Diupload</a>
                                                @else
                                                <a type="button" class="btn btn-xs btn-primary" href="{{url('adminfrontend/sbt_file/',$item->sk_pangkat)}}" target="_blank"> Lihat</a>                       
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SK Tidak pernah dijatuhi hukuman sedang/berat</td>
                                            <td>@if($item->sp_hukuman_disiplin == NULL)
                                                <p><i class="fas fa-window-close fa-2x" style="color:red"></i></p>
                                                @else
                                                <p><i class="fas fa-check-square fa-2x" style="color:green"></i></p>
                                                                
                                                @endif</td>
                                            <td>
                                                @if($item->sp_hukuman_disiplin == NULL)
                                                <a>Data Belum Diupload</a>
                                                @else
                                                <a type="button" class="btn btn-xs btn-primary" href="{{url('adminfrontend/sbt_file/',$item->sp_hukuman_disiplin)}}" target="_blank"> Lihat</a>                       
                                                @endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <form method="post" action="{{route('updateMessageSKTP', $item->id)}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">        
                                        <input class="form-control"  name="id_permohonan" rows="5" style="border:solid 1px orange" value="{{$item->id_permohonan}}" hidden>
                                    </div>
                                <div class="form-group">
                                    <label for="comment">Catatan</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="5" style="border:solid 1px orange" >{{$item->message}}</textarea>
                                </div>
                                <span style="color:red">* Jika Dokumen telah sesuai, dapat mengosongkan catatan revisi dan memilih tombol "Berkas lengkap"</span> <br>
                                <span style="color:red">* Jika permohonan tidak dapat dilanjutkan dapat mengisi catatan dan memilih tombol "Permohonan tidak dapat dilanjutkan" </span>
                                <div class="card-action">
                                    <button  type="submit"  name="status" value="2" class="btn btn-warning">Kirim Catatan</button>
                                    <button  type="submit"  name="status" value="3" class="btn btn-success">Berkas Lengkap</button>
                                    <button  type="submit"  name="status" value="4" class="btn btn-info">Verifikasi EVLAP</button>
                                    <button  type="submit"  name="status" value="6" class="btn btn-danger">Permohonan tidak dapat dilanjutkan</button>
                                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                                </div>
                                </form>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">PERMOHONAN SURAT KETERANGAN TIDAK PERNAH DIJATUHI HUKUMAN DISIPLIN TINGKAT SEDANG/BERAT</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('create_surat_sbt')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                            
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control" id="defaultInput" value='{{$item->id}}' name="id_permohonan_detail" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control" id="defaultInput" value="{{$item->id_permohonan}}" name="id_permohonan" hidden>
                                                </div>
                                            <div class="form-group">
                                                <label for="largeInput">Nomor Surat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="nomor_surat">
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="largeInput">Nama Pejabat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="nama_pejabat">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">NIP Pejabat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="nip_pejabat">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Pangkat/Gol Pejabat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="pang_gol_pejabat">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Jabatan Pejabat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_pejabat">
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="largeInput">Nama Pemohon</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="nama_pemohon">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">NIP Pemohon</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="nip_pemohon">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Pangkat/Gol Pemohon</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="pang_gol_pemohon">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Jabatan Pemohon</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_pemohon">
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Unit Kerja Pemohon</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="unit_kerja_pemohon">
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="largeInput">Tempat & Tanggal Surat</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="tanggal_surat">
                                            <span class="text-xs font-italic"> * Tuapejat, 06 Desember  2022 </span>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Jabatan Penandatangan</label>
                                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_ttd">
                                            </div>
    
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="tipe"  value="sktp" class="btn btn-primary">Tambah Data</button>
                                        </div>
                                            </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                            <div class="card-title">Surat Bebas Temuan</div>
                            <div class="buttonMODAL">
                                @if ($surat->isEmpty() && $sktp >=4)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    Buat Surat Bebas Temuan
                                </button>
                                @elseif ($sktp < 4)
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" disabled>
                                    Buat Surat Bebas Temuan
                                </button>
                                @else
                                <a type="button" class="btn btn-danger" href="http://127.0.0.1:8000/surat_bebas_temuan_pemeriksaan/{{$suratid}}" target="_blank">
                                 <i class="fas fa-print" ></i>   Preview
                                </a>
                                @endif
                                
                                 
                            </div>  
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($surat as $key => $item )
                            <form method="post" action="{{route('updateSKTP', $item->id)}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            
                                <div class="form-group">
                                    <input type="text" class="form-control form-control" id="defaultInput" value='{{$item->id}}' name="id_permohonan_detail" hidden>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control" id="defaultInput" value="{{$item->id_permohonan}}" name="id_permohonan" hidden>
                                </div>
                            <div class="form-group">
                                <label for="largeInput">Nomor Surat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="nomor_surat"  value="{{$item->nomor_surat}}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="largeInput">Nama Pejabat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="nama_pejabat" value="{{$item->nama_pejabat}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">NIP Pejabat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="nip_pejabat" value="{{$item->nip_pejabat}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pangkat/Gol Pejabat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="pang_gol_pejabat" value="{{$item->pang_gol_pejabat}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jabatan Pejabat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_pejabat" value="{{$item->jabatan_pejabat}}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="largeInput">Nama Pemohon</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="nama_pemohon" value="{{$item->nama_pemohon}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">NIP Pemohon</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="nip_pemohon" value="{{$item->nip_pemohon}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Pangkat/Gol Pemohon</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="pang_gol_pemohon" value="{{$item->pang_gol_pemohon}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jabatan Pemohon</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_pemohon" value="{{$item->jabatan_pemohon}}">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Unit Kerja Pemohon</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="unit_kerja_pemohon" value="{{$item->unit_kerja_pemohon}}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="largeInput">Tempat & Tanggal Surat</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="tanggal_surat" value="{{$item->tanggal_surat}}">
                            <span class="text-xs font-italic"> * Tuapejat, 06 Desember  2022 </span>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Jabatan Penandatangan</label>
                                <input type="text" class="form-control form-control" id="defaultInput" name="jabatan_ttd" value="{{$item->jabatan_ttd}}">
                            </div>
                            <div class="card-footer">
                                
                                <button type="submit" name="ttd" value="0"  class="btn btn-primary">update Data</button>
                                <button type="submit" name="ttd" value="1" class="btn btn-info">Tandatangan</button>
                            
                                </div>
                            </form>
                            
                            @endforeach
                            
                        </div>
                </div>
            
        </div>
    </div>

    @endsection
