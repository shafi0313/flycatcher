<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav">

            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a>
            </li>
            @if(session('loggedIn-from-admin'))
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link text-danger" href="{{ route('admin.rider.index') }}">
                    <i data-feather="rotate-cw"></i> Back To Admin</a>
            </li>
            @endif
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::guard('rider')->user()->name }}</span>

                        @if(Auth::user()->getRoleNames()->isNotEmpty())
                        <span class="badge badge-success">
                            {{ Auth::user()->getRoleNames()->implode(" ") }}<br>
                        </span>
                        @endif

                    </div>
                    <span class="avatar">
                        <img class="round" src="{{asset('app-assets/images/avatars/pro.png')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="mr-50" data-feather="user"></i>
                        Profile</a>
                    <a class="dropdown-item" href="{{ url('/rider/settings') }}"><i class="mr-50" data-feather="settings"></i>
                        Settings</a>
                    <a class="dropdown-item" href="{{ route('rider.logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('rider.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
