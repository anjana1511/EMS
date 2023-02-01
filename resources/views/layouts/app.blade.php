
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />

      <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script> -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
EMS
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
      <link rel="dns-prefetch" href="{{ asset('css/font.css') }}">
    <link href="{{ asset('css/font.css?family=Nunito') }}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <!--     <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.0') }} " rel="stylesheet" />
  
  <link rel="dns-prefetch" href="{{ asset('css/font.css') }}">
    <link href="{{ asset('css/font.css?family=Nunito') }}" rel="stylesheet">

      <script src="{{ asset('js/sweetalert.min.js') }} "></script>
	  
	   <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
<!--	    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="">
  <div class="wrapper ">
  @guest
   @if (Route::has('register'))
    @endif
     @else
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
	
      <div class="logo">
        <a class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{ asset('assets/img/logo-small.png') }}">
          </div>
        </a>
        <a class="simple-text logo-normal">
          EMS
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ route('home') }}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
            <li class="nav-item btn-rotate dropdown">
		                 <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="nc-icon nc-globe"></i>Manage Location
                  
                       </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			                            <a class="dropdown-item" href="{{ route('state') }}">
                                        {{ __('Manage State') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('district') }}">
                                        {{ __('Manage District') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('taluka') }}">
                                        {{ __('Manage Talukas') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('village') }}">
                                        {{ __('Manage village') }}
                                    </a>
          </li>
          <li class="nav-item btn-rotate dropdown">
		                 <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="nc-icon nc-globe"></i>Role & Permission
                  
                       </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			                            <a class="dropdown-item" href="{{ route('permission') }}">
                                        {{ __('Manage Role-Permission') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('assign_role') }}">
                                        {{ __('Assign Role-Permission') }}
                                    </a>
          </li>          		  
		  <li class="nav-item btn-rotate dropdown">
		    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-icon nc-tile-56"></i>System Managment
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			<a class="dropdown-item" href="{{ route('division') }}">
                                        {{ __('Manage Division') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dept') }}">
                                        {{ __('Manage Department') }}
                                    </a>
									
									@if(Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('emp') }}">
                                        {{ __('Manage Employee') }}									
                                    </a>
									@endif
          </li>
          <li class="nav-item btn-rotate dropdown">
		    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-icon nc-tile-56"></i>Payroll Managment
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ route('salary') }}">
                                        {{ __('Manage Salary') }}
                                    </a>
                                   <a class="dropdown-item" href="{{ route('managesalary') }}">
                                        {{ __('Salary details') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('salarylist') }}">
                                        {{ __('Employee salary list') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('Advancepayment') }}">
                                        {{ __('Advance payment') }}
                                    </a>
                                    <a class="dropdown-item" href="">
                                        {{ __('Generate payslip') }}
                                    </a>
                                 
          </li>
          <li class="nav-item btn-rotate dropdown">
		    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-icon nc-tile-56"></i>Project Managment
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			<a class="dropdown-item" href="{{ route('project') }}">
                                        {{ __('Manage Project') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('project_assign') }}">
                                        {{ __('Assign Project') }}
                                    </a>
                                  
          </li>
          
          <li class="nav-item btn-rotate dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-icon nc-tile-56"></i>Leave Managment
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="{{ route('leavetype') }}">
                                        {{ __('Manage Leave Type') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leave') }}">
                                      Leave Apply
                                    </a>
                                    <a class="dropdown-item" href="{{ route('allLeaves') }}">
                                        {{ __('All Leaves') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('ApprovedLeaves') }}">
                                        {{ __('Approved Leaves') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('PendingLeaves') }}">
                                        {{ __('Pending Leaves') }}
                                    </a> 
          </li>
		  <li>
            <a href="{{ route('sendemail') }}">
              <i class="nc-icon nc-bank"></i>
              <p>Mails</p>
            </a>
          </li>
           <li>
            <a href="{{ url('localization/en') }}">
              <i class="nc-icon nc-globe"></i>
              <p>Localization</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
	 @endguest
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
			Welcome {{ Auth::user()->name }}
            <!--<a class="navbar-brand" href="#pablo">Paper Dashboard 2</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
			
            <ul class="navbar-nav">
              
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
				@guest
                  <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
				  @if (Route::has('register'))
                  <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
			   @endif
                 @else
					<a class="dropdown-item" href="{{ route('profile') }}">Profile
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
                  </form>
			    @endguest
                </div>
              </li>
             </ul>
          </div>
        </div>
      </nav>
	              @yield('content')
  <!--   Core JS Files   -->
      <script src="{{ asset('js/jquery.min.js') }} "></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

  <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->

  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.0') }}" type="text/javascript"></script>
  </body>

</html>
