<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>
    <!-- Fontfaces CSS-->
    <link href={{asset('admin/css/font-face.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}} rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS-->
    <link href={{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}} rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href={{asset('admin/vendor/animsition/animsition.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/wow/animate.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/slick/slick.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/select2/select2.min.css')}} rel="stylesheet" media="all">
    <link href={{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}} rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href={{asset('admin/css/theme.css')}} rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{route('category_list')}}">
                                <i class="fas fa-database"></i>Category
                            </a>
                        </li>
                        <li>
                            <a href="{{route('product_create')}}">
                                <i class="fas fa-pizza-slice"></i>Product
                            </a>
                        </li>
                        <li>
                            <a href="{{route('account_list')}}">
                                <i class="fas fa-users fa-fw "></i>Account List
                            </a>
                        </li>

                        <li class="mt-3">
                            <form action="{{route('logout')}}"  method="post">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-sign-out-alt fa-fw mr-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap ">
                            @if(session('masterStatus'))
                                <div class="alert alert-warning mr-3 mb-0">
                                    <i class="fa fa-warning"></i> {{session('masterStatus')}}
                                </div>
                            @endif
                            <div class="header-button float-end">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image" style="width: 40px;height: 40px;object-fit: cover;">
                                            @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class="w-100 h-100 rounded-circle img-thumbnail" alt="">
                                            @else
                                                <img src="{{asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->profile)}}" class="w-100 h-100 img-thumbnail rounded-circle" alt="">
                                            @endif

                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                                            <img src="{{ asset('admin/images/default_profile.png')}}" alt="John Doe" />
                                                        @else
                                                            <img src="{{ asset('storage/profile/'.auth()->user()->profile)}}" class="rounded-circle img-thumbnail" alt="John Doe" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('profile',\Illuminate\Support\Facades\Auth::id())}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('password_change')}}">
                                                        <i class="zmdi zmdi-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" class="p-3" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="zmdi zmdi-power ml-2 mr-3"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

           @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>


<!-- Jquery JS-->
<script src={{asset('admin/vendor/jquery-3.2.1.min.js')}}></script>
<!-- Bootstrap JS-->
<script src={{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}></script>
<script src={{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}></script>
<!-- Vendor JS       -->
<script src={{asset('admin/vendor/slick/slick.min.js')}}>
</script>
<script src={{asset('admin/vendor/wow/wow.min.js')}}></script>
<script src={{asset('admin/vendor/animsition/animsition.min.js')}}></script>
<script src={{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}>
</script>
<script src={{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}></script>
<script src={{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}>
</script>
<script src={{asset('admin/vendor/circle-progress/circle-progress.min.js')}}></script>
<script src={{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}></script>
<script src={{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}></script>
<script src={{asset('admin/vendor/select2/select2.min.js')}}>
</script>

<!-- Main JS-->
    <script src={{asset('admin/js/main.js')}}></script>
    @stack('script')

</body>

</html>
<!-- end document-->
