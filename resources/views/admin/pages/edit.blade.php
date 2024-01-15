@extends('admin.layout.main')
@section('title', 'Edit Page:' . $page->title)
@section('styles')
<!-- Quill Theme -->
<link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Page" sub="Edit Page: {{ $page->title }}" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Edit Page: {{ $page->title }}</div>
	</div>
	<div class="col-md-6 p-0">
		<form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data" id="form-page">
			@csrf
			@method('PATCH')

			<div class="form-group">
				<label class="form-label">Title *</label>
				<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $page->title) }}" placeholder="Title" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label class="form-label">Description</label>
				<input name="description" type="hidden">
				<div class="@error('description') is-invalid @enderror" id="description" style="height: 200px;">
					{!! old('description', $page->description) !!}
				</div>
				@error('description')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@endsection
@section('scripts')
<!-- Quill -->
<script src="{{ asset('vendor/quill.min.js') }}"></script>
<script src="{{ asset('js/quill.js') }}"></script>

<script type="text/javascript">
	const quill = new Quill('#description', {
		modules: {
			toolbar: [
			['bold', 'italic'],
			['link', 'blockquote', 'code-block', 'image'],
			[{ list: 'ordered' }, { list: 'bullet' }]
			]
		},
		placeholder: 'Compose an epic...',
		theme: 'snow'
	});

	$(document).on('submit', '#form-page', function () {
        const description = document.querySelector('input[name=description]');
        description.value = quill.root.innerHTML;

        console.log("Submitted", $(this).serialize(), $(this).serializeArray());
    });
</script>
@endsection