


<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" >
               <h2 class="text-white">{{ Auth::user()->store_name }}</h2>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #ffffff;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">




                    <li {{Route::currentRouteNamed('store_admin.dashboard')? 'class=nav-item active':null }}>
                        <a class="nav-link"   href="{{route('store_admin.dashboard')}}">
                            <i class="fas fa-th-large text-blue"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>




                    <li {{ Request::is("admin/store/orders*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.orders')}}">
                            <i class="fas fa-receipt text-green"></i>
                            <span class="nav-link-text">Orders</span>
                        </a>
                    </li>
                    <li {{ Request::is("admin/store/orders*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.waiter_calls')}}">
                            <i class="ni ni-user-run text-red"></i>
                            <span class="nav-link-text">Waiter Call</span>
                        </a>
                    </li>

                    <li {{ Request::is("admin/store/orders/status*") ? 'class=nav-item active':null}} >
                        <a  class="nav-link"   href="{{route('store_admin.orderstatus')}}">
                            <i class="ni ni-watch-time text-red"></i>
                            <span class="nav-link-text">Orders Status Screen</span>
                        </a>
                    </li>




                    <li {{Route::currentRouteNamed('store_admin.banner')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.banner')}}">
                            <i class="fas fa-images text-yellow"></i>
                            <span class="nav-link-text">Promo Banner</span>
                        </a>
                    </li>

                    <li {{Route::currentRouteNamed('admin/store/products')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.categories')}}">
                            <i class="fas fa-pizza-slice text-orange"></i>
                            <span class="nav-link-text">Inventory</span>
                        </a>
                    </li>





                    <li {{Route::currentRouteNamed('store_admin.all_tables')? 'class=nav-item active':null }} >
                        <a  class="nav-link"   href="{{route('store_admin.all_tables')}}">
                            <i class="fas fa-chair text-info"></i>
                            <span class="nav-link-text">Tables</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('download_qr',[Auth::user()->view_id])}}">
                            <i class="fas fa-qrcode text-green"></i>
                            <span class="nav-link-text"> Print Qr-Code</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.subscription_plans')}}">
                            <i class="fas fa-file-invoice-dollar text-flat-darker"></i>
                            <span class="nav-link-text"> Subscription Plans</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.customers')}}">
                            <i class="fas fa-users text-red"></i>
                            <span class="nav-link-text"> Customers</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('store_admin.settings')}}">
                            <i class="fas fa-cogs text-blue"></i>
                            <span class="nav-link-text"> Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-pink"></i>
                            <span class="nav-link-text"> Logout</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{route('store.logout')}}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </ul>




                </ul>
                <!-- Divider -->



            </div>
        </div>
    </div>
</nav>
