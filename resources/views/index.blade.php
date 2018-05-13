@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ __('Day 13 of 31') }}</h2>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 112.8%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <h4 class="text-center">$1200.00</h4>
                        </div>
                    </div>
                    <div class="card bg-white">
                        <div class="card-header text-center">{{ __('Total Spent') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">$1353.73</h4>
                        </div>
                    </div>
                    <div class="card text-white bg-danger">
                        <div class="card-header text-center">{{ __('Total Remaining') }}</div>
                        <div class="card-body">
                            <h4 class="text-center">($153.73)</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
