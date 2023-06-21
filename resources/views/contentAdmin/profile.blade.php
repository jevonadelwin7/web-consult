
@extends('layoutsAdmin.template')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Profile</h4>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('{{asset('adminfrontend')}}/assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl">
                                    <img src="{{asset('adminfrontend')}}/assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="user-profile text-center">
                                <div class="name">{{$dataUser->name}}</div>
                                <div class="job">{{$dataUser->email}}</div>
                                {{-- <div class="desc">A man who hates loneliness</div> --}}
                                {{-- <div class="social-media">
                                    <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"> 
                                        <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span> 
                                    </a>
                                    <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span> 
                                    </a>
                                    <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                                        <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span> 
                                    </a>
                                </div> --}}
                                {{-- <div class="view-profile">
                                    <a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
                                </div> --}}
                            </div>
                           
                        </div>
                        <div class="card-footer">
                            <div class="row user-stats text-center">
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label">Nama</label>
                                    <div class="col-md-9 p-0">
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$dataUser->name}}" >
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
                                    <div class="col-md-9 p-0">
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$dataUser->email}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-3 col-form-label">No. HP/WA</label>
                                    <div class="col-md-9 p-0">
                                        <input type="text" class="form-control input-full" id="inlineinput" value="{{$dataUser->phone}}" >
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
