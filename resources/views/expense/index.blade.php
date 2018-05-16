@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(date('m', $date) == date('m'))
                    <h2>{{ __('Day') }} {{ date('d') }} {{ __(' of ') }} {{ cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date)) }}</h2>
                @else
                    <h2>{{ __('Finished!') }}</h2>
                @endif
                <div class="progress">
                    @if ($remaining > 0)
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($spent/$budget)*100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    @else
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($spent/$budget)*100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="card-header text-center">{{ __('Days Dined Out') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">{{ count($expenses) }}</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Budget') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">${{ number_format($budget, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Spent') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">${{ number_format($spent, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                    @if ($remaining > 0)
                        <div class="card text-white bg-success">
                            <div class="card-header text-center">{{ __('Remaining') }}</div>
                            <div class="card-body">
                                <h4 class="text-center">${{ number_format($remaining, 2, '.', ',') }}</h4>
                            </div>
                        </div>
                    @else
                        <div class="card text-white bg-danger">
                            <div class="card-header text-center">{{ __('Remaining') }}</div>
                            <div class="card-body">
                                <h4 class="text-center">(${{ number_format(abs($remaining), 2, '.', ',') }})</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="container">
        <div class="row">
            @if (count($expenses) > 0)
            <h2>{{ __('Transactions') }}</h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Place</th>
                        <th scope="col">Price</th>
                        <th scope="col">Reason</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ date('jS', strtotime($expense->date)) }}</td>
                            <td>{{ $expense->place }}</td>
                            <td>${{ $expense->price }}</td>
                            <td>{{ $expense->reason }}</td>
                            <td class="text-center">
                                <a href="{{ route('expense.edit', ['id' => $expense->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('expense.delete', ['id' => $expense->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('expense.create') }}" class="btn btn-success float-right">Add Entry</a>
            </div>
            @else
                <h2 class="text-center">No transactions found for this category</h2>
            @endif
        </div>
    </div>
@endsection
