@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ __('Day 13 of 31') }}</h2>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 46.2%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <h4 class="text-center">3</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Budget') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">$100.00</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Spent') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">$46.20</h4>
                        </div>
                    </div>
                    <div class="card text-white bg-success">
                        <div class="card-header text-center">{{ __('Remaining') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">$53.80</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="container">
        <div class="row">
            <h2>{{ __('Transactions') }}</h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
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
                            <th scope="row" class="id">1</th>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->place }}</td>
                            <td>${{ $expense->price }}</td>
                            <td>{{ $expense->reason }}</td>
                            <td class="text-center">
                                <button class="btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('edit') }}" class="btn btn-success float-right">Add Entry</a>
            </div>
        </div>
    </div>
@endsection
