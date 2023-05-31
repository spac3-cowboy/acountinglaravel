<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('front-end/assets/images/Red.png')}}" alt="logo">
                    </span>
        <span class="logo-sm">
                        <img src="{{asset('front-end/assets/images/Red.png')}}" alt="small logo">
                    </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('front-end/assets/images/Red.png')}}" alt="dark logo">
                    </span>
        <span class="logo-sm">
                        <img src="{{asset('front-end/assets/images/Red.png')}}" alt="small logo">
                    </span>
    </a>



    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a  href="#" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> Account </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('Transaction.Account.Create')}}">Create Account</a>
                        </li>
                        <li>
                            <a href="{{route('Transaction.Account.List')}}">Account List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarHead" aria-expanded="false" aria-controls="sidebarHead" class="side-nav-link">
                    <i class="uil-money-bill"></i>
                    <span> Transaction</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarHead">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('Transaction.Head.List')}}">Transaction Head List</a>
                        </li>
                        <li>
                            <a href="{{route('Transaction.List')}}">Transaction History</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
