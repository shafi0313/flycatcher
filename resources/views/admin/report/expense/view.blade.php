@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/daterangepicker.css') }}">
@endpush
@section('title', 'Expense Report')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home' => route('admin.dashboard'),
                'Expense Report' => '',
            ];
        @endphp
        <x-bread-crumb-component title='Expense Report' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Expense Report</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" class="">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label for="date_range">Date Range</label>
                                                <input type="text" id="date_range" class="form-control flatpickr-range"
                                                    name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="expense_head_id">Expense Head</label>
                                                <select class="form-control select2" name="expense_head_id"
                                                    id="expense_head_id">
                                                    <option value="0" selected>All</option>
                                                    @foreach ($expense_heads as $expense_head)
                                                        <option value="{{ $expense_head->id }}">
                                                            {{ $expense_head->title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('expense_head_id'))
                                                    <small
                                                        class="text-danger">{{ $errors->first('expense_head_id') }}</small>
                                                @endif

                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="search_button"></label>
                                                <button
                                                    class="btn btn-primary waves-effect waves-float waves-light form-control"
                                                    id="search_button" type="button">Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div id="searchResult"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/app-assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/daterangepicker.js') }}"></script>
    <script>
        $(function() {
            $('input[name="date_range"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
            }, function(start, end, label) {
                $('input[name="date_range"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format(
                    'YYYY-MM-DD'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#search_button').on('click', function() {
                let date_range = $('#date_range').val();
                let expense_head_id = $('#expense_head_id').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.expense-report-search') }}",
                    data: {
                        date_range: date_range,
                        expense_head_id: expense_head_id,
                    },
                    success: function(response) {
                        console.log(response)
                        $("#searchResult").html(response);
                    }
                });
            });
        });
    </script>
@endpush
