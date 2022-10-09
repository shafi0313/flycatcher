<nav class="header-navbar navbar navbar-expand-lg align-items-center navbar-light navbar-shadow fixed-top">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item">{{date('Y-m-d h:i A')}}</li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            @if( Gate::check('collection-report')|| Gate::check('merchant-wise-parcel') || Gate::check('area-wise-parcel') || Gate::check('date-wise-parcel')||Gate::check('total-parcel-rider-wise')||Gate::check('parcel-summary') ||Gate::check('merchant-parcel-summary')||Gate::check('parcel-summary-in-merchant-wise')||Gate::check('parcel-summary-in-rider-wise'))
            <li class="nav-item dropdown dropdown-notification mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <b>Reports</b>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">All Reports</h4>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="{{ route('admin.parcel.summary.in.progress') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                        In Progress Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @can('collection-report')
                        <a class="d-flex" href="{{ route('admin.collection-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Collection Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('collection-report')
                        <a class="d-flex" href="{{ route('admin.parcel-with-collection-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Parcel Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('rider-wise-parcel')
                        <a class="d-flex" href="{{ route('admin.rider-wise-parcel') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                        Rider Wise Parcel
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('merchant-wise-parcel')
                        <a class="d-flex" href="{{ route('admin.merchant-wise-parcel') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Merchant Wise Parcel
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('area-wise-parcel')
                        <a class="d-flex" href="{{ route('admin.area-wise-parcel') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Area Wise Parcel
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('date-wise-parcel')
                        <a class="d-flex" href="{{ route('admin.date-wise-parcel') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Date Wise Parcel
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('total-parcel-rider-wise')
                        <a class="d-flex" href="{{ route('admin.rider-wise-parcel-count') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Total Parcel Rider Wise
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary')
                        <a class="d-flex" href="{{ route('admin.parcel.summary') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Parcel Summary
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('merchant-parcel-summary')
                        <a class="d-flex" href="{{ route('admin.merchant.parcel.summary') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Merchant Parcel Summary
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.parcel-summary-in-merchant-wise') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Parcel summary in merchant wise
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-rider-wise')
                        <a class="d-flex" href="{{ route('admin.parcel-summary-in-rider-wise') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Parcel summary in rider wise
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        {{-- @can('parcel-summary-in-rider-wise')--}}
                        {{-- <a class="d-flex" href="{{ route('admin.parcel-summary-before-date') }}">--}}
                        {{-- <div class="media d-flex align-items-start">--}}
                        {{-- <div class="media-left">--}}
                        {{-- <i class="fas fa-share"></i>--}}
                        {{-- </div>--}}
                        {{-- <div class="media-body">--}}
                        {{-- <p class="media-heading">--}}
                        {{-- <span class="font-weight-bolder">--}}
                        {{-- Parcel summary before a date--}}
                        {{-- </span>--}}
                        {{-- </p>--}}
                        {{-- </div>--}}
                        {{-- </div>--}}
                        {{-- </a>--}}
                        {{-- @endcan--}}

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.area-wise-parcel-summary') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Area Wise Parcel Summery
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.merchant-wise-due') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Merchant Wise Due
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.merchant-wise-delivery-charge') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Merchant Wise Delivery Charge
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.monthly-rider-delivery-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Monthly Rider Delivery Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.area-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Our Delivery Area
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.expense-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Expense Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.monthly-expense-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Monthly Expense Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.advance-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Advance Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan

                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.monthly-collection-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            Monthly Collection Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                        @can('parcel-summary-in-merchant-wise')
                        <a class="d-flex" href="{{ route('admin.cancle-collection-report') }}">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                        Cancle Collection Report
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endcan
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-item dropdown">
                @php $locale = session()->get('locale'); @endphp
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @switch($locale)
                    @case('bn')

                    <i class="flag-icon flag-icon-bd"></i> <span class="selected-language">বাংলা</span>
                    @break
                    @default
                    <i class="flag-icon flag-icon-us"></i> <span class="selected-language">English</span>
                    @endswitch

                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{url('localization/en')}}"><i class="flag-icon flag-icon-us"></i>
                        English</a>
                    <a class="dropdown-item" href="{{url('localization/bn')}}"><i class="flag-icon flag-icon-bd"></i>
                        বাংলা</a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a>
            </li>


            <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received
                                    </p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read
                            all notifications</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::guard('admin')->user()->name }}</span>

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
                    <a class="dropdown-item" href="{{route('admin.settings')}}"><i class="mr-50" data-feather="settings"></i> Settings</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>