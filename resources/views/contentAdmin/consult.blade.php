
@extends('layoutsAdmin.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Konsultasi</h4>
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
                        <a href="/Konsultasi/berita/HistoryBerita">Daftar Konsultasi Konsultasi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Data Konsultasi</h4>
                                
                            </div>                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Konsultasi</th>
                                            <th>Status</th>
                                            @if ($isAdmin == 1 || $isAdmin == 3)
                                            <th>Assign To</th>
                                            
                                            @else
                                            @endif

                                            <th>Dibuat Pada</th>
                                            
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($consult as $key => $item )
                                        <tr>
                                            <td>{{$consult->firstItem()+$key}}.</td>
                                            <td>{{$item->roomID}}</td>
                                            <th>
                                                @if($item->status == 0)
                                                <span class="badge bg-info">Menunggu Balasan</sp>
                                                @elseif ($item->status == 1)
                                                <span class="badge bg-success">Konsultasi Selesai</sp>
                                                @else
                                                <span class="badge bg-info">Menunggu Balasan</sp>
                                                @endif                                            
                                            </th>
                                            @if ($isAdmin == 1 || $isAdmin == 3)
                                            <th>
                                                <form action="{{ route('updateStatus', $item->id) }}" method="POST">
                                                    @csrf
                                                <select name="assign">
                                                    <option value="">Choose One</option>
                                                    @foreach ($listAdmin as $st)
                                                    <option value="{{ $st->id }}" @if ($st->id == $item->id_admin) selected @endif>{{ $st->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($item->id_admin)
                                                    <button type="submit" class="btn btn-xs bg-warning" hidden> 
                                                        Save Changes
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-xs bg-warning"> 
                                                        Save Changes
                                                    </button>
                                                @endif
                                            </form>
                                            </th>    
                                            @else

                                            @endif
                                            
                                            <th>{{$item->created_at}}</th>
                                            <td>
                                                <div class="form-button-action">
                                                    <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Berita" href="{{url('/konsultasi_online/daftar_konsultasi/konsultasi_detail',$item->roomID)}}" >
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-left">
                                    Showing {{ $consult->firstItem() }}
                                    to {{ $consult->lastItem() }}
                                    of {{ $consult->total() }}
                                    data
                                </div>
                                <div class="pull-right">
                                    {{ $consult->links('pagination::simple-bootstrap-5') }}
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
