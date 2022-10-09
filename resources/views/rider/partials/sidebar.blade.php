<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/rider/dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Dashboard</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'pickup-request' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/rider/pickup-request') }}"><i data-feather="rotate-cw"></i><span class="menu-title text-truncate" data-i18n="settings">Pickup Request</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'parcel' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/rider/parcel') }}"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="settings">Parcel</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'collection' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('rider.collection.index') }}"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="settings">Collection</span></a>
    </li>

    <li class="{{ Request::segment(2) == 'invoices' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('rider.invoices.index') }}"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="settings">Invoice</span></a>
    </li>

    <li class="{{ Request::segment(2) == 'monthly-rider-delivery-report' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('rider.delivery.report') }}"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="settings">Collection Report</span></a>
    </li>
    <!-- <li class="{{ Request::segment(2) == 'settings' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/rider/settings') }}"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="settings">Settings</span></a>
    </li> -->
</ul>
