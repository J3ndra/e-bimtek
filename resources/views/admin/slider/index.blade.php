@extends('admin.layout.main')
@section('title', 'Slider')
@section('content')
<x-breadcumb title="Slider" />
<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Semua Slider</div>
        <a class="btn btn-primary float-right ml-auto" href="{{ route('admin.sliders.create') }}"><i
                class="fa fa-plus mr-2"></i> Slider Baru</a>
    </div>

    @if(session('message'))
        <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif

    <div class="row">
        @foreach($sliders as $slider)
            <div class="col-sm-6 col-md-4 col-xl-3">

                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal "
                    data-partial-height="44" data-toggle="popover" data-trigger="click">
                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="js-image"
                        data-position="left">
                        <img src="{{ Storage::url($slider->picture) }}" alt="{{ $slider->name }}" width="430"
                            height="168">
                        <span class="overlay__content align-items-start justify-content-start">
                            <span class="overlay__action card-body d-flex align-items-center">
                                <i class="material-icons mr-4pt">edit</i>
                                <span class="card-title text-white">Edit</span>
                            </span>
                        </span>
                    </a>
                    <div class="mdk-reveal__content">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex">
                                    <a class="card-title mb-4pt"
                                        href="javascript:void">{{ $slider->name }}</a>
                                </div>
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                    class="ml-4pt material-icons text-20 card-course__icon-favorite">
                                    edit
                                </a>
                                <form method="post" action="{{ route('admin.sliders.destroy', $slider->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="parentNode.submit();"
                                    class="ml-4pt material-icons text-20 card-course__icon-favorite">delete</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    {{ $sliders->links() }}
</div>
@endsection
