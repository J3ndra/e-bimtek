<!-- Navbar -->
<div class="navbar navbar-expand pr-0 navbar-light border-bottom-2" id="default-navbar" data-primary>
    <!-- Navbar Toggler -->
    <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
        <span class="material-icons">short_text</span>
    </button>
    <!-- // END Navbar Toggler -->
    <!-- Navbar Brand -->
    <a href="index.html" class="navbar-brand mr-16pt d-lg-none">
        <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
            <span class="avatar-title rounded {{ empty(setting('logo')) ? 'bg-primary' : '' }}">
                <img src="{{ empty(setting('logo')) ? asset('images/illustration/student/128/white.svg') : Storage::url(setting('logo')) }}" class="img-fluid"
                alt="logo" />
            </span>
        </span>
        <span class="d-none d-lg-block">{{ config('app.name') }}</span>
    </a>
    <!-- // END Navbar Brand -->
    <div class="flex"></div>
    <!-- Navbar Menu -->
    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                data-caret="false">
                <span class="avatar avatar-sm mr-8pt2">
                    <span class="avatar-title rounded-circle bg-primary">
                        <i class="material-icons">account_box</i>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="{{ route('team.account.index') }}">Edit Account</a>
                <a class="dropdown-item" href="{{ route('team.account.password') }}">Change Password</a>
                <a class="dropdown-item text-danger" href="javascript:void();"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('team.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <!-- // END Navbar Menu -->
</div>
<!-- // END Navbar -->
