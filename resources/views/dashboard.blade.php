@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(date('m', $date) == date('m'))
                    <h2>{{ __('Total Progress') }}
                        <small class="float-right">
                            {{ __('Day') }}
                            {{ date('d') }}
                            {{ __(' of ') }}
                            {{ cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date)) }}
                        </small>
                    </h2>
                @else
                    <h2>{{ __('Total Progress') }}</h2>
                @endif
                <div class="progress">
                    @if ($totalRemaining > 0)
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalBudget > 0 ? ($totalSpent/$totalBudget)*100 : 0 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalBudget > 0 ? ($totalSpent/$totalBudget)*100 : 0 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="col-lg-10 offset-1">
                <div class="card-group">
                    <div class="card text-white bg-dark">
                        <div class="card-header text-center">{{ __('Total Budget') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">{{ number_format($totalBudget, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Total Spent') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">{{ number_format($totalSpent, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    @if ($totalRemaining > 0)
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
@endsection
