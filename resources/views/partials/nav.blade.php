<nav class="navbar navbar-expand-md navbar-light navbar-laravel" id="dark-nav">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/') }}">
            {!! config('app.name', trans('titles.app')) !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto" class="parent-links" id="icon-color">
                @role('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {!! trans('titles.adminDropdownNav') !!}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}" href="{{ route('laravelroles::roles.index') }}">
                                {!! trans('titles.laravelroles') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/users') }}">
                                {!! trans('titles.adminUserList') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('branches') ? 'active' : null }}" href="{{ url('/branches') }}">
                                Branches Administration
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('memberships') ? 'active' : null }}" href="{{ url('/admin/memberships') }}">
                                Memberships
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users/create') ? 'active' : null }}" href="{{ url('/users/create') }}">
                                {!! trans('titles.adminNewUser') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                                {!! trans('titles.adminLogs') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
                                {!! trans('titles.adminActivity') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
                                {!! trans('titles.adminPHP') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
                                {!! trans('titles.adminRoutes') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('classes/form') ? 'active' : null }}" href="{{ url('/classes/form') }}">
                                Create Class
                            </a>


                            {{--
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('active-users') ? 'active' : null }}" href="{{ url('/active-users') }}">
                                {!! trans('titles.activeUsers') !!}
                            </a>
                            --}}
                        </div>
                    </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" id="icon-color" href='{{ url('/memberships') }}'>Memberships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="icon-color" href='{{ url('/daypass') }}'>Daypass</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="icon-color" href='{{ url('/dashboard') }}'>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="icon-color" href='{{ url('/nutrition') }}'>Nutrition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="icon-color" href='{{ url('/classes') }}'>Classes</a>
                </li>
            </ul>
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto" >
                {{-- Authentication Links --}}
                @guest
                    <li><a class="nav-link" id="icon-color" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
                    @if (Route::has('register'))
                        <li><a class="nav-link" id="icon-color" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name) ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <a class="dropdown-item {{ Request::is('profile/' . Auth::user()->name . '/memberships') ? 'active' : null }}" href="{{ url('/profile/' . Auth::user()->name . '/memberships') }}">
                                Memberships
                            </a>
                            @role('trainer')
                            <a class="dropdown-item {{ Request::is('profile/' . Auth::user()->name . '/plans') ? 'active' : null }}" href="{{ url('/profile/' . Auth::user()->name . '/plans') }}">
                                Plans
                            </a>
                            @endrole
                            <a class="dropdown-item {{ Request::is('profile/' . Auth::user()->name . '/assignments') ? 'active' : null }}" href="{{ url('/profile/' . Auth::user()->name . '/assignments') }}">
                                Plan Assignments
                            </a>
                            <a class="dropdown-item {{ Request::is('profile/' . Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/' . Auth::user()->name . '/edit') }}">
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
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
    </div>
</nav>
