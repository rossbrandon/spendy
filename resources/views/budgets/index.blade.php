@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (count($budgets) > 0)
                <div class="col-12">
                    <h2>{{ __('Budgets') }}</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Month</th>
                                <th scope="col">Amount</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($budgets as $budget)
                                <tr class="clickable-row" data-href="{{ route('budget.edit', ['id' => $budget->id]) }}">
                                    <td>{{ $budget->name }}</td>
                                    <td>{{ date('F Y', strtotime($budget->date)) }}</td>
                                    <td>${{ $budget->amount }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('budget.edit', ['id' => $budget->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('budget.delete', ['id' => $budget->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('budget.create') }}" class="btn btn-success float-right">Add Entry</a>
                    </div>
                </div>
            @else
                <h2 class="text-center">No budgets found... <a href="{{ route('budget.create') }}">Create One!</a></h2>
            @endif
        </div>
    </div>
@endsection
