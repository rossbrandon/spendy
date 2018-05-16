<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
    @if (Auth::check())
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    @else
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @if (Auth::check())
            <ul class="navbar-nav mr-auto">
                @foreach($navBudgets as $navBudget)
                    <li class="">
                        <a class="nav-link text-white" href="{{ route('expense.show', ['name' => $navBudget->name]) }}">{{ $navBudget->name }}</a>
                    </li>
                @endforeach
            </ul>

            <ul class="nav navbar-nav mx-auto abs-center-x text-white">
                @if (Request::is('expense/show/*'))
                    <li><a href="{{ route('expense.prev', ['name' => $budget->name]) }}" class="nav-link">
                            <span class="caret-left"></span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <span>{{ date('F Y', $date) }}</span>
                    </li>
                    <li>
                        <a href="{{ route('expense.next', ['name' => $budget->name]) }}" class="nav-link">
                            <span class="caret-right"></span>
                        </a>
                    </li>
                @elseif (Request::is('budgets') || Request::is('budget/*'))

                @else
                    <li><a href="{{ route('prev') }}" class="nav-link">
                            <span class="caret-left"></span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <span>{{ date('F Y', $date) }}</span>
                    </li>
                    <li>
                        <a href="{{ route('next') }}" class="nav-link">
                            <span class="caret-right"></span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            @guest
                <li><a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        @if(Auth::user()->admin)
                            (Admin)
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('budgets') }}">My Budgets</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"
                        >
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
