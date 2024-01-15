<div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>
    <!-- Sidebar Content -->
    <a href="index.html" class="sidebar-brand ">
        <!-- <img class="sidebar-brand-icon" src="{{ asset('images/illustration/student/128/white.svg') }}" alt="Luma"> -->
        <span class="avatar avatar-xl sidebar-brand-icon h-auto">
            <span class="avatar-title rounded {{ empty(setting('logo')) ? 'bg-primary' : '' }}">
                <img src="{{ empty(setting('logo')) ? asset('images/illustration/student/128/white.svg') : Storage::url(setting('logo')) }}" class="img-fluid"
                alt="logo" />
            </span>
        </span>
        <span>{{ config('app.name') }}</span>
    </a>
    <div class="sidebar-heading">Main</div>
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.home') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                Home
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" data-toggle="collapse" href="#course_menu">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">book</span>
                Bimtek
                <span class="ml-auto sidebar-menu-toggle-icon"></span>
            </a>
            <ul class="sidebar-submenu collapse sm-indent" id="course_menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.courses.index') }}">
                        <span class="sidebar-menu-text">Bimtek</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.categories.index') }}">
                        <span class="sidebar-menu-text">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.quizzes.index') }}">
                        <span class="sidebar-menu-text">Kuis</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.designs.index') }}">
                        <span class="sidebar-menu-text">Sertifikat</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" data-toggle="collapse" href="#payment_menu">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">payment</span>
                Pembayaran
                <span class="ml-auto sidebar-menu-toggle-icon"></span>
            </a>
            <ul class="sidebar-submenu collapse sm-indent" id="payment_menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.payments.index', 0) }}">
                        <span class="sidebar-menu-text">Pending</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.payments.index', 1) }}">
                        <span class="sidebar-menu-text">Success</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.payments.index', 2) }}">
                        <span class="sidebar-menu-text">Failed</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.report.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">content_copy</span>
                Laporan
            </a>
        </li>
    </ul>
    <div class="sidebar-heading">Data</div>
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.admins.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">verified_user</span>
                Admin
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.teams.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">supervised_user_circle</span>
                Team
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.users.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">nature_people</span>
                User
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.channels.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">monetization_on</span>
                Channel
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.pages.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">widgets</span>
                Page
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.sliders.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">widgets</span>
                Slider
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="{{ route('admin.settings.index') }}">
                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">brightness_low</span>
                Pengaturan
            </a>
        </li>
    </ul>
    <!-- // END Sidebar Content -->
</div>
