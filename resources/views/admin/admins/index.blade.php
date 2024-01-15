@extends('admin.layout.main')

@section('title', 'Data Admin')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
<x-breadcumb title="Data Admin" />
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Data Admin</div>
        <a class="btn btn-primary float-right ml-auto" href="{{ route('admin.admins.create') }}"><i
                class="fa fa-plus mr-2"></i> Add New</a>
    </div>
    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif
    <div class="card mb-lg-32pt">
        <div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true"
            data-lists-values='["js-lists-values-number", "js-lists-values-name", "js-lists-values-date"]'>
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
                        <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-number">#</a>
                        </th>
                        <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
                        </th>
                        <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Added</a>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list" id="clients">
                    @foreach($admins as $admin)
                    <tr>
                        <td> <small
                                class="js-lists-values-number text-50">{{ ($admins ->currentpage()-1) * $admins ->perpage() + $loop->index + 1 }}</small>
                        </td>
                        <td>
                            <div class="media flex-nowrap align-items-center" style="white-space: nowrap;">
                                <div class="avatar avatar-sm mr-8pt">
                                    @if($admin->avatar)
                                    <img src="{{ Storage::url($admin->avatar) }}" alt="{{ $admin->name }}"
                                        class="avatar-img rounded-circle">
                                    @else
                                    <span class="avatar-title rounded-circle">{{ $admin->initial }}</span>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <div class="d-flex flex-column">
                                        <p class="mb-0"><strong class="js-lists-values-name">{{ $admin->name }}</strong>
                                        </p> <small class="js-lists-values-email text-50">{{ $admin->email }}</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td> <small
                                class="js-lists-values-date text-50">{{ $admin->created_at->format('d F Y') }}</small>
                        </td>
                        <td class="text-right">
                            <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="dropdown-item">Edit</a>
                                <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item">Hapus</button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.admins.show', $admin->id) }}" class="dropdown-item">Detail</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $admins->links() }}
    </div>
</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
@endsection
