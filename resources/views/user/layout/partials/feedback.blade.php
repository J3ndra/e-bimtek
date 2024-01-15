<div class="page-section bg-alt">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">Feedback</div>
        </div>
        <div class="row">
            @forelse(feedbacks() as $feed)
            <div class="col-sm-6 col-md-4">
                <div class="card card-feedback card-body">
                    <blockquote class="blockquote mb-0">
                        <p class="text-70 small mb-0">{{ $feed->feedback }}</p>
                    </blockquote>
                </div>
                <div class="media ml-12pt">
                    <div class="media-left mr-12pt">
                        <a href="javascript:void(0);" class="avatar avatar-sm">
                            {{-- <img src="public/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> --}}
                            <span class="avatar-title rounded-circle">{{ $feed->user->initial }}</span>
                        </a>
                    </div>
                    <div class="media-body media-middle">
                        <a href="javascript:void(0);" class="card-title">{{ $feed->user->name }}</a>
                        <div class="rating mt-4pt">
                            @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                <span class="material-icons">{{ $feed->stars <= $i ? 'star_border' : 'star' }}</span>
                                </span>
                                @endfor
                        </div>
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
                                <strong>Belum ada feedback saat ini.</strong><br>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
