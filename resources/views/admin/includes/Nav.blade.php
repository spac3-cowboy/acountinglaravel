<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="" class="logo-light">
                                <span class="logo-lg">
                                    <img src="{{asset('front-end/assets/images/Red.png')}}" alt="logo">
                                </span>
                    <span class="logo-sm">
                                    <img src="{{asset('front-end/assets/images/Red.png')}}" alt="small logo">
                                </span>
                </a>

                <!-- Logo Dark -->
                <a href="" class="logo-dark">
                                <span class="logo-lg">
                                    <img src="{{asset('front-end/assets/images/Red.png')}}" alt="dark logo">
                                </span>
                    <span class="logo-sm">
                                    <img src="{{asset('front-end/assets/images/Red.png')}}" alt="small logo">
                                </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Topbar Search Form -->
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="{{asset('backend/assets/admin.jpg')}}" alt="user-image" width="32" class="rounded-circle">
                                </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0"></h5>

                                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
{{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                        <i class="mdi mdi-account-circle me-1"></i>--}}
{{--                        <span>My Account</span>--}}
{{--                    </a>--}}

{{--                    <!-- item-->--}}
{{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                        <i class="mdi mdi-account-edit me-1"></i>--}}
{{--                        <span>Settings</span>--}}
{{--                    </a>--}}

{{--                    <!-- item-->--}}
{{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                        <i class="mdi mdi-lifebuoy me-1"></i>--}}
{{--                        <span>Support</span>--}}
{{--                    </a>--}}

{{--                    <!-- item-->--}}
{{--                    <a href="javascript:void(0);" class="dropdown-item">--}}
{{--                        <i class="mdi mdi-lock-outline me-1"></i>--}}
{{--                        <span>Lock Screen</span>--}}
{{--                    </a>--}}

                    <!-- item-->
                    <a href="{{route('logout')}}" class="dropdown-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
