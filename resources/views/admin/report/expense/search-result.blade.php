<div class="card">
    <div class="card-header">
        <h4 class="card-title">Search Expense List</h4>
    </div>
    <div class="card-body">
        @if (count($expenses) > 0)
            <table class="table table-bordered table-secondary table-striped">
                <thead>
                    <tr class="text-center">
                        <th colspan="7" style="background-color:#a9611d;color:#fff">Expense Summary</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Amount TK</th>
                        <th>Created By</th>
                        <th>Date & Time</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $expense->expense_head->title }}</td>
                            <td>{{ number_format($expense->amount) }}</td>
                            <td>{{ $expense->created_admin->name }}</td>
                            <td>{{ $expense->created_at->format('d-m-Y') }}</td>
                            <td>{{ $expense->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total</th>
                        <th>{{ number_format($expense_total) }}</th>
                        <th colspan="3"></th>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <form action="{{ route('admin.expense-report-print') }}" method="POST" target="_blank">
                                @csrf
                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                <input type="hidden" name="expense_head_id" value="{{ $expense_head_id }}">
                                <button class="btn btn-success btn-block">Print Now</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        @else
            <p>Not found</p>
        @endif
    </div>
</div>
