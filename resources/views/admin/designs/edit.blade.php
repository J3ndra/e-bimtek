@extends('admin.layout.main')
@section('title', 'Edit Page:' . $design->name)
@section('styles')
<!-- Quill Theme -->
<link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Page" sub="Edit Page: {{ $design->name }}" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Edit Desain: {{ $design->name }}</div>
	</div>
	<div class="col-md-6 p-0">
		<!--action="{{ route('admin.designs.updatem', $design->id) }}"-->
		<form id="formedit" method="POST" action="{{ route('admin.designs.updatem', $design->id) }}">
			<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
			{{-- @csrf --}}
			{{-- @method('PATCH') --}}
			{{-- @method('PATCH') --}}
			<input id="kode" type="text" hidden name="kode" class="form-control" value="{{ old('title', $design->id) }}" required>
			{{-- <input type="text" name="name" value="{{ old('title', $design->name) }}"> --}}

			<div class="d-flex align-items-center" style="padding-bottom: 10px">
                <div class="flex"
                     style="max-width: 100%">

                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active"
                                       data-toggle="tab"
                                       href="#name">Name</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       data-toggle="tab"
                                       href="#deskripsi">Deskripsi</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 text-70">
                                <div id="name" class="tab-pane active">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label class="form-label">Import Font *</label>
				<input id="n_import_font" type="text" name="n_import_font" class="form-control @error('n_import_font') is-invalid @enderror" value="{{ old('0', $design->n_import_font) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<label class="form-label">Font style *</label>
				<input id="n_font_style" type="text" name="n_font_style" class="form-control @error('n_font_style') is-invalid @enderror" value="{{ old('0', $design->n_font_style) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="form-label">Font Size *</label>
				<input id="n_font_size" type="text" name="n_font_size" class="form-control @error('n_font_size') is-invalid @enderror" value="{{ old('0', $design->n_font_size) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Vertical *</label>
				<input id="n_vertical" type="text" name="n_vertical" class="form-control @error('n_vertical') is-invalid @enderror" value="{{ old('0', $design->n_vertical) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Horizontal *</label>
				<select id="n_horizontal" type="text" name="n_horizontal" class="form-control @error('n_horizontal') is-invalid @enderror" value="{{ old('n_horizontal', $design->n_horizontal) }}" >
					<option {{ ($design->n_horizontal == 'left') ? 'selected' : '' }} value="left">Left</option>
					<option {{ ($design->n_horizontal == 'center') ? 'selected' : '' }} value="center">Center</option>
					<option {{ ($design->n_horizontal == 'right') ? 'selected' : '' }} value="right">Right</option>
				</select>
				{{-- <input id="n_horizontal" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $design->n_horizontal) }}" placeholder="Title" required> --}}
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Margin Left *</label>
				<input id="n_margin_left" type="text" name="n_margin_left" class="form-control @error('n_margin_left') is-invalid @enderror" value="{{ old('0', $design->n_margin_left) }}" placeholder="Margin Right" required>
				@error('n_margin_left')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Margin Right *</label>
				<input id="n_margin_right" type="text" name="n_margin_right" class="form-control @error('n_margin_right') is-invalid @enderror" value="{{ old('0', $design->n_margin_right) }}" placeholder="Margin Right" required>
				@error('n_margin_right')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
                                </div>
                                <div id="deskripsi" class="tab-pane">
    <div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Import Font *</label>
				<input id="d_import_font" type="text" name="d_import_font" class="form-control @error('d_import_font') is-invalid @enderror" value="{{ old('0', $design->d_import_font) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
    <div class="row">
    	<div class="col-md-8">
			<div class="form-group">
				<label class="form-label">Font style *</label>
				<input id="d_font_style" type="text" name="d_font_style" class="form-control @error('d_font_style') is-invalid @enderror" value="{{ old('0', $design->d_font_style) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="form-label">Font Size *</label>
				<input id="d_font_size" type="text" name="d_font_size" class="form-control @error('d_font_size') is-invalid @enderror" value="{{ old('0', $design->d_font_size) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
    </div>
    <div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Vertical *</label>
				<input id="d_vertical" type="text" name="d_vertical" class="form-control @error('d_vertical') is-invalid @enderror" value="{{ old('0', $design->d_vertical) }}" placeholder="Vertical" required>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Horizontal *</label>
				<select id="d_horizontal" type="text" name="d_horizontal" class="form-control @error('d_horizontal') is-invalid @enderror" value="{{ old('d_horizontal', $design->d_horizontal) }}" >
					<option {{ ($design->d_horizontal == 'left') ? 'selected' : '' }} value="left">Left</option>
					<option {{ ($design->d_horizontal == 'center') ? 'selected' : '' }} value="center">Center</option>
					<option {{ ($design->d_horizontal == 'right') ? 'selected' : '' }} value="right">Right</option>
				</select>
				@error('title')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-md-12">
			<div class="form-group">
				<label class="form-label">Width *</label>
				<input id="d_width" type="text" name="d_width" class="form-control @error('d_width') is-invalid @enderror" value="{{ old('0', $design->d_width) }}" placeholder="Text Width">
				@error('d_width')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Margin Left *</label>
				<input id="d_margin_left" type="text" name="d_margin_left" class="form-control @error('d_margin_left') is-invalid @enderror" value="{{ old('0', $design->d_margin_left) }}" placeholder="Margin Right" required>
				@error('d_margin_left')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-label">Margin Right *</label>
				<input id="d_margin_right" type="text" name="d_margin_right" class="form-control @error('d_margin_right') is-invalid @enderror" value="{{ old('0', $design->d_margin_right) }}" placeholder="Margin Right" required>
				@error('d_margin_right')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
	</div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>



			{{-- <a href="javascript:void(0)" id="previewbutton" class="btn btn-primary">Preview</a> --}}
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<div id="returnview">

	</div>
</div>
@endsection
@section('scripts')
<!-- Quill -->
<script src="{{ asset('vendor/quill.min.js') }}"></script>
<script src="{{ asset('js/quill.js') }}"></script>
<script>
	$(document).ready(function() {
        $("#formedit #previewbutton").on('click', function() {
            // alert("	isinya adalah " + n_margin_right +" - "+n_margin_left);
        	var kode = $("#formedit #kode").val();
        	var n_import_font = $("#formedit #n_import_font").val();
        	var n_horizontal = $("#formedit #n_horizontal").val();
        	var n_vertical = $("#formedit #n_vertical").val();
        	var n_margin_right = $("#formedit #n_margin_right").val();
        	var n_margin_left = $("#formedit #n_margin_left").val();
        	var n_font_style = $("#formedit #n_font_style").val();
        	var n_font_size = $("#formedit #n_font_size").val();

        	var d_import_font = $("#formedit #d_import_font").val();
			var d_horizontal = $("#formedit #d_horizontal").val();
        	var d_vertical = $("#formedit #d_vertical").val();
        	var d_margin_right = $("#formedit #d_margin_right").val();
        	var d_margin_left = $("#formedit #d_margin_left").val();
        	var d_font_style = $("#formedit #d_font_style").val();
        	var d_font_size = $("#formedit #d_font_size").val();

        	var token   = $("#formedit #csrf-token").val();
            $.ajax({
            	url: '{{route('admin.design.datas')}}',
            	type: 'POST',
            	data: {
            		kode : kode,
            		n_import_font :n_import_font,
            		n_horizontal : n_horizontal,
            		n_margin_right : n_margin_right,
            		n_vertical : n_vertical,
            		n_margin_left : n_margin_left,
            		n_font_style : n_font_style,
            		n_font_size : n_font_size,

            		d_import_font :d_import_font,
            		d_horizontal : d_horizontal,
            		d_margin_right : d_margin_right,
            		d_vertical : d_vertical,
            		d_margin_left : d_margin_left,
            		d_font_style : d_font_style,
            		d_font_size : d_font_size,
            		_token : token,
            		},
            	success: function(html){
					$("#returnview").html(html);
            	}
            })
        });
        $("#formedit #n_import_font").on('change', function() {
        	var kode = $("#formedit #kode").val();
        	var value = $("#formedit #n_import_font").val();
        	var token   = $("#formedit #csrf-token").val();
        	// alert('asd');
        	$.ajax({
            	url: '{{route('admin.designs.updatefont', '1')}}',
            	type: 'POST',
            	data: {
            		kode : kode,
            		value : value,
            		_token : token,
            		},
            	success: function(html){
					// $("#returnview").html(html);
					// alert(html);
            	}
            })
        });

        $("#formedit #d_import_font").on('change', function() {
        	var kode = $("#formedit #kode").val();
        	var d_value = $("#formedit #d_import_font").val();
        	var token   = $("#formedit #csrf-token").val();
        	// alert('asd');
        	$.ajax({
            	url: '{{route('admin.designs.updatefont', '1')}}',
            	type: 'POST',
            	data: {
            		kode : kode,
            		d_value : d_value,
            		_token : token,
            		},
            	success: function(html){
					// $("#returnview").html(html);
					// alert(html);
            	}
            })
        });
    });
</script>

@endsection
