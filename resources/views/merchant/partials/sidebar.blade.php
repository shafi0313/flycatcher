<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
                                                                                     href="{{ route('merchant.dashboard') }}"><i
                data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">{{ __('sidebar.dashboard')}}</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'pickup-request' ? 'active' : '' }} nav-item"><a
            class="d-flex align-items-center" href="{{ route('merchant.pickup-request.index') }}"><i
                data-feather="rotate-cw"></i><span class="menu-title text-truncate"
                                                   data-i18n="settings">Pickup Request</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'parcel' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
                                                                                  href="{{ route('merchant.parcel.index') }}">
            <i class="fas fa-cart-arrow-down"></i><span class="menu-title text-truncate"
                                                   data-i18n="settings">Parcel</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'parcel-request' ? 'active' : '' }} nav-item"><a
            class="d-flex align-items-center" href="{{ route('merchant.parcel.request.index') }}"><i
                data-feather="briefcase"></i><span class="menu-title text-truncate"
                                                   data-i18n="settings">Parcel Request</span></a>
    </li>

    <li class="{{ Request::segment(2) == 'cancel-parcel-accept' ? 'active' : '' }} nav-item"><a
            class="d-flex align-items-center" href="{{ route('merchant.accept-cancel-parcel') }}"><i class="fa fa-check"></i><span class="menu-title text-truncate"
                                                   data-i18n="settings">Accept Cancel Parcel</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'batch' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('merchant.batchUpload') }}">
            <i data-feather="circle"></i><span class="menu-item text-truncate"
                                               data-i18n="Collapsed Menu">Batch Upload</span>
        </a>
    </li>
    <li class="{{ Request::segment(2) == 'invoices' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('merchant.invoice') }}">
            <i data-feather="circle"></i><span class="menu-item text-truncate"
                                               data-i18n="Collapsed Menu">Invoices</span>
        </a>
    </li>
    <li class="{{ Request::segment(2) == 'collection' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('merchant.collection.index') }}">
            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Collection History</span>
        </a>
    </li>
    <li class="{{ Request::segment(2) == 'coverage' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('merchant.coverage.area') }}">
            <i data-feather="circle"></i><span class="menu-item text-truncate"
                                               data-i18n="Collapsed Menu">Coverage Area</span>
        </a>
    </li>
    <li class="{{ Request::segment(2) == 'settings' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
                                                                                    href="{{ url('/merchant/settings') }}"><i
                data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="settings">Settings</span></a>
    </li>

    <li class="{{ Request::segment(2) == 'parcel'||Request::segment(2) == 'batch' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span
                class="menu-title text-truncate" data-i18n="Page Layouts">Payment Settings</span></a>
        <ul class="menu-content">

            <li class="{{ Request::segment(2) == 'bank-info' ? 'active' : '' }} nav-item"><a
                    class="d-flex align-items-center" href="{{route('merchant.settings.bank-info.index')}}"><i
                        data-feather="circle"></i><span class="menu-title text-truncate"
                                                        data-i18n="Home">Bank</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'mobile-banking' ? 'active' : '' }} nav-item"><a
                    class="d-flex align-items-center" href="{{ route('merchant.settings.mobile-banking.index') }}"><i
                        data-feather="circle"></i><span class="menu-title text-truncate"
                                                        data-i18n="Home">Mobile Banking</span></a>
            </li>
        </ul>
    </li>

    <li class="{{ Request::segment(2) == 'parcel-report' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
                                                                                    href="{{ route('merchant.parcel.report') }}"><i
                data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="settings">Date Wise Parcel Search</span></a>
    </li>

    <li class="{{ Request::segment(2) == 'status-meanings' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
                                                                                    href="{{ route('merchant.status-meanings.index') }}"><i
                data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="settings">Our Status In Details</span></a>
    </li>
</ul>
