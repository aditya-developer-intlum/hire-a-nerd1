@extends('admin.layouts.app')
@section('title','Dynamic Page')
@section('contents')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="row">
								<div class="col-lg-12">
										

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													 Edit Page
												</h3>
											</div>
										</div>
										
									

										<!--begin::Form-->
	<form class="kt-form kt-form--label-right" autocomplete="off" 
		method="post" action="{{ route('admin.pages.page.update',[$page->id]) }}" enctype="multipart/form-data">
	@method('PUT')
	@csrf

	<div class="kt-portlet__body">
		<div class="form-group row">
			<div class="col-lg-12">
				<label for='first_name'>Title:</label>
				<input type="text" class="form-control" placeholder="Enter title" 
				name="title" value="{{ $page->title }}" autocomplete="off"
				 maxlength="191">
				@error('title')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
		</div>
		<div class="form-group row">
			<div class="col-lg-12">
				<label for='description'>Description:</label>
				<textarea name="contents" class="form-control" id="description">{{ $page->contents }}</textarea>
				@error('description')
					<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
			
		</div>
																									
	</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-6">
															<button type="submit" class="btn btn-primary">Save</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
														<div class="col-lg-6 kt-align-right">
															<a  href='{{ route('admin.pages.page.index') }}' class="btn btn-danger">Back</a>
														</div>
													</div>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

								</div>
							</div>
						</div>

@push('scripts')
	<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $(function(){

        $('#description').ckeditor();
        })
        // $('.textarea').ckeditor(); // if class is prefered.
        @if(Session::has('success'))
			Swal.fire({
			  type: 'success',
			  title: '{{ Session::get('success') }}',
			});
		@endif
    </script>
@endpush
@endsection