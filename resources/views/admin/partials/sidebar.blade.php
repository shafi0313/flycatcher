<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    @can('dashboard')
    <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">{{ __('sidebar.dashboard')}}</span></a>
    </li>
    @endcan
    @if( Gate::check('expense-list')|| Gate::check('advance-list') || Gate::check('cash-summary') || Gate::check('balance-sheet')||Gate::check('loan-list')||Gate::check('investment-list') ||Gate::check('bad-debt-list'))
    <li class="{{ Request::segment(2) == 'cash-summary' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#">
            <i data-feather="user"></i>
            <span class="menu-title text-truncate" data-i18n="Page Layouts">
                Accounts
            </span>
        </a>
        <ul class="menu-content">
            @can('due-list')
            <li class="{{ Request::segment(2) == 'due-list' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.account.due') }}"><i class="fas fa-minus"></i>
                    <span class="menu-title text-truncate" data-i18n="Home">Due List</span></a>
            </li>
            @endcan
            @can('cash-summary-report')
            <li class="{{ Request::segment(3) == 'cash-summary' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.cash.summary') }}">
                    <i class="fas fa-comments-dollar"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Cash Summary</span>
                </a>
            </li>
            @endcan
            @can('expense-list')
            <li class="{{ Request::segment(2) == 'expense' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.expense.index') }}">
                    <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Home">Expense</span>
                </a>
            </li>
            @endcan
            @can('advance-list')
            <li class="{{ Request::segment(2) == 'advance' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.advance.index') }}">
                    <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Home">Advance</span>
                </a>
            </li>
            @endcan
            @can('balance-sheet')
            <li class="{{ Request::segment(3) == 'balance-sheet' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.balance.sheet') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Balance Sheet</span>
                </a>
            </li>
            @endcan

            @can('loan-list')
            <li class="{{ Request::segment(2) == 'loans' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.loans.index') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Loans</span>
                </a>
            </li>
            @endcan
            @can('bad-debt-list')
            <li class="{{ Request::segment(2) == 'bad-debts' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.bad-debts.index') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Bad Debt</span>
                </a>
            </li>
            @endcan
            @can('investment-list')
            <li class="{{ Request::segment(3) == 'investments' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.investments.index') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Invesment</span>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endif
    @if( Gate::check('accounts-collection')|| Gate::check('accounts-collection-history')|| Gate::check('collection-summary')|| Gate::check('incharge-collection')|| Gate::check('incharge-collection-history'))
    <li class="{{ Request::segment(2) == 'cash-summary' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#">
            <i data-feather="user"></i>
            <span class="menu-title text-truncate" data-i18n="Page Layouts">
                Collections
            </span>
        </a>
        <ul class="menu-content">
            @if( Gate::check('accounts-collection')|| Gate::check('accounts-collection-history')|| Gate::check('collection-summary'))
            <li>
                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Accountant</span></a>
                <ul class="menu-content">
                    @can('accounts-collection')
                    <li class="{{ Request::segment(2) == 'account-collection' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.account.collection.index') }}"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Home">List</span></a>
                    </li>
                    @endcan
                    @can('accounts-collection-history')
                    <li class="{{ Request::segment(2) == 'account-collection-history' ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.account.collection.history') }}"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Home">History</span></a>
                    </li>
                    @endcan
                    @can('collection-summary')
                    <!--For Accounts -->
                    <li class="{{ Request::segment(2) == 'collection-summary' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.collection.summary') }}"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Home">Collection Summary</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            @if( Gate::check('incharge-collection')|| Gate::check('incharge-collection-history'))

            <li>
                <a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Incharge</span></a>
                <ul class="menu-content">
                    @can('incharge-collection')
                    <li class="{{ Request::segment(2) == 'incharge-collection' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.incharge.collection.index') }}"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Home">List</span></a>
                    </li>
                    @endcan
                    @can('incharge-collection-history')
                    <li class="{{ Request::segment(2) == 'incharge-collection-history' ? 'active' : '' }} nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.incharge.collection.history') }}"><i data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Home">History</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            {{-- @can('invoice-list')--}}
            {{-- <li class="{{ Request::segment(2) == 'invoice' ? 'active' : '' }} nav-item"><a--}} {{--                        class="d-flex align-items-center"--}} {{--                        href="{{ route('admin.invoice.index') }}">
                <i--}} {{--                            data-feather="home"></i><span class="menu-title text-truncate"--}} {{--                                                          data-i18n="Home">Invoice</span></a>--}} {{--                </li>--}} {{--            @endcan--}} </ul>
    </li>
    @endif
    @if( Gate::check('incharge-invoice-list')|| Gate::check('invoice-list')|| Gate::check('rider-invoice-list'))
    <li class="{{ Request::segment(2) == 'cash-summary' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#">
            <i data-feather="user"></i>
            <span class="menu-title text-truncate" data-i18n="Page Layouts">
                Invoices
            </span>
        </a>
        <ul class="menu-content">
            @can('rider-invoice-list')
            <li class="{{ Request::segment(2) == 'rider-invoice' ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.rider.invoice.index') }}">
                    <i data-feather='printer'></i>
                    <span class="menu-title text-truncate" data-i18n="Home">Rider Invoice</span>
                </a>
            </li>
            @endcan
            @can('incharge-invoice-list')
            <li class="{{ Request::segment(2) == 'incharge-invoice' ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.incharge.invoice.index') }}">
                    <i data-feather='printer'></i>
                    <span class="menu-title text-truncate" data-i18n="Home">Incharge Invoice</span>
                </a>
            </li>
            @endcan
            @can('invoice-list')
            <li class="{{ Request::segment(2) == 'invoice' ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.invoice.index') }}">
                    <i data-feather='printer'></i>
                    <span class="menu-title text-truncate" data-i18n="Home">Merchant Payment</span>
                </a>
            </li>
            @endcan
            @can('cancle-invoice-list')
            <li class="{{ Request::segment(2) == 'cancle-invoice' ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.cancle-invoice.index') }}">
                    <i data-feather='printer'></i>
                    <span class="menu-title text-truncate" data-i18n="Home">Cancle Invoice</span>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endif
    @can('assign-parcel')
    <li class="{{ Request::segment(2) == 'rider-assign-parcel' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.rider-assign-parcel') }}"><i data-feather='sunrise'></i><span class="menu-title text-truncate" data-i18n="Home">{{__('Assign Parcel')}}</span></a></li>
    @endcan
    @can('reassign-parcel')
    <li class="{{ Request::segment(2) == 'parcel-reassigns' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.parcel-reassigns.index') }}"><i data-feather='sunrise'></i><span class="menu-title text-truncate" data-i18n="Home">{{__('Re-Assign Parcel')}}</span></a></li>
    @endcan

    @can('print-parcel')
    <li class="{{ Request::segment(2) == 'print-parcels' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.print-parcels.create') }}"><i data-feather='printer'></i><span class="menu-title text-truncate" data-i18n="Home">{{__('Print Parcel')}}</span></a></li>
    @endcan

    {{-- @hasrole('Incharge|Developer|Admin')--}}
    {{-- @can('incharge-collection')--}}
    {{-- <li class="{{ Request::segment(2) == 'incharge-collection' ? 'active' : '' }} nav-item"><a--}} {{--                class="d-flex align-items-center" href="{{ route('admin.incharge.collection.index') }}">
        <i--}} {{--                    data-feather="menu"></i><span class="menu-title text-truncate"--}} {{--                                                  data-i18n="Home">Incharge Collection</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    @can('incharge-collection-history')--}} {{--        <li class="{{ Request::segment(2) == 'incharge-collection-history' ? 'active' : '' }} nav-item">
            <a--}} {{--                class="d-flex align-items-center" href="{{ route('admin.incharge.collection.history') }}">
                <i--}} {{--                    data-feather="menu"></i><span class="menu-title text-truncate"--}} {{--                                                  data-i18n="Home">Collection History</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    <li class="{{ Request::segment(2) == 'incharge-invoice' ? 'active' : '' }} nav-item">
                    <a--}} {{--            class="d-flex align-items-center" href="{{ route('admin.incharge.invoice.index') }}">
                        <i--}} {{--                data-feather='printer'></i><span class="menu-title text-truncate"--}} {{--                                                 data-i18n="Home">Incharge Invoice</span></a></li>--}} {{--    @endhasrole--}} {{--    @hasrole('Accountant|Developer|Admin')--}} {{--    @can('accounts-collection')--}} {{--        <li class="{{ Request::segment(2) == 'account-collection' ? 'active' : '' }} nav-item">
                            <a--}} {{--                class="d-flex align-items-center" href="{{ route('admin.account.collection.index') }}">
                                <i--}} {{--                    data-feather="menu"></i><span class="menu-title text-truncate"--}} {{--                                                  data-i18n="Home">Accounts Collection</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    @can('accounts-collection-history')--}} {{--        <li class="{{ Request::segment(2) == 'account-collection-history' ? 'active' : '' }} nav-item">
                                    <a--}} {{--                class="d-flex align-items-center" href="{{ route('admin.account.collection.history') }}">
                                        <i--}} {{--                    data-feather="menu"></i><span class="menu-title text-truncate"--}} {{--                                                  data-i18n="Home">Collection History</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    @can('collection-summary')--}} {{--    <!--For Accounts -->--}} {{--        <li class="{{ Request::segment(2) == 'collection-summary' ? 'active' : '' }} nav-item">
                                            <a--}} {{--                class="d-flex align-items-center" href="{{ route('admin.collection.summary') }}">
                                                <i--}} {{--                    data-feather="menu"></i><span class="menu-title text-truncate"--}} {{--                                                  data-i18n="Home">Collection Summary</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    @can('invoice-list')--}} {{--        <li class="{{ Request::segment(2) == 'invoice' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" --}} {{--                                                                                       href="{{ route('admin.invoice.index') }}">
                                                        <i--}} {{--                    data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Invoice</span></a>--}} {{--        </li>--}} {{--    @endcan--}} {{--    @endhasrole--}} @can('pickup-request-list') <li class="{{ Request::segment(2) == 'pickup-request' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.pickup-request.index') }}"><i data-feather="rotate-cw"></i><span class="menu-title text-truncate" data-i18n="Home">Pickup Request</span></a>
                                                            </li>
                                                            @endcan

                                                            @if( Gate::check('parcel-list')|| Gate::check('batch-upload'))
                                                            <li class="{{ Request::segment(2) == 'parcel'||Request::segment(2) == 'batch' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
                                                                <a class="d-flex align-items-center" href="#"><i data-feather="briefcase"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Manage Parcel</span></a>
                                                                <ul class="menu-content">
                                                                    <li class="{{ Request::segment(2) == 'parcel-transfer' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.parcel.request') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Home">Parcel Request</span></a>
                                                                    </li>
                                                                    @can('parcel-list')
                                                                    <li class="{{ Request::segment(2) == 'parcel' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.parcel.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Home">Parcel</span></a>
                                                                    </li>
                                                                    @endcan
                                                                    @can('direct-batch-upload')
                                                                    <li class="{{ Request::segment(2) == 'batch' ? 'active' : '' }}">
                                                                        <a class="d-flex align-items-center" href="{{ route('admin.batchUpload') }}">
                                                                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Direct Batch Upload</span>
                                                                        </a>
                                                                    </li>
                                                                    @endcan
                                                                    @can('form-batch-upload')
                                                                    <li class="{{ Request::segment(2) == 'excelform' ? 'active' : '' }}">
                                                                        <a class="d-flex align-items-center" href="{{ route('admin.batchUploadForm') }}">
                                                                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Form Batch Upload</span>
                                                                        </a>
                                                                    </li>
                                                                    @endcan
                                                                </ul>
                                                            </li>
                                                            @endif

                                                            {{-- <li class="{{ Request::segment(2) == 'agent' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a--}} {{--            class="d-flex align-items-center" href="#"><i data-feather="book"></i><span class="menu-title text-truncate"--}} {{--                                                                                        data-i18n="Page Layouts">Report</span></a>--}} {{--        <ul class="menu-content">--}} {{--            @can('collection-report')--}} {{--                <li class="{{ Request::segment(3) == 'collection-report' ? 'active' : '' }}">
                                                                <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.collection-report') }}">
                                                                    <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Collection Report</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('merchant-wise-parcel')--}} {{--                <li class="{{ Request::segment(3) == 'merchant-wise-parcel' ? 'active' : '' }}">
                                                                        <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.merchant-wise-parcel') }}">
                                                                            <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Wise Parcel</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('area-wise-parcel')--}} {{--                <li class="{{ Request::segment(3) == 'area-wise-parcel' ? 'active' : '' }}">
                                                                                <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.area-wise-parcel') }}">
                                                                                    <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Area Wise Parcel</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('date-wise-parcel')--}} {{--                <li class="{{ Request::segment(3) == 'date-wise-parcel' ? 'active' : '' }}">
                                                                                        <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.date-wise-parcel') }}">
                                                                                            <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Date Wise Parcel</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('total-parcel-rider-wise')--}} {{--                <li class="{{ Request::segment(3) == 'total-parcel-rider-wise' ? 'active' : '' }}">
                                                                                                <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.rider-wise-parcel-count') }}">
                                                                                                    <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Total Parcel Rider Wise</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('parcel-summary')--}} {{--                <li class="{{ Request::segment(3) == 'parcel-summary' ? 'active' : '' }}">
                                                                                                        <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.parcel.summary') }}">
                                                                                                            <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Parcel Summary</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('merchant-parcel-summary')--}} {{--                <li class="{{ Request::segment(3) == 'merchant-parcel-summary' ? 'active' : '' }}">
                                                                                                                <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.merchant.parcel.summary') }}">
                                                                                                                    <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Parcel Summary</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('parcel-summary-in-merchant-wise')--}} {{--                <li class="{{ Request::segment(3) == 'parcel-summary-in-merchant-wise' ? 'active' : '' }}">
                                                                                                                        <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.parcel-summary-in-merchant-wise') }}">
                                                                                                                            <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Parcel summary in merchant wise</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            @can('parcel-summary-in-rider-wise')--}} {{--                <li class="{{ Request::segment(3) == 'parcel-summary-in-rider-wise' ? 'active' : '' }}">
                                                                                                                                <a--}} {{--                        class="d-flex align-items-center" href="{{ route('admin.parcel-summary-in-rider-wise') }}">
                                                                                                                                    <i--}} {{--                            data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Parcel summary in rider wise</span></a>--}} {{--                </li>--}} {{--            @endcan--}} {{--            --}}{{--            <li class="{{ Request::segment(3) == 'parcel-summary-before-date' ? 'active' : '' }}">
                                                                                                                                        <a--}} {{--            --}}{{--                    class="d-flex align-items-center" href="{{ route('admin.parcel-summary-before-date') }}">
                                                                                                                                            <i--}} {{--            --}}{{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu"> Parcel summary before a date</span></a>--}} {{--            --}}{{--            </li>--}} {{--            <li class="{{ Request::segment(3) == 'area-wise-parcel-summary' ? 'active' : '' }}">
                                                                                                                                                <a--}} {{--                    class="d-flex align-items-center" href="{{ route('admin.area-wise-parcel-summary') }}">
                                                                                                                                                    <i--}} {{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Area Wise Parcel Summery</span></a>--}} {{--            </li>--}} {{--            <li class="{{ Request::segment(3) == 'merchant-wise-due' ? 'active' : '' }}">
                                                                                                                                                        <a--}} {{--                    class="d-flex align-items-center" href="{{ route('admin.merchant-wise-due') }}">
                                                                                                                                                            <i--}} {{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Wise Due</span></a>--}} {{--            </li>--}} {{--            <li class="{{ Request::segment(3) == 'merchant-wise-delivery-charge' ? 'active' : '' }}">
                                                                                                                                                                <a--}} {{--                    class="d-flex align-items-center" href="{{ route('admin.merchant-wise-delivery-charge') }}">
                                                                                                                                                                    <i--}} {{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Merchant Wise DC</span></a>--}} {{--            </li>--}} {{--            <li class="{{ Request::segment(3) == 'monthly-rider-monthly-rider-delivery-report' ? 'active' : '' }}">
                                                                                                                                                                        <a--}} {{--                    class="d-flex align-items-center" href="{{ route('admin.monthly-rider-delivery-report') }}">
                                                                                                                                                                            <i--}} {{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Monthly Rider Delivery Report</span></a>--}} {{--            </li>--}} {{--            <li class="{{ Request::segment(3) == 'area-report' ? 'active' : '' }}"><a class="d-flex align-items-center" --}} {{--                                                                                      href="{{ route('admin.area-report') }}">
                                                                                                                                                                                    <i--}} {{--                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Our Delivery Area</span></a>--}} {{--            </li>--}} {{--        </ul>--}} {{--    </li>--}} @can('merchant-list') <li class="{{ Request::segment(2) == 'merchant' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.merchant.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Home">Merchant</span></a>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endcan
                                                                                                                                                                                        @can('rider-list')
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'rider' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.rider.index') }}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Home">Rider</span></a>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endcan

                                                                                                                                                                                        @if( Gate::check('delivery-charge-list')|| Gate::check('weight-range-list'))
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'district' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="dollar-sign"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Charge Setup</span></a>
                                                                                                                                                                                            <ul class="menu-content">
                                                                                                                                                                                                @can('delivery-charge-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'delivery-charge' ? 'active' : '' }} nav-item">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="{{ route('admin.delivery-charge.index') }}">
                                                                                                                                                                                                        <i data-feather="dollar-sign"></i><span class="menu-title text-truncate" data-i18n="Home">Delivery Charge</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('weight-range-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'weight-range' ? 'active' : '' }}">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="{{ route('admin.weight-range.index') }}">
                                                                                                                                                                                                        <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Weight Range</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if( Gate::check('attendance-list')|| Gate::check('leave-type-list') || Gate::check('leave-type-list'))
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'attendance' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='sliders'></i><span class="menu-title text-truncate" data-i18n="Page Layouts">HR</span></a>
                                                                                                                                                                                            <ul class="menu-content">
                                                                                                                                                                                                @can('attendance-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'attendance' ? 'active' : '' }} nav-item">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="">
                                                                                                                                                                                                        <i data-feather='chevrons-right'></i><span class="menu-title text-truncate" data-i18n="Home">Attendance</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('payroll-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'payroll' ? 'active' : '' }} nav-item">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="">
                                                                                                                                                                                                        <i data-feather='chevrons-right'></i><span class="menu-title text-truncate" data-i18n="Home">Payroll</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('leave-type-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'leave-types' ? 'active' : '' }} nav-item">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="">
                                                                                                                                                                                                        <i data-feather='chevrons-right'></i><span class="menu-title text-truncate" data-i18n="Home">Leave Types</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @can('hub-list')
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'hub' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.hub.index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Hub</span></a>
                                                                                                                                                                                        </li>

                                                                                                                                                                                        @endcan
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'complaints' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ route('admin.complaints.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Home">Complaints</span></a>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @if( Gate::check('division-list')||Gate::check('district-list')||Gate::check('upazila-list')||Gate::check('area-list'))
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'division'||Request::segment(2) == 'district'||Request::segment(2) == 'upazila'|| Request::segment(2) == 'area' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
                                                                                                                                                                                            <a class="d-flex align-items-center" href="#"><i data-feather="map-pin"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Location</span></a>
                                                                                                                                                                                            <ul class="menu-content">
                                                                                                                                                                                                @can('division-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'division' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.division.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Division</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('district-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'district' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.district.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">District</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('upazila-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'upazila' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.upazila.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Upazila</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('area-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'area' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.area.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Area</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'sub-area' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.sub-area.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Sub Area</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if( Gate::check('permission-list') || Gate::check('role-list')||Gate::check('admin-list'))
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'role' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Access Control</span><span class="badge badge-light-danger badge-pill ml-auto mr-1">3</span></a>
                                                                                                                                                                                            <ul class="menu-content">
                                                                                                                                                                                                @can('permission-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'permission' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.permission.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Permission</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('role-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'role' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.role.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Role</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('admin-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'admin' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.admin.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Admin</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if( Gate::check('customer-export') || Gate::check('env-dynamic') ||Gate::check('reason-list')||Gate::check('parcel-type-list'))
                                                                                                                                                                                        <li class="{{ Request::segment(2) == 'reason' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Settings</span></a>
                                                                                                                                                                                            <ul class="menu-content">
                                                                                                                                                                                                @can('customer-export')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'customer-export' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.customer-export.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Customer Export</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('parcel-type-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'parcel-type' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.parcel-type.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Parcel type</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('reason-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'reason' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.reason.index') }}"><i data-feather='menu'></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Reason</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('env-dynamic')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'env-dynamic' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.env-dynamic.index') }}"><i data-feather='menu'></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Env
                                                                                                                                                                                                            Dynamic</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                                @can('expense-head-list')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'expense-head' ? 'active' : '' }} nav-item">
                                                                                                                                                                                                    <a class="d-flex align-items-center" href="{{ route('admin.expense-head.index') }}">
                                                                                                                                                                                                        <i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Home">Expense Head</span>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan

                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'status-meanings' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.status-meanings.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Status meaning</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'sms-settings' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.sms-settings.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Sms Settings</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @can('date-adjust')
                                                                                                                                                                                                <li class="{{ Request::segment(2) == 'date-adjust' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.parcel.date.adjust') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Date Adjustment</span></a>
                                                                                                                                                                                                </li>
                                                                                                                                                                                                @endcan
                                                                                                                                                                                            </ul>
                                                                                                                                                                                        </li>
                                                                                                                                                                                        @endif

                                                                                                                                                                                        <!-- <li class="{{ Request::segment(2) == 'agent' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Agent</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(2) == 'cashout' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Cashout</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'agent' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Agent</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'agent' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Add Agent</span></a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::segment(2) == 'Accounts' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Accounts</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(2) == 'balance' ? 'active' : '' }}"><a class="d-flex align-items-center" href=""><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Balance</span></a>
            </li>
        </ul>
    </li> -->
</ul>