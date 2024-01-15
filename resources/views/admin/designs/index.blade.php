@extends('admin.layout.main')

@section('title', 'Data Pages')

@section('styles')
<!-- Quill Theme -->
<link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Data Pages" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Data Certificate</div>
		{{-- <a class="btn btn-primary float-right ml-auto" href="{{ route('admin.pages.create') }}"><i class="fa fa-plus mr-2"></i> Add New</a> --}}
		<button type="button" class="btn btn-primary float-right ml-auto" data-toggle="modal" data-target="#myModal">Add New</button>
	</div>
	@if(session('message'))
	<x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
	@endif
	<div class="card mb-lg-32pt">
		<div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true" data-lists-values='["js-lists-values-number", "js-lists-values-name", "js-lists-values-date"]'>
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
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Published at</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-title">Title</a>
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="list" id="clients">
					@foreach($data as $row)
					<tr>
						<td> <small class="js-lists-values-date text-50">{{ optional($row->created_at)->format('d F Y') }}</small>
						</td>
						<td> <small class="js-lists-values-title text-50">{{ $row->name }}</small>
						</td>
						<td class="text-right">
							<a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
								<i class="material-icons">more_vert</i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{ route('admin.designs.edit', $row->id) }}" class="dropdown-item">Edit</a>


								<form method="POST" action="{{ route('admin.designs.destroy', $row->id) }}" class="d-inline form-delete">
									@csrf
									@method('DELETE')

									<button type="submit" class="dropdown-item">Hapus</button>
								</form>
								<div class="dropdown-divider"></div>
								<a href="{{ route('admin.pages.show', $row->id) }}" class="dropdown-item">Detail</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{ $data->links() }}
	</div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	  	<form method="POST" action="{{ route('admin.designs.store') }}" enctype="multipart/form-data">
	  		@csrf
	      <div class="modal-body">
		      	<div class="form-group">
		      		<label class="form-label">Name : </label>
		      		<input type="text" name="name" class="form-contro" placeholder="Title" required>
		      		@error('title')
		      		<div class="invalid-feedback">{{ $message }}</div>
		      		@enderror
		      	</div>
		      	<div class="form-group">
		      		<label class="form-label">Template : </label>
		      		<input type="file" name="file" class="form-contro" placeholder="Title" required>
		      		@error('title')
		      		<div class="invalid-feedback">{{ $message }}</div>
		      		@enderror
		      	</div>
	      </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-default">Submit</button>
            </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
@endsection
