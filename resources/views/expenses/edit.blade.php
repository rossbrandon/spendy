@extends('layouts.app')

@section('content')

@include('includes.errors')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Edit Expense') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('expense.update', ['id' => $expense->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="place" class="col-md-4 col-form-label text-md-right">{{ __('Place') }}</label>

                            <div class="col-md-6">
                                <input id="place" type="text" class="form-control" name="place" value="{{ $expense->place }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" value="{{ $expense->date }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $expense->price }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="budget_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select name="budget_id" id="budget_id" class="form-control">
                                    @foreach($budgets as $budget)
                                        <option value="{{ $budget->id }}"
                                            @if($expense->budget->id == $budget->id)
                                                selected
                                            @endif
                                        >{{ $budget->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                            <div class="col-md-6">
                                <textarea id="reason" class="form-control" name="reason">{{ $expense->reason }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ URL::previous() }}" class="btn btn-block btn-light">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" class="btn btn-block btn-success">
                                    {{ __('Update Expense') }}
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
