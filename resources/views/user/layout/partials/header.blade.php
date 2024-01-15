<div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall">
    <div class="mdk-header__content">
        <div class="navbar navbar-expand navbar-light bg-white navbar-shadow" id="default-navbar" data-primary>
            <div class="container page__container">
                <!-- Navbar Brand -->
                <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button"
                data-toggle="sidebar">
                <span class="material-icons">short_text</span>
            </button>

            <a href="{{ route('home') }}" class="navbar-brand mr-16pt">
                <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                    <span class="avatar-title rounded {{ empty(setting('logo')) ? 'bg-primary' : '' }}">
                        <img src="{{ empty(setting('logo')) ? asset('images/illustration/student/128/white.svg') : Storage::url(setting('logo')) }}" class="img-fluid"
                        alt="logo" />
                    </span>
                </span>
                <span class="d-none d-lg-block">{{ config('app.name') }}</span>
                </a>
                <!-- Navbar toggler -->
                <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                    <li class="nav-item active">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('courses') }}" class="nav-link">Bimbingan Teknis</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('page', 'faq') }}" class="nav-link">FAQ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('page', 'contact') }}" class="nav-link">Contact</a>
                    </li>
                </ul>
                <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt"
                    action="index.html" style="max-width: 230px">
                    <button class="btn" type="submit">
                        <i class="material-icons">search</i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search ...">
                </form>
                @if(auth()->guest())
                <ul class="nav navbar-nav ml-auto mr-0">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link" data-toggle="tooltip" data-title="Login"
                            data-placement="bottom" data-boundary="window">
                            <i class="material-icons">lock_open</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary">Get Started</a>
                    </li>
                </ul>
                @else
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                        data-caret="false">

                        <span class="avatar avatar-sm mr-8pt2">

                            <span class="avatar-title rounded-circle bg-primary"><i
                                    class="material-icons">account_box</i></span>

                        </span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header"><strong>Akun</strong></div>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('certificate.index') }}">Sertifikat</a>
                        <a class="dropdown-item" href="{{ route('account.index') }}">Edit Akun</a>
                        <a class="dropdown-item" href="{{ route('account.password') }}">Ganti Password</a>
                        <a class="dropdown-item text-danger" href="javascript:void();"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
