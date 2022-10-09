@php
    $actions = [
                    'show'=>route('admin.expense.show', $expense->id),
                    'edit'=>route('admin.expense.edit', $expense->id),
                    'delete' =>route('admin.expense.destroy', $expense->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $expense->status }}" />


