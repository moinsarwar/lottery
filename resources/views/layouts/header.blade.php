<nav class="navbar navbar-expand-lg navbar-custom shadow">
    <div class="container">
        <a class="navbar-brand" href="{{route('dashboard')}}">🎲 Paradise Lottery</a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ms-auto align-items-lg-center">
            <li class="nav-item">
                <a href="{{route('lottery')}}" class="text-white">
                    Lottery Number
                </a>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                @auth
                    <li class="nav-item me-3 text-white">
                        Hi, <strong>{{ auth()->user()->name }}</strong>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger fw-semibold rounded-pill px-3 py-1"
                                    onmouseover="this.classList.remove('btn-outline-danger'); this.classList.add('btn-danger');"
                                    onmouseout="this.classList.remove('btn-danger'); this.classList.add('btn-outline-danger');">
                                ❌ Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a href="{{ route('login') }}"
                           class="btn btn-sm btn-outline-warning fw-semibold rounded-pill px-3 py-1"
                           onmouseover="this.classList.remove('btn-outline-warning'); this.classList.add('btn-warning', 'text-white');"
                           onmouseout="this.classList.remove('btn-warning', 'text-white'); this.classList.add('btn-outline-warning');">
                            🔑 Login
                        </a>

                    </li>
                    <li class="nav-item">
                        {{--                        <a href="{{ route('register') }}" class="btn btn-sm btn-light text-primary fw-semibold">Register</a>--}}
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
