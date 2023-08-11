
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">History Pengaduan</h4>
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
                        <a>History Pengaduan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Data Pengaduan</h4>
                                <div class="buttonMODAL">
                                    <a type="button" class="btn btn-primary"  href="/konsultasi_pengaduan/pengaduan/buat_aduan">
                                        Buat Aduan
                                    </a>
                                </div>  
                            </div>                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pengaduan</th>
                                            <th>Status</th>
                                            <th>Dibuat Pada</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aduan as $key => $item )
                                        <tr>
                                            <td>{{$aduan->firstItem()+$key}}.</td>
                                            <td>{{$item->roomID}}</td>
                                            <th>
                                                @if($item->status == 0)
                                                <span class="badge bg-info text-white">Menunggu Balasan</sp>
                                                @elseif ($item->status == 1)
                                                <span class="badge bg-success text-white">Konsultasi Selesai</sp>
                                                @else
                                                <span class="badge bg-info text-white">Menunggu Balasan</sp>
                                                @endif                                            
                                            </th>
                                            <th>{{$item->created_at}}</th>
                                            <td>
                                                <div class="form-button-action">
                                                    <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Lihat Detail" href="{{url('/konsultasi_pengaduan/pengaduan/pengaduan_detail',$item->roomID)}}" >
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-left">
                                    Showing {{ $aduan->firstItem() }}
                                    to {{ $aduan->lastItem() }}
                                    of {{ $aduan->total() }}
                                    data
                                </div>
                                <div class="pull-right">
                                    {{ $aduan->links('pagination::simple-bootstrap-5') }}
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
