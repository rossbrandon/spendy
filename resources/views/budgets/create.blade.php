@extends('layouts.app')

@section('content')

@include('includes.errors')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Budget') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budget.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="budget_id" class="col-md-4 col-form-label text-md-right">{{ __('Recurring?') }}</label>

                            <div class="col-md-6">
                                <select name="recurring" id="recurring" class="form-control" disabled>
                                    <option value="Yes" selected>Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ URL::previous() }}" class="btn btn-block btn-light">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-block btn-success">
                                    {{ __('Create Budget') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
