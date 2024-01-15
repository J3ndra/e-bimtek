<div class="col-lg-4">
    @if(!auth('web')->check())
    <div class="card">
        <div class="card-body py-16pt text-center">
            <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                <i class="material-icons">timer</i>
            </span>
            <h4 class="card-title"><strong>Unlock Course</strong></h4>
            <p class="card-subtitle text-70 mb-24pt">Dapatkan akses Bimtek terbaik segera disini!</p>
            <a href="{{ route('register') }}" class="btn btn-accent mb-8pt">Daftar Sekarang</a>
            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </p>
        </div>
    </div>
    @endif

    @include('user.layout.partials.recommended')
</div>

