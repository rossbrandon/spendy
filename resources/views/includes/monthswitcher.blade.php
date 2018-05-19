<div class="row">
    <div class="col-12">
        @if (Request::is('expense/show/*'))
            <a href="{{ route('expense.prev', ['name' => $budget->name]) }}" class="float-left month-switcher">
                <span class="caret-left"></span><span class="month-switcher-text">Previous Month</span>
            </a>
            <a href="{{ route('expense.next', ['name' => $budget->name]) }}" class="float-right month-switcher">
                <span class="month-switcher-text">Next Month</span><span class="caret-right"></span>
            </a>
        @elseif (Request::is('dashboard'))
            <a href="{{ route('prev') }}" class="float-left month-switcher">
                <span class="caret-left"></span><span class="month-switcher-text">Previous Month</span>
            </a>
            <a href="{{ route('next') }}" class="float-right month-switcher">
                <span class="month-switcher-text">Next Month</span><span class="caret-right"></span>
            </a>
        @endif
    </div>
</div>
