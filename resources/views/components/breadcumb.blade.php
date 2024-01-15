<div class="pt-32pt">
	<div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
		<div class="flex d-flex flex-column flex-sm-row align-items-center">
			<div class="mb-24pt mb-sm-0 mr-sm-24pt">
				<h2 class="mb-0">{{ $title }}</h2>
				<ol class="breadcrumb p-0 m-0">
					<li class="breadcrumb-item">
						<a href="javascript:void(0);">Home</a>
					</li>
					<li class="breadcrumb-item active">
						{{ $sub ?? $title }}
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>