@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.monthswitcher')
        <div class="row">
            <div class="col-12">
                @if(date('m', $date) == date('m'))
                    <h2>{{ __('My Spending') }}
                        <small class="float-right">
                            {{ __('Day') }}
                            {{ date('d') }}
                            {{ __(' of ') }}
                            {{ cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date)) }}
                        </small>
                    </h2>
                @else
                    <h2>{{ __('My Spending') }}</h2>
                @endif
                <div class="progress">
                    @if ($totalRemaining > 0)
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $totalBudget > 0 ? ($totalSpent/$totalBudget)*100 : 0 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{ $totalBudget > 0 ? ($totalSpent/$totalBudget)*100 : 0 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="col-12">
                <div class="card-group">
                    <a href="{{ route('budgets') }}" class="card text-white bg-dark">
                        <div class="card-header text-center">{{ __('Total Budget') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">{{ number_format($totalBudget, 2, '.', ',') }}</h4>
                        </div>
                    </a>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Total Spent') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">{{ number_format($totalSpent, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    @if ($totalRemaining >= 0)
                        <div class="card text-white bg-success">
                            <div class="card-header text-center">{{ __('Total Remaining') }}</div>
                            <div class="card-body">
                                <h4 class="text-center">${{ number_format($totalRemaining, 2, '.', ',') }}</h4>
                            </div>
                        </div>
                    @else
                        <div class="card text-white bg-danger">
                            <div class="card-header text-center">{{ __('Total Remaining') }}</div>
                            <div class="card-body">
                                <h4 class="text-center">(${{ number_format(abs($totalRemaining), 2, '.', ',') }})</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="container">
        @if (count($budgets) > 0)
            <div class="row">
                <div class="col-12">
                    <h2>{{ __('My Budgets') }}</h2>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Spent</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($budgets as $budget)
                                    <tr class="clickable-row" data-href="{{ route('expense.show', ['name' => $budget->name]) }}">
                                        <td class="text-center">{{ $budget->name }}</td>
                                        <td>${{ number_format($budget->amount, 2, '.', ',') }}</td>
                                        @if ($budgetSpent[$budget->id] > $budget->amount)
                                            <td class="text-danger">${{ number_format($budgetSpent[$budget->id], 2, '.', ',') }}</td>
                                        @else
                                            <td>${{ number_format($budgetSpent[$budget->id], 2, '.', ',') }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <h2 class="text-center">No budgets found... <a href="{{ route('budget.create') }}">Create One!</a></h2>
        @endif
    </div>
@endsection
