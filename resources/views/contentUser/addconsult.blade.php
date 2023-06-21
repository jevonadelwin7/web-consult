
@extends('layoutsUser.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Konsultasi</h4>
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
                            <div class="card-title">Data Pemohon</div>
                        </div>
                        <div class="card-body">
                            <div class="row d-block">
                                <form method="post" action="{{route('addConsult')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @foreach ($userData as $key => $item )
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">ID</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$id_room}}" name="idroom" readonly>
                                        </div>
                                    </div>
                                    @if ($item->is_admin == '2')
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">NIP</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->nip}}" name="nip" readonly>
                                        </div>
                                    </div>
                                    @else
                                    @endif
                                    
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Nama Pemohon</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->name}}" name="name" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">No.HP</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->phone}}" name="phone" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" value="{{$item->email}}" name="email" readonly>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Instansi</label>
                                        <div class="col-md-9 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput" name="instansi">
                                        </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">Pertanyaan</label>
                                        <div class="col-md-9 p-0">
                                            <textarea type="text" class="form-control input-full" rows="7" id="inlineinput" name="pertanyaan">{{ old('pertanyaan') }}</textarea>
                                            </div>
                                    </div>
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label">File</label>
                                        <div class="col-md-9 p-0">
                                            <input type="file" class="form-control-file input-full" id="inlineinput" name="file">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    
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
