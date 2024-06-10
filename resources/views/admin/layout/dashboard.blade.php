@php
$admin = Auth::guard('admin')->user();
@endphp



<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Feb 2024 21:06:43 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Starter Page | SirJosh - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">
    @include('sweetalert::alert')

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo.svg')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png')}}" alt="" height="17">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-light.svg')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-light.png')}}" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">Sir-Josh</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>

                            <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">@csrf</form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>














        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>
                        <li>
                            <a href="{{ url('/admin/home') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboard">Admin Home</span>
                            </a>
                        </li>

                        <li class="menu-title" key="t-menu">Website Layout and Settings</li>

                        <li>
                            <a href="{{ url('/admin/homeSettings') }}" class="waves-effect">
                                <i class="bx bx-aperture"></i>
                                <span key="t-chat">Home Settings</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-list-ul"></i>
                                <span key="t-dashboards">Pages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li> <a href="javascript: void(0);">
                                        <i class="bx bx-home-circle"></i>
                                        <span key="t-about us">About Us</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ url('/admin/about') }}" key="t-about">
                                                <i class="bx bx-receipt"></i>
                                                <span key="t-about">About</span>
                                            </a>
                                        </li>

                                         <li><a href="{{ url('/admin/education') }}" key="t-education">
                                                <i class="bx bx-receipt"></i>
                                                <span key="t-education">Education</span>
                                            </a>
                                        </li>

                                        <li><a href="{{ url('/admin/experience') }}" key="t-experience">
                                                <i class="bx bx-store"></i>
                                                <span key="t-experience">Experience</span>
                                        </li>
                                        <li><a href="{{ url('/admin/skills') }}" key="t-skills">
                                                <i class="bx bx-file"></i>
                                                <span key="t-skills">Skills</span>
                                            </a>
                                        </li>
                                        <li><a href="{{ url('/admin/tools') }}" key="t-tools">
                                                <i class="bx bx-tone"></i>
                                                <span key="t-tools">Tools</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a href="{{ url('/admin/services') }}" key="t-services">
                                        <i class="bx bx-briefcase-alt-2"></i>
                                        <span key="t-services">Services</span>
                                    </a>
                                </li>
                                <li><a href="javascript: void(0);">
                                        <i class="bx bx-task"></i>
                                        <span>Portfolio</span>
                                    </a>

                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{ url('/admin/projects') }}" key="t-projects">
                                                <i class="bx bx-briefcase-alt"></i>
                                                <Span key="t-project">Projects</Span>
                                            </a>
                                        </li>
                                        <li><a href="{{ url('/admin/testimonials') }}" key="t-testimonial">
                                                <i class="bx bx-chat"></i>
                                                <span key="t-testimonial">Testimonial</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a href="{{ url('/admin/contacts') }}" key="t-contact">
                                        <i class="bx bxs-user-detail"></i>
                                        <span key="t-contact">Contact</span>
                                    </a>
                                </li>

                            </ul>

                        </li>
                        <li>
                            <a href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">
                                <i class="bx bx-power-off"></i>
                                <span key="t-logout">Logout</span>
                            </a>
                        </li>
                </div>


                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Sir-Josh.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Sir-Josh
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>




    <script src="{{ asset('assets/js/app.js')}}"></script>

</body>


</html>