
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Surat Keterangan Tidak Pernah Dijatuhi Hukuman Disiplin</h4>
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
                        <a>Layanan Administrasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/Konsultasi/berita/HistoryBerita">Surat Keterangan Tidak Pernah Dijatuhi Hukuman Disiplin</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">History Pemohon</h4>
                                <div class="buttonMODAL">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Permohonan Baru
                                    </button>
                                </div>  
                            </div>                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Permohonan</th>
                                            <th>Pemohon</th>
                                            <th>Tujuan</th>
                                            <th>Waktu Permohonan</th>
                                            <th>Status</th>
                                            <th>Download Surat</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sk as $key => $item )
                                        <tr>
                                            <td>{{$sk->firstItem()+$key}}.</td>
                                            <th>SKTP0{{$item->id}}</th>
                                            <th>{{$item->pemohon}}</th>
                                            <th>{{$item->tujuan}}</th>
                                            <th>{{$item->created_at}}</th>

                                            <th>
                                                @if($item->status == 0)
                                                <span class="badge bg-info text-white">Melengkapi Berkas</sp>
                                                @elseif ($item->status == 1)
                                                <span class="badge bg-warning text-white">Validasi Data</sp>
                                                @elseif ($item->status == 2)
                                                <span class="badge bg-primary text-white">Revisi Data</sp>
                                                @elseif ($item->status == 3)
                                                <span class="badge bg-primary text-white">Verifikasi EVLAP</sp>
                                                @elseif ($item->status == 4)
                                                <span class="badge bg-success text-white">Disetujui</sp>
                                                @elseif ($item->status == 5)
                                                <span class="badge bg-success text-white">Surat Bebas temuan terbit</sp>
                                                @elseif ($item->status == 6)
                                                    <span class="badge bg-danger text-white">Permohonan tidak dapat dilanjutkan</sp>
                                                @endif                                                 
                                            </th>
                                            <th>
                                                @if($item->status == 5)
                                                <a href="/surat/{{$item->file_name}}" target="_blank" class="text-center"> <i class="fas fa-cloud-download-alt fa-2x" ></i> </a>
                                                @endif
                                            </th>
                                            <td>
                                                <div class="form-button-action">
                                                    <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg " data-original-title="Lihat Berkas" href="{{url('/layanan_administrasi/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin/permohonan_baru',$item->id)}}" >
                                                       <i class="far fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                                       <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Permohonan Surat Keterangan Tidak Pernah Dijatuhi Hukuman Disiplin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('add_sktp_request')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                       
                                        <div class="form-group">
                                            <label for="largeInput">Tujuan Permohonan</label>
                                            <input type="text" class="form-control form-control" id="defaultInput" name="tujuan">
                                            <span>*contoh : Kenaikan Gaji Berkala </span>
                                        </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                                    </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    

                                    </tbody>
                                </table>
                                {{-- <div class="pull-left">
                                    Showing {{ $consult->firstItem() }}
                                    to {{ $consult->lastItem() }}
                                    of {{ $consult->total() }}
                                    data
                                </div>
                                <div class="pull-right">
                                    {{ $consult->links('pagination::simple-bootstrap-5') }}
                                </div>                             --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
       </script>

    @endsection
