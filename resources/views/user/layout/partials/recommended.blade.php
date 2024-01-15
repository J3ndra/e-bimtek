<div class="page-separator">
    <div class="page-separator__text">Recommended</div>
</div>

@forelse(recommendedCourses() as $recommended)
<div class="mb-8pt d-flex align-items-center">
    <a href="{{ route('course', $recommended->slug) }}"
        class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
        <img src="{{ Storage::url($recommended->thumbnail) }}"
        alt="{{ $recommended->title }}" class="avatar-img rounded">
        <span class="overlay__content"></span>
    </a>
    <div class="flex">
        <a class="card-title mb-4pt" href="{{ route('course', $recommended->slug) }}">{{ $recommended->title }}</a>
        <div class="d-flex align-items-center">
            <div class="rating mr-8pt">
                @for($i = 0; $i < 5; ++$i)
                <span class="rating__item">
                    <span class="material-icons">
                        {{ $recommended->stars <= $i ? 'star_border' : 'star' }}
                    </span>
                </span>
                @endfor
            </div>
            <small class="text-muted">{{ $recommended->stars }}/5</small>
        </div>
    </div>
</div>
@empty
<div class="col-lg-12">
    <div class="alert alert-soft-warning mb-24pt">
        <div class="d-flex flex-wrap align-items-start">
            <div class="mr-8pt">
                <i class="material-icons">access_time</i>
            </div>
            <div class="flex" style="min-width: 180px">
                <small class="text-black-100">
                    <strong>Belum ada rekomendasi Bimtek saat ini.</strong><br>
                </small>
            </div>
        </div>
    </div>
</div>
@endforelse
