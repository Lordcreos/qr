
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" >
                <h2 class="text-white">{{ __('chef.adminpanel') }}</h2>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line" style="background-color: #fff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #fff;"></i>
                        <i class="sidenav-toggler-line" style="background-color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a @if($root=="dashboard") class="nav-link active" @endif  class="nav-link"   href={{route('dashboard')}}>
                            <i class="fab fa-delicious text-blue"></i>
                            <span class="nav-link-text">{{ __('chef.dashboard') }}</span>
                        </a>
                    </li>




{{--                    <li class="nav-item">--}}
{{--                        <a @if($root=="sliders") class="nav-link active" @endif  class="nav-link"   href={{route('all_sliders')}}>--}}
{{--                            <i class="ni ni-album-2 text-green"></i>--}}
{{--                            <span class="nav-link-text">Sliders</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}



                    <li class="nav-item">
                        <a @if($root=="store") class="nav-link active" @endif class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                            <i class="fas fa-store text-orange"></i>
                            <span class="nav-link-text">{{ __('chef.store') }}</span>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('add_store')}}" class="nav-link">{{ __('chef.addstore') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('all_stores')}}" class="nav-link">{{ __('chef.allstore') }}</a>
                                </li>

                            </ul>
                        </div>
                    </li>



                    <li class="nav-item">
                        <a @if($root=="Subscription") class="nav-link active" @endif  class="nav-link"   href={{route('all_subscription')}}>
                            <i class="fas fa-receipt text-cyan"></i>
                            <span class="nav-link-text">{{ __('chef.subscriptions') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a @if($root=="translation") class="nav-link active" @endif class="nav-link" href="{{route('translations')}}">
                            <i class="fas fa-language text-red"></i>
                            <span class="nav-link-text">Translations</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a @if($root=="settings") class="nav-link active" @endif class="nav-link" href="{{route('settings')}}">
                            <i class="ni ni-settings-gear-65 text-flat-lighter"></i>
                            <span class="nav-link-text">{{ __('chef.settings') }}</span>
                        </a>
                    </li>




                </ul>
                <!-- Divider -->



            </div>
        </div>
    </div>
</nav>
