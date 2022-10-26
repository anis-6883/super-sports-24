@extends('layouts.app')

@section('breadcumb')
<div class="content-header row">
	<div class="content-header-left col-12 mb-2 mt-1">
		<div class="row breadcrumbs-top">
			<div class="col-12">
				<div class="breadcrumb-wrapper col-12">
					<ol class="breadcrumb p-0 mb-0">
						<li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active">{{ _lang('Home Page Sections') }}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-md-3 mb-2 mb-md-0 pills-stacked">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center active" data-toggle="pill" href="#sliders" aria-expanded="true">
							<span>{{ _lang('Sliders') }}</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center" data-toggle="pill" href="#slider_banners" aria-expanded="true">
							<span>{{ _lang('Slider Banners') }}</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center" data-toggle="pill" href="#brands" aria-expanded="true">
							<span>{{ _lang('Brands') }}</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center" data-toggle="pill" href="#flash_sale" aria-expanded="true">
							<span>{{ _lang('Flash Sale') }}</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center" data-toggle="pill" href="#recent_products" aria-expanded="true">
							<span>{{ _lang('Recent Products') }}</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center" data-toggle="pill" href="#best_selling" aria-expanded="true">
							<span>{{ _lang('Best Selling') }}</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="tab-content">
					<div id="sliders" class="tab-pane active">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Sliders') }}</h4>
								<form method="post" class="params-panel" autocomplete="off" action="{{ route('website.sliders') }}" enctype="multipart/form-data">
									@csrf

									@foreach (get_table('sliders') as $slider)
									<div class="row slider_group">
										<input type="hidden" name="slider_id[]" value="{{ $slider->id }}">
										<div class="col-md-2 offset-10 text-right">
											<button type="button" class="btn btn-danger btn-sm remove-slider">X</button>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Slider Image') }}</label>
												<input type="file" class="form-control dropify" name="slider_image[]" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/' . $slider->slider_image) }}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Caption Image') }}</label>
												<input type="file" class="form-control dropify" name="caption_image[]" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/' . $slider->caption_image) }}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Action Link') }}</label>
												<input type="text" class="form-control" name="action_link[]" value="{{ $slider->action_link }}">
											</div>
										</div>
									</div>
									@endforeach
									
									<div class="form-group add-more-slider">
										<button type="button" class="btn btn-secondary">{{ _lang('Add More') }}</button>
									</div>
									<div class="form-group text-right">
										<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="slider_banners" class="tab-pane">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Slider Banners') }}</h4>
								<form method="post" class="update-settings params-panel" autocomplete="off" action="{{ route('website.update_settings') }}" enctype="multipart/form-data">
									@csrf
									<div class="row">

										<div class="col-md-12">
											<h3>{{ _lang('Banner 1') }}</h3>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Image') }}</label>
												<input type="file" class="form-control dropify" name="slider_banner1_image" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_option('slider_banner1_image') != '' ? asset('public/uploads/' . get_option('slider_banner1_image')) : ''}}" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Action Link') }}</label>
												<input type="text" class="form-control" name="slider_banner1_link" value="{{ get_option('slider_banner1_link', '#') }}" required>
											</div>
										</div>

										<div class="col-md-12">
											<h3>{{ _lang('Banner 2') }}</h3>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Image') }}</label>
												<input type="file" class="form-control dropify" name="slider_banner2_image" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_option('slider_banner2_image') != '' ? asset('public/uploads/' . get_option('slider_banner2_image')) : ''}}" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Action Link') }}</label>
												<input type="text" class="form-control" name="slider_banner2_link" value="{{ get_option('slider_banner2_link', '#') }}" required>
											</div>
										</div>

										<div class="col-md-12">
											<h3>{{ _lang('Banner 3') }}</h3>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Image') }}</label>
												<input type="file" class="form-control dropify" name="slider_banner3_image" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_option('slider_banner3_image') != '' ? asset('public/uploads/' . get_option('slider_banner3_image')) : ''}}" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Action Link') }}</label>
												<input type="text" class="form-control" name="slider_banner3_link" value="{{ get_option('slider_banner3_link', '#') }}" required>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="brands" class="tab-pane">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Brands') }}</h4>
								<form method="post" class="params-panel" autocomplete="off" action="{{ route('website.brands') }}" enctype="multipart/form-data">
									@csrf

									@foreach (get_table('brands') as $brand)
									<div class="row brand-group">
										<input type="hidden" name="brand_id[]" value="{{ $brand->id }}">
										<div class="col-md-2 offset-10 text-right">
											<button type="button" class="btn btn-danger btn-sm remove-brand">X</button>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Brand Logo') }}</label>
												<input type="file" class="form-control dropify" name="brand_logo[]" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/' . $brand->brand_logo) }}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Brand Name') }}</label>
												<input type="text" class="form-control" name="brand_name[]" value="{{ $brand->brand_name }}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Brand Link') }}</label>
												<input type="text" class="form-control" name="brand_link[]" value="{{ $brand->brand_link }}" required>
											</div>
										</div>
									</div>
									@endforeach
									<div class="form-group add-more-brand">
										<button type="button" class="btn btn-secondary">{{ _lang('Add More') }}</button>
									</div>
									<div class="form-group text-right">
										<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="flash_sale" class="tab-pane">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Flash Sale') }}</h4>
								<form method="post" class="update-settings params-panel" autocomplete="off" action="{{ route('website.update_settings') }}">
									@csrf
									<div class="row">

										<div class="col-md-12 mb-1">
											<fieldset>
												<div class="checkbox">
													<input type="hidden" name="flashsale_status" value="0">
													<input type="checkbox" id="flashsale-status" name="flashsale_status" value="1"{{ (get_option('flashsale_status') == 1) ? ' checked' : '' }}>
													<label for="flashsale-status">
														<h5>{{ _lang('Enable flash sale section') }}</h5>
													</label>
												</div>
											</fieldset>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Section Title') }}</label>
												<input type="text" class="form-control" name="flashsection_title" value="{{ get_option('flashsection_title') }}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Sale End Date') }}</label>
												<input type="text" class="form-control pickadate" name="sale_end_date" value="{{ get_option('sale_end_date') }}" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Products') }}</label>
												<select class="form-control select2" name="flash_products[]" multiple required>
													{{ create_option('products', 'id', 'name') }}
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="recent_products" class="tab-pane">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Recent Products') }}</h4>
								<form method="post" class="update-settings params-panel" autocomplete="off" action="{{ route('website.update_settings') }}">
									@csrf
									<div class="row">

										<div class="col-md-12 mb-1">
											<fieldset>
												<div class="checkbox">
													<input type="hidden" name="recentproducts_status" value="0">
													<input type="checkbox" id="recentproducts-status" name="recentproducts_status" value="1"{{ (get_option('recentproducts_status') == 1) ? ' checked' : '' }}>
													<label for="recentproducts-status">
														<h5>{{ _lang('Enable recent products section') }}</h5>
													</label>
												</div>
											</fieldset>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Section Title') }}</label>
												<input type="text" class="form-control" name="recentproducts_title" value="{{ get_option('recentproducts_title') }}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Total Products') }}</label>
												<input type="number" class="form-control" name="recentproducts_total" value="{{ get_option('recentproducts_total') }}" required>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div id="best_selling" class="tab-pane">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title panel-title">{{ _lang('Best Selling') }}</h4>
								<form method="post" class="update-settings params-panel" autocomplete="off" action="{{ route('website.update_settings') }}">
									@csrf
									<div class="row">

										<div class="col-md-12 mb-1">
											<fieldset>
												<div class="checkbox">
													<input type="hidden" name="bestselling_status" value="0">
													<input type="checkbox" id="bestselling-status" name="bestselling_status" value="1"{{ (get_option('bestselling_status') == 1) ? ' checked' : '' }}>
													<label for="bestselling-status">
														<h5>{{ _lang('Enable best selling section') }}</h5>
													</label>
												</div>
											</fieldset>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Section Title') }}</label>
												<input type="text" class="form-control" name="bestselling_title" value="{{ get_option('bestselling_title') }}" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">{{ _lang('Total Products') }}</label>
												<input type="number" class="form-control" name="bestselling_total" value="{{ get_option('bestselling_total') }}" required>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="d-none">
	<div class="row slider_group slider-repeat">
		<div class="col-md-2 offset-10 text-right">
			<button type="button" class="btn btn-danger btn-sm remove-slider">X</button>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Slider Image') }}</label>
				<input type="file" class="form-control" name="slider_image[]" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Caption Image') }}</label>
				<input type="file" class="form-control" name="caption_image[]" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Action Link') }}</label>
				<input type="text" class="form-control" name="action_link[]">
			</div>
		</div>
	</div>
	<div class="row brand-group brand-repeat">
		<div class="col-md-2 offset-10 text-right">
			<button type="button" class="btn btn-danger btn-sm remove-brand">X</button>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Brand Logo') }}</label>
				<input type="file" class="form-control" name="brand_logo[]" data-max-file-size="4M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Brand Name') }}</label>
				<input type="text" class="form-control" name="brand_name[]" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Brand Link') }}</label>
				<input type="text" class="form-control" name="brand_link[]" required>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
	$(document).on('click','.add-more-slider > button',function(){
		var form = $('.slider-repeat').clone().removeClass('slider-repeat');
		form.find('input[type=file]').dropify();
		form.find('input').val('');
		$('.add-more-slider').before(form);
	});
	$(document).on('click','.remove-slider',function(){
		var slider_id = $(this).parent().parent().find('input[name="slider_id[]"]').val();
		if(typeof slider_id != 'undefined'){
			$.ajax({
				url: '{{ url('sliders/remove') }}/' + slider_id,
				type: 'GET',
				success: function(data){
					
				}
			});
		}
		$(this).parent().parent().remove();
	});

	$(document).on('click','.add-more-brand > button',function(){
		var form = $('.brand-repeat').clone().removeClass('brand-repeat');
		form.find('input[type=file]').dropify();
		form.find('input').val('');
		$('.add-more-brand').before(form);
	});
	$(document).on('click','.remove-brand',function(){
		var brand_id = $(this).parent().parent().find('input[name="brand_id[]"]').val();
		if(typeof brand_id != 'undefined'){
			$.ajax({
				url: '{{ url('brands/remove') }}/' + brand_id,
				type: 'GET',
				success: function(data){
					
				}
			});
		}
		$(this).parent().parent().remove();
	});
	@if (get_option('flashsale_status') != 1)
	$("#flash_sale input[type=text], #flash_sale select").prop("disabled",true);
	@endif
	$('#flashsale-status').on('change', function(){
		if($(this).is(':checked')){
			$("#flash_sale input[type=text], #flash_sale select").prop("disabled",false);
		}else{
			$("#flash_sale input[type=text], #flash_sale select").prop("disabled",true);
		}
	});

	var flash_products = new Array();
	@php
	$flash_products = unserialize(get_option('flash_products'));
	@endphp
	@isset ($flash_products)
	@foreach ($flash_products as $key => $flash_product)
	flash_products[{{ $key }}] = {{ $flash_product }};
	@endforeach
	@endisset
	$('select[name="flash_products[]"]').val(flash_products).trigger('change');


	@if (get_option('recentproducts_status') != 1)
	$("#recent_products input[type=text], #recent_products input[type=number]").prop("disabled",true);
	@endif
	$('#recentproducts-status').on('change', function(){
		if($(this).is(':checked')){
			$("#recent_products input[type=text], #recent_products input[type=number]").prop("disabled",false);
		}else{
			$("#recent_products input[type=text], #recent_products input[type=number]").prop("disabled",true);
		}
	});

	@if (get_option('bestselling_status') != 1)
	$("#best_selling input[type=text], #best_selling input[type=number]").prop("disabled",true);
	@endif
	$('#bestselling-status').on('change', function(){
		if($(this).is(':checked')){
			$("#best_selling input[type=text], #best_selling input[type=number]").prop("disabled",false);
		}else{
			$("#best_selling input[type=text], #best_selling input[type=number]").prop("disabled",true);
		}
	});
</script>
@stop

