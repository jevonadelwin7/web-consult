
@extends('layoutsAdmin.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Daftar Admin</h4>
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
                        <a>Admin</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/berita/daftarBerita">Daftar Admin</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Data Admin</h4>
                                <div class="buttonMODAL">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Tambah Data
                                    </button>
                                </div>  
                            </div>                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>N0</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Dibuat Pada</th>
                                            <th>Diupdate Pada</th>
                                            {{-- <th style="width: 10%">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin as $key => $item )
                                        <tr>
                                            <td>{{$admin->firstItem()+$key}}.</td>
                                            <td>{{$item->name}}</td>
                                            <th>{{$item->email}}</th>
                                            <th>
                                                @if($item->is_admin == 1)
                                                SuperAdmin
                                                @elseif ($item->is_admin == 3)
                                                Verifikator
                                                @else
                                                Irban
                                                @endif
                                            
                                            </th>
                                            <th>{{$item->created_at}}</th>
                                            <td>{{$item->updated_at}}</td>
                                            {{-- <td>
                                                <div class="form-button-action">
                                                    <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Berita" href="{{url('/admin/berita/detailBerita',$item->id)}}" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Hapus" href="{{url('/admin/dataAdmin/deleteAdmin',$item->id)}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{route('addAdmin')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                    
                                    <div class="form-group">
                                        <label for="largeInput">Nama User</label>
                                        <input type="text" class="form-control form-control" id="defaultInput" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="largeInput">Email</label>
                                        <input type="email" class="form-control" id="email2" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="defaultSelect">Role Admin</label>
                                        <select class="form-control form-control" id="defaultSelect" name="role">
                                            <option value="1">SuperAdmin</option>
                                            <option value="3">Verifikator</option>
                                            <option value="4">Irban</option>
                                            <option value="5">EVLAP (Evaluasi & Pelaporan)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" type="password" class="form-control" id="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="repassword">Re-Password</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" >
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
                     <!-- Modal -->
                     
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-left">
                                    Showing {{ $admin->firstItem() }}
                                    to {{ $admin->lastItem() }}
                                    of {{ $admin->total() }}
                                    data
                                </div>
                                <div class="pull-right">
                                    {{ $admin->links('pagination::simple-bootstrap-5') }}
                                </div>
                                
                        
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
