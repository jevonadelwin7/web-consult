<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin Panel</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('adminfrontend')}}/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('adminfrontend')}}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('adminfrontend')}}/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('adminfrontend')}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('adminfrontend')}}/assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('adminfrontend')}}/assets/css/demo.css">
</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v16.0&appId=716340866174826&autoLogAppEvents=1" nonce="nbvD4guz"></script>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo">
					{{-- <img src="{{asset('adminfrontend')}}/assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> --}}
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					{{-- <div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div> --}}
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>

						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{asset('adminfrontend')}}/assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">	
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{asset('adminfrontend')}}/assets/img/profile.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{$user}}</h4>
												{{-- <p class="text-muted">hello@example.com</p> --}}
												<a href="/admin/profile" class="btn btn-xs btn-secondary btn-sm">Lihat Profile</a>
											</div>
										</div>
									</li>
									<li>
										{{-- <div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div> --}}
										{{-- <a class="dropdown-item" href="#">Setting Akun</a> --}}
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{asset('adminfrontend')}}/assets/img/profile.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{$user}}
									<span class="user-level">
										@if ($isAdmin === 1 )
										Administrator
										@elseif ($isAdmin === 4)
										Irban
										@elseif ($isAdmin === 3)
										Verifikator
										@endif
									</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							{{-- <div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div> --}}
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item {{ request()->is('admin/home')? 'active':''}}">
							<a href="/admin/home">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						{{-- <li class="nav-item {{ request()->is('admin/banner')? 'active':''}}">
							<a data-toggle="collapse" href="#base">
								<i class="
								fas fa-home"></i>
								<p>Home</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/banner">
											<span class="sub-item">Banner</span>
										</a>
									</li>
									<li>
										<a href="/admin/pegawai">
											<span class="sub-item">Daftar Pegawai</span>
										</a>
									</li>
									<li>
										<a href="/admin/gallery">
											<span class="sub-item">Gallery Foto</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						<li class="nav-item {{ request()->is('admin/berita/daftarBerita','admin/berita/buatBerita')? 'active submenu':''}}">
							<a data-toggle="collapse" href="#news">
								<i class="
								fas fa-newspaper"></i>
								<p>Berita</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="news">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/berita/daftarBerita">
											<span class="sub-item">Daftar Berita</span>
										</a>
									</li>
									<li>
										<a href="/admin/berita/buatBerita">
											<span class="sub-item">Buat Berita</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item {{ request()->is('admin/profilweb')? 'active':''}}">
							<a href="/admin/profilweb">
								<i class="far fa-address-book"></i>
								<p>Profil</p>
							</a>
						</li>
						<li class="nav-item {{ request()->is('admin/ppid')? 'active':''}}">
							<a href="/admin/ppid">
								<i class="fas fa-info-circle"></i>
								<p>PPID</p>
							</a>
						</li>--}}
						<li class="nav-item {{ request()->is('surat_bebas_temuan_pemeriksaan','surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin')? 'active':''}}">
							<a data-toggle="collapse" href="#surat">
								<i class="
								fas fa-newspaper"></i>
								<p>Layanan Administrasi</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="surat">
								<ul class="nav nav-collapse">
									<li>
										<a href="/surat_bebas_temuan_pemeriksaan">
											<span class="sub-item">Surat Bebas Temuan Pemeriksaan</span>
										</a>
									</li>
									<li>
										<a href="/surat_keterangan_tidak_pernah_dijatuhi_hukuman_disiplin">
											<span class="sub-item">Surat Keterangan Tidak Pernah Dijatuhi Hukuman Disiplin</span>
										</a>
									</li>
								</ul>
							</div>
						</li> 
						<li class="nav-item {{ request()->is('konsultasi_online/daftar_konsultasi','konsultasi_online/daftar_pengaduan','konsultasi_online/daftar_pengaduan/detail_aduan/*')? 'active':''}}">
							<a data-toggle="collapse" href="#rules">
								<i class="
								fas fa-newspaper"></i>
								<p>Konsultasi Online</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="rules">
								<ul class="nav nav-collapse">
									<li>
										<a href="/konsultasi_online/daftar_konsultasi">
											<span class="sub-item">Daftar Konsultasi</span>
										</a>
									</li>
									<li>
										<a href="/konsultasi_online/daftar_pengaduan">
											<span class="sub-item">Daftar Pengaduan</span>
										</a>
									</li>
								</ul>
							</div>
						</li> 
						<li class="nav-item {{ request()->is('admin/dataAdmin')? 'active':''}}">
							<a data-toggle="collapse" href="#adm">
								<i class="
								fas fa-cog"></i>
								<p>Pengaturan Admin</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="adm">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/dataAdmin">
											<span class="sub-item">Data Admin</span>
										</a>
									</li>
									{{-- <li>
										<a href="/register">
											<span class="sub-item">Tambah Admin</span>
										</a>
									</li> --}}
								</ul>
							</div>
						</li>
						
						
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->