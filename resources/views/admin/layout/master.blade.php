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
    <style>

        @media screen and (max-width: 992px){
            #menu-sidebar{
                transform: translateX(-300px);
                position: fixed;
                z-index: 5;
                width: 300px;
                transition: 0.5s;
            }

            #menu-sidebar.show-sidebar{
                transform: translateX(0px) !important;
            }
            .page-container {
                position: relative;
                top: 0;
                padding-left: 0;
            }
            .header-desktop {
                height: 80px;
            }
            .header-button{
                margin-top: 0;
            }
        }
</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
{{--        <aside class="menu-sidebar d-none d-lg-block">--}}
            <aside class="menu-sidebar" id="menu-sidebar">
            <div class="logo d-flex justify-content-between">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
                <button class="btn btn-light d-block d-lg-none" id="hideSidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                       <p class="text-muted text-uppercase p-2" style="background: #e5e5e5;">Category Section</p>
                       <li>
                           <a href="{{route('category_create')}}">
                               <i class="fas fa-plus-circle"></i>Create Category
                           </a>
                       </li>
                       <li>
                           <a href="{{route('category_list')}}">
                               <i class="fas fa-database"></i>Category List
                           </a>
                       </li>

                        <p class="text-muted text-uppercase p-2 mt-2" style="background: #e5e5e5;" >Product Section</p>
                        <li>
                            <a href="{{route('product_create')}}">
                                <i class="fas fa-plus-circle"></i>Create Product
                            </a>
                        </li>
                        <li>
                            <a href="{{route('product_list')}}">
                                <i class="fas fa-pizza-slice"></i> Product List
                            </a>
                        </li>
                        <p class="text-muted text-uppercase p-2 mt-2" style="background: #e5e5e5;" >Order Section</p>
                        <li>
                            <a href="{{route('order_list')}}">
                                <i class="fa-solid fa-arrow-up-wide-short"></i>Order List
                            </a>
                        </li>
                        <p class="text-muted text-uppercase p-2 mt-2" style="background: #e5e5e5;" >User Message </p>
                        <li>
                            <a href="{{route('contact_list')}}">
                                <i class="fa-solid fa-comments"></i>User Message
                            </a>
                        </li>
                        <p class="text-muted text-uppercase p-2 mt-2" style="background: #e5e5e5;" >Account Section</p>
                        <li>
                            <a href="{{route('profile_change',\Illuminate\Support\Facades\Auth::id())}}">
                                <i class="fas fa-edit fa-fw "></i>Edit Account
                            </a>
                        </li>
                        <li>
                            <a href="{{route('account_list')}}">
                                <i class="fas fa-users fa-fw "></i>Account List
                            </a>
                        </li>

                        <li class="my-3 mb-5">
                            <form action="{{route('logout')}}"  method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">
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
            <header class="header-desktop position-fixed">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap ">
                            @if(session('masterStatus'))
                                <div class="alert alert-warning mr-3 mb-0">
                                    <i class="fa fa-warning"></i> {{session('masterStatus')}}
                                </div>
                            @endif
                            <div class="header-button  float-end">
                                <button class="btn btn-light d-lg-none" id="showSidebar">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image" style="width: 40px;height: 40px;object-fit: cover;">
                                            @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class="w-100 h-100 rounded-circle img-thumbnail" alt="">
                                            @else
                                                <img src="{{asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->profile)}}" class="w-100 h-100  rounded-circle" alt="">
                                            @endif

                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix d-flex align-items-center">
                                                <div class="image " style="width: 40px;height: 40px;object-fit: cover;">
                                                    @if(\Illuminate\Support\Facades\Auth::user()->profile == 'default_profile.png')
                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->gender == 'male'? asset('admin/images/default_profile.png'):asset('admin/images/default_female.png')}}" class="w-100 h-100 rounded-circle img-thumbnail" alt="">
                                                    @else
                                                        <img src="{{asset('storage/profile/'.\Illuminate\Support\Facades\Auth::user()->profile)}}" class="w-100 h-100  rounded-circle" alt="">
                                                    @endif

                                                </div>
                                                <div class="content  text-left" style="margin-left: 15px;">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('profile',\Illuminate\Support\Facades\Auth::id())}}">
                                                        <i class="zmdi zmdi-account"></i>Account
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('password_change')}}">
                                                        <i class="zmdi zmdi-key"></i>Change Password
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" class="p-3" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger w-100">
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
