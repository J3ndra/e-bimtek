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
            <a class="sidebar-menu-button" href="{{ route('team.home') }}">
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
                    <a class="sidebar-menu-button" href="{{ route('team.courses.index') }}">
                        <span class="sidebar-menu-text">Bimtek</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('team.quizzes.index') }}">
                        <span class="sidebar-menu-text">Kuis</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- // END Sidebar Content -->
</div>
