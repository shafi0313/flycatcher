@php
    $actions = [
                    'edit'=>route('admin.expense-head.edit', $expenseHead->id),
                    'delete' =>route('admin.expense-head.destroy', $expenseHead->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $expenseHead->status }}" />


