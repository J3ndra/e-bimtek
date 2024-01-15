<div class="bg-dark border-top-2 mt-auto">
    <div class="container page__container page-section d-flex flex-column">
        <p class="text-white-70 brand mb-24pt">
            <img class="brand-icon" src="{{ empty(setting('logo')) ? asset('images/logo/white-100@2x.png') : Storage::url(setting('logo')) }}" width="30" alt="{{ config('app.name') }}"> {{ config('app.name') }}

        </p>
        <p class="text-white-50 small mr-8pt">{{ setting('description') }}</p>
        <p class="mb-8pt d-flex">
            @foreach(footer_link('f_link') as $item)
            <a href="{{ $item->value }}" class="text-white-70 text-underline mr-8pt small">{{ $item->title }}</a>
            @endforeach
        </p>
        <p class="text-white-50 small mt-n1 mb-0">Copyright 2020 &copy; All rights reserved.</p>
    </div>
</div>
