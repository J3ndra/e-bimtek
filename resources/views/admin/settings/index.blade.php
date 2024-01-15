@extends('admin.layout.main')

@section('title', 'Data Settings')

@section('content')
<x-breadcumb title="Data Settings" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Data Settings</div>
        <a class="btn btn-primary float-right ml-auto" href="{{ route('admin.settings.create') }}"><i
            class="fa fa-plus mr-2"></i> Pengaturan Baru</a>
	</div>
	@if(session('message'))
	<x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
	@endif
	<div class="card mb-lg-32pt">
		<div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true" data-lists-values='["js-lists-values-slug", "js-lists-values-title", "js-lists-values-date"]'>
			<div class="card-header">
				<div class="search-form">
					<input type="text" class="form-control search" placeholder="Search ...">
					<button class="btn" type="button"><i class="material-icons">search</i>
					</button>
				</div>
			</div>
			<table class="table mb-0 thead-border-top-0 table-nowrap">
				<thead>
					<tr>
						<th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-slug">Slug</a></th>
						<th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-title">Title</a></th>
						<th>Value</th>
						<th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Updated</a></th>
						<th></th>
					</tr>
				</thead>
				<tbody class="list" id="clients">
					@foreach($settings as $setting)
					<tr>
						<td> <small class="js-lists-values-slug text-50">{{ $setting->slug }}</small>
						</td>
						<td> <small class="js-lists-values-title text-50">{{ $setting->title }}</small>
						</td>
						<td>{!! Str::limit($setting->value, 32, ' [...]') !!}</td>
						<td> <small class="js-lists-values-date text-50">{{ optional($setting->updated_at)->format('d F Y H:i') }}</small>
						</td>
						<td class="text-right">
							<a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
								<i class="material-icons">more_vert</i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{ route('admin.settings.edit', $setting->id) }}" class="dropdown-item">Edit</a>
                                @if($setting->can_delete)
                                <form method="POST" action="{{ route('admin.settings.destroy', $setting->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="parentNode.submit();" class="dropdown-item">Hapus</a>
                                </form>
                                @endif
                            </div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
@endsection
