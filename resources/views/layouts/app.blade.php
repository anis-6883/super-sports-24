<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ get_option('site_title') }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ get_icon() }}" type="image/x-icon"/>
	<!-- Fonts and icons -->
	<script src="{{ asset('public/backend/plugins/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('public/backend/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!-- DataTables -->
	<link href="{{ asset('public/backend/plugins/datatables/dataTables.bootstrap4.min.css') }}"/>
	<link href="{{ asset('public/backend/plugins/datatables/buttons.bootstrap4.min.css') }}"/>
	<!-- Responsive datatable examples -->
	<link href="{{ asset('public/backend/plugins/datatables/responsive.bootstrap4.min.css') }}"/>
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('public/backend/css/fonts.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap/bootstrap-iconpicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/select2/select2.css') }}">
	<!-- Toastr -->
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/toastr/toastr.css') }}">
	<!-- Dropify -->
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/dropify/dropify.min.css') }}">
	<!-- datepicker -->
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap-datepicker/css/datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/summernote/summernote-bs4.min.css') }}">
	<!-- Template Css -->
	<link rel="stylesheet" href="{{ asset('public/backend/css/atlantis.css') }}">
	<link rel="stylesheet" href="{{ asset('public/backend/css/style.css') }}">
	<style>
        .logo-header, .navbar-header, .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a, .sidebar.sidebar-style-2 .nav.nav-primary > .nav-item.active > a, .btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:disabled, .pace .pace-progress, .page-item.active .page-link, .nav-pills.nav-primary .nav-link.active{
            background: linear-gradient(135deg, #126e51 0%, #126e51 100%) !important;
            border-color: #126e51 !important;
        }
        .form-check [type="checkbox"]:not(:checked) + .form-check-sign:after, .form-check [type="checkbox"]:checked + .form-check-sign:after, .form-check [type="checkbox"] + .form-check-sign:after{
        	color: #126e51;
        }
	</style>
	@yield('css-stylesheet')
	@include('layouts.others.variables')
</head>
<body>
	<!-- Preloader area start -->
	<div id="preloader"></div>
	<!-- Preloader area end -->
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" color="blue">

				<a href="{{ url('dashboard') }}" class="logo m-auto text-white" style="font-size: 24px;">
					<b>{{ get_option('company_name') }}</b>
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
			<nav class="navbar navbar-header navbar-expand-lg" color="blue2">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset(user()->image) }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset(user()->image) }}" alt="{{ _lang('image profile') }}" class="avatar-img rounded"></div>
											<div class="u-text pt-2">
												<h4>{{ user()->name }}</h4>
												<p class="text-muted">{{ user()->email }}</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item ajax-modal" href="{{ url('profile/show') }}" data-title="{{ _lang('Profile Details') }}">{{ _lang('My Profile') }}</a>
										<a class="dropdown-item ajax-modal" href="{{ url('profile/edit') }}" data-title="{{ _lang('Edit Profile') }}">{{ _lang('Edit Profile') }}</a>
										<a class="dropdown-item ajax-modal" href="{{ url('password/change') }}" data-title="{{ _lang('Change Password') }}">{{ _lang('Change Password') }}</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ url('logout') }}">{{ _lang('Logout') }}</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset(user()->image) }}" alt="{{ _lang('image profile') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ user()->name }}
									<span class="user-level">{{ _lang('Active Now') }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{ url('profile/show') }}" class="ajax-modal" data-title="{{ _lang('Profile Details') }}">
											<span class="link-collapse">{{ _lang('Profile Details') }}</span>
										</a>
									</li>
									<li>
										<a href="{{ url('profile/edit') }}" class="ajax-modal" data-title="{{ _lang('Edit Profile') }}">
											<span class="link-collapse">{{ _lang('Edit Profile') }}</span>
										</a>
									</li>
									<li>
										<a href="{{ url('password/change') }}" class="ajax-modal" data-title="{{ _lang('Change Password') }}">
											<span class="link-collapse">{{ _lang('Change Password') }}</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a data-toggle="collapse" href="#live_control">
								<i class="fas fa-desktop"></i>
								<p>{{ _lang('Live Control') }}</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="live_control">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ url('sports_types') }}">
											<span class="sub-item">{{ _lang('Sports Types') }}</span>
										</a>
									</li>
									<li>
										<a href="{{ url('live_matches') }}">
											<span class="sub-item">{{ _lang('Manage Live') }}</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="{{ url('popular_series') }}" aria-expanded="false">
								<i class="fas fa-file-video"></i>
								<p>{{ _lang('Popular Series') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('highlights') }}" aria-expanded="false">
								<i class="fas fa-file-video"></i>
								<p>{{ _lang('Highlights') }}</p>
							</a>
						</li>
						
						<li class="nav-item">
                            <a href="{{ url('fixures') }}" aria-expanded="false">
                                <i class="fas fa-file-video"></i>
                                <p>{{ _lang('Fixures') }}</p> 
                            </a>
                        </li>
						
						<li class="nav-item">
							<a href="{{ url('apps') }}" aria-expanded="false">
								<i class="fab fa-app-store-ios"></i>
								<p>{{ _lang('Apps') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('manage_app') }}" aria-expanded="false">
								<i class="fab fa-google-play"></i>
								<p>{{ _lang('Manage App') }}</p>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="{{ url('notifications') }}" aria-expanded="false">
								<i class="fas fa-bell"></i>
								<p>{{ _lang('Notifications') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('promotions') }}" aria-expanded="false">
								<i class="fas fa-bullhorn"></i>
								<p>{{ _lang('Promotions') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('users') }}" aria-expanded="false">
								<i class="fas fa-user"></i>
								<p>{{ _lang('Manage Users') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('subscriptions') }}" aria-expanded="false">
								<i class="fas fa-dice-four"></i>
								<p>{{ _lang('Subscriptions') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('payments') }}" aria-expanded="false">
								<i class="fas fa-dollar-sign"></i>
								<p>{{ _lang('Payments') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('cache_clear') }}" aria-expanded="false">
								<i class="fas fa-trash"></i>
								<p>{{ _lang('Cache Clean') }}</p>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#administration">
								<i class="fas fa-cogs"></i>
								<p>{{ _lang('Administration') }}</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="administration">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ url('general_settings') }}">
											<span class="sub-item">{{ _lang('General Settings') }}</span>
										</a>
									</li>
									<li>
										<a href="{{ url('database_backup') }}">
											<span class="sub-item">{{ _lang('Database Backup') }}</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					@if(! Request::is('dashboard'))
					<div class="page-header">
						<h4 class="page-title">{{ _lang('Dashboard') }}</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="{{ url('dashboard') }}">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							@php
							$segments = '';
							@endphp
							@foreach(Request::segments() as $segment)
							@php
							if (is_numeric($segment))
								continue;
							$segments .= '/' . $segment;
							@endphp
							<li class="breadcrumb-item active" aria-current="page">
								<a href="{{ url($segments) }}">
									{{ ucwords(str_replace('_', ' ', $segment)) }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					@endif
					@yield('content')
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="#">
									&copy; {{ get_option('company_name') }}.
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						Made with <i class="fa fa-heart heart text-danger"></i> by <a href="#">RootDevs</a>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<div id="main_modal" class="modal fade" role="dialog" data-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="col-md-12">
					<div class="alert alert-danger" style="display:none; margin: 15px;"></div>
					<div class="alert alert-success" style="display:none; margin: 15px;"></div>
				</div>
				<div class="modal-body"></div>
			</div>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('public/backend/plugins/bootstrap/popper.min.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/bootstrap/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/bootstrap/bootstrap-iconpicker.bundle.min.js') }}"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('public/backend/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<!-- jQuery Scrollbar -->
	<script src="{{ asset('public/backend/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<!-- Bootstrap Notify -->
	<script src="{{ asset('public/backend/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<!-- Sweet Alert -->
	<script src="{{ asset('public/backend/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('public/backend/plugins/select2/select2.js') }}"></script>
	<script src="{{ asset('public/backend/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('public/backend/js/print.js') }}"></script>
	<!-- Toastr -->
	<script src="{{ asset('public/backend/plugins/toastr/toastr.js') }}"></script>
	<!-- Dropify  -->
	<script src="{{ asset('public/backend/plugins/dropify/dropify.min.js') }}"></script>
	<!-- Dropify  -->
	<script src="{{ asset('public/backend/js/pace.min.js') }}"></script>
	<!-- Required datatable js -->
	<script src="{{ asset('public/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Responsive datatable -->
	<script src="{{ asset('public/backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
	<!-- Atlantis JS -->
	<script src="{{ asset('public/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/flatpickr/flatpickr.js') }}"></script>
	<script src="{{ asset('public/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- Atlantis JS -->
	<script src="{{ asset('public/backend/js/atlantis.js') }}"></script>
	<script src="{{ asset('public/backend/js/app.js') }}"></script>
	<!-- Dashboard JS -->
	@if(Request::is('dashboardw'))
	<script src="{{ asset('public/backend/js/dashboard.js') }}"></script>
	@endif
	<script>
		@if( ! Request::is('dashboard'))
		$(".page-title").text($(".card-title").first().text());
		$('title').append(' | ' + $(".card-title").first().text());
		@else
		$('title').append(' | ' . $lang_dashboard);
		@endif

		@if(Session::has('success'))
		toast('success', '{{ session('success') }}');
		@endif
		@if(Session::has('error'))
		toast('error', '{{ session('error') }}');
		@endif
		@foreach ($errors->all() as $error)
		toast('error', '{{ $error }}');
		@endforeach
	</script>
	@yield('js-script')
</body>
</html>
