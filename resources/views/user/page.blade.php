@extends('user.layout.main')
@section('title', $page->title)
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="flex">
                    <h1 class="h2 m-0">{{ $page->title }}</h1>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                {!! $page->description !!}
            </div>
            @include('user.layout.partials.rightbar')
        </div>

    </div>
</div>
@endsection
