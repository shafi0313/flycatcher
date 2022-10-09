<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ Request::segment(1) == 'dashboard' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Dashboard</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'agent' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Report</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(3) == 'collection-report' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.collection-report') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Collection Report</span></a>
            </li>
            <li class="{{ Request::segment(3) == 'merchant-wise-parcel' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.merchant-wise-parcel') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Wise Parcel</span></a>
            </li>
            <li class="{{ Request::segment(3) == 'area-wise-parcel' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.area-wise-parcel') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Area Wise Parcel</span></a>
            </li>
            <li class="{{ Request::segment(3) == 'date-wise-parcel' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.date-wise-parcel') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Date Wise Parcel</span></a>
            </li>
            <li class="{{ Request::segment(3) == 'total-parcel-rider-wise' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.rider-wise-parcel-count') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Total Parcel Rider Wise</span></a>
            </li>

            <li class="{{ Request::segment(3) == 'parcel-summery' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Parcel Summery</span></a>
            </li>
            <li class="{{ Request::segment(3) == 'merchant-parcel-summery' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Parcel Summery</span></a>
            </li>

        </ul>
    </li>

</ul>