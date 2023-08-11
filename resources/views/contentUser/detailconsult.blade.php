
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
                                                @if ($item->UserID ==  $IDuser)
                                                {{$user}}  
                                                @else
                                                Admin
                                                @endif
                                                </h4>
											<p><small class="text-dark"><i class="flaticon-message"></i>{{$item->created_at}}</small></p>
										</div>
										<div class="timeline-body">
											<p>{{$item->message}}</p>
                                            @if ($item->consult_file == NULL)
                                                
                                            @else
                                            <a href="/adminfrontend/consultfile/{{$item->consult_file}}" target="_blank" class="text-center bg-white">Download File</a>
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
						</div>
					</div>

                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
