<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>
            <!-- Sidebar Content -->
            <a href="index.html" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->
                <span class="avatar avatar-xl sidebar-brand-icon h-auto">
                    <span class="avatar-title rounded bg-dark">
                        <img src="{{ empty(setting('logo')) ? asset('images/illustration/student/128/white.svg') : Storage::url(setting('logo')) }}" class="img-fluid"
                            alt="logo" />
                    </span>
                </span>
                <span>Bimtek</span>
            </a>
            <div class="sidebar-heading">Menu</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="{{ route('home') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Home</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('courses') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">Bimbingan Teknik</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('page', 'faq') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
                        <span class="sidebar-menu-text">FAQ</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('page', 'contact') }}">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                        <span class="sidebar-menu-text">Contact</span>
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('register') }}" class="ml-3 mt-3 btn btn-outline-secondary">Get Started</a>
                </li>

            </ul>
            <!-- // END Sidebar Content -->
        </div>
    </div>
</div>
