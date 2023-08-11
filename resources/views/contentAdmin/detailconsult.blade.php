
@extends('layoutsAdmin.template')

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
                        <a href="/admin/Konsultasi">Detail Konsultasi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                                <div class="col-md-6 col-lg-8">
                                    
                                    <div class="form-group form-inline">
                                        <label for="inlineinput" class="col-md-3 col-form-label ml-auto">Data User</label>
                                        <div class="col-md-9 p-0">
                                           
                                            <a type="button" class="btn btn-primary  btn-xs text-white" data-toggle="modal" data-target="#exampleModal">
                                                Lihat Data User
                                            </a>

                                        </div>
                                    </div>
                                    
                                </div>              
                            @endforeach

                                {{-- <h4 class="page-title">Chat </h4> --}}
                                
					<div class="row">
                        <hr></hr>
						<div class="col-md-12">
							
							<ul class="timeline">
                                @foreach ($chat as $key => $item )
								<li class="@if ($firstID  != $item->UserID    )    
                                    timeline-inverted 
                                @else
                               
                                @endif">
									<div class="timeline-badge"><i class="flaticon-message"></i></div>
									<div class="timeline-panel 
                                @if ( $firstID != $item->UserID )    
                                bg-primary text-white 
                                @else
                                
                                @endif
                                    ">
										<div class="timeline-heading">

											<h4 class="timeline-title">
                                                @if ($firstID == $item->UserID )
                                                User
                                                @else
                                                Admin
                                                @endif
                                            </h4>
											<p><small class="text-dark"><i class="flaticon-message"></i>{{$item->created_at}}</small></p>
										</div>
										<div class="timeline-body">
											
                                            @if ($isadmin=='4' and $item->status=='2')
                                            <form method="post" action="{{route('updateComment', $item->id)}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="form-group">        
                                                    <input class="form-control"  name="idroom" rows="5" style="border:solid 1px orange" value="{{$roomID}}" hidden>
                                                </div>
                                            <div class="form-group">
                                                
                                                <textarea class="form-control" id="comment" name="comment" rows="5" style="border:solid 1px orange">
                                                    {{$item->message}}
                                                </textarea>
                                            </div>
                                            <div class="card-action">
                                                <button  type="submit" class="btn btn-success">Kirim</button>
                                                {{-- <button class="btn btn-danger">Cancel</button> --}}
                                            </div>
                                            </form>
                                            @else
                                            <p>{{$item->message}}</p>
                                            @if ($item->consult_file == NULL)
                                                
                                            @else
                                            <a href="/adminfrontend/consultfile/{{$item->consult_file}}" target="_blank" class="text-center bg-white">Download File</a>
                                            @endif
                                            
                                            @endif
										</div>
                                       <hr>
                                        <div class="">
                                            @if ($isadmin=='4' and $item->status=='0')
                                            Menunggu Konfirmasi dari Super Admin
                                            @else
                                            @endif
                                            

                                        </div>
                                        <div class="button mt-2 d-block">
                                            @if ($isadmin=='1' and $item->status==='0')
                                            <form action="{{ route('updateMessage', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">        
                                                    <input class="form-control"  name="idroom" rows="5" style="border:solid 1px orange" value="{{$roomID}}" hidden>
                                                </div>
                                            <button type="submit" name="status" value="1" class="text-white btn btn-primary btn-sm">Tampilkan</a>
                                            <button type="submit" name="status" value="2" class="ml-2 text-white btn btn-warning btn-sm">Revisi</a>
                                            </form>
                                            
                                            @elseif ($isadmin=='1' and $item->status=='2')
                                            Menunggu Revisi Jawaban
                                                
                                            @elseif ($isadmin=='4' and $item->status=='1')
                                             Jawaban telah tampil
                                            @endif

                                           
                                        </div>
                                        
									</div>
                                    
								</li>
                                @endforeach
                                
								{{-- <li class="timeline-inverted ">
									<div class="timeline-badge warning"><i class="flaticon-alarm-1"></i></div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Mussum ipsum cacilds</h4>
                                            <p><small class="text-muted"><i class="flaticon-message"></i> 11 hours ago via Twitter</small></p>
										</div>
										<div class="timeline-body">
											<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
										</div>
									</div>
								</li> --}}
							</ul>
                            <form method="post" action="{{route('addMessage')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">        
                                    <input class="form-control"  name="idroom" rows="5" style="border:solid 1px orange" value="{{$roomID}}" hidden>
                                </div>
                            <div class="form-group">
                                <label for="comment">Berikan Tanggapan</label>
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
					</div>

                            
                            </div>
                        </div>
                        
                    </div>
                </div>
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

        
    @endsection
