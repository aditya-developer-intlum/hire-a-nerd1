@extends('admin.layouts.app')
@section('contents')

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							
											

							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
										 <i class="la la-truck"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Manage Orders
										</h3>
									</div>
									
								</div>
	<div class="kt-portlet__body">
		<div class="row" style="padding-bottom: 20px">
			<div class='col-md-2 offset-md-3'>
				<button type="button" class="btn btn-dark" id="refresh">Refresh</button>
			</div>
			<div class="col-md-3">
														
					<div class="input-group">
				<div id="reportrange" class="form-control">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>

</div>
<input type="hidden" class="reportrange">
    <button type="button" class="btn btn-outline-hover-danger btn-sm btn-icon" id="search_date"><i class="fa fa-search"></i></button>
													
					</div>
				
			</div>
				<div class="col-md-2">
														
					<div class="input-group">
					<select name="status" id="status_action" class="form-control">
						<option value="" {{ Session::get('filter')==null?'selected':'' }}>Status</option>
						<option value="pending" {{ Session::get('filter')=='pending'?'selected':'' }}>Pending</option>
						<option value="progress" {{ Session::get('filter')=='progress'?'selected':'' }}>Progress</option>
						<option value="completed" {{ Session::get('filter')=='completed'?'selected':'' }}>Completed</option>
					</select>
													
					</div>
				
			</div>
			<div class="col-md-2">
				<form action="{{ route('admin.orders') }}">										
					<div class="input-group">
					<div class="input-group-prepend">
						<button class="btn btn-secondary" type="submit">Go!</button>
					</div>
					<input type="text" name='search' class="form-control" placeholder="Search for..."
					 value="{{ Session::get('order_search')??'' }}" autocomplete="off">
													
					</div>
				</form>
			</div>	

		</div>

									<!--begin: Datatable -->
		<div id="kt_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-striped- table-bordered table-hover table-checkable  no-footer dtr-inline" id="kt_table_1" role="grid" aria-describedby="kt_table_1_info" style="width: 1471px;">
										<thead>
	<tr role="row">
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Order Id
        </th>
		 <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" >
        	Category
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" >
        	Sub Category
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" >
        	Title
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Seller
        </th>
         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Buyer
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Package
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Amount
        </th>
         <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Created At
        </th>
        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending">
        	Status
        </th>

        <th class="sorting" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" aria-label="Country: activate to sort column ascending" >
        	Action
        </th>
	
    
	</tr>
	</thead>
		<tbody>
		@empty(!$orders)
			@foreach($orders as $key => $order)
				<tr>
					<td> {{ $order->id }} </td>
					<td> {{ $order->gig->menu->name }} </td>
					<td> {{ $order->gig->submenu->name }} </td>
					<td> {{ $order->gig->gig_title }}</td>
					<td> {{ $order->gig->user->name ?? '' }}</td>
					<td> {{ $order->user->name  ?? ''}}</td>
					<td> {{ ucfirst($order->package) }} </td>
					<td> {{ $order->transaction->amount }}</td>
					<td> {{ date('d M Y',strtotime($order->created_at)) }}</td>
					<td>
								@if($order->is_accepted == true && $order->is_completed == false)

									<span class="kt-badge kt-badge--success kt-badge--dot"></span>
										&nbsp;
									<span class="kt-font-bold kt-font-success">Progress ...</span>
								@elseif($order->is_accepted == true && $order->is_completed == true)

									<span class="kt-badge kt-badge--brand kt-badge--dot"></span>
										&nbsp;
									<span class="kt-font-bold kt-font-brand">Completed</span>

								@elseif($order->is_accepted == false && $order->is_completed == false)

									<span class="kt-badge kt-badge--dark kt-badge--dot"></span>
										&nbsp;
									<span class="kt-font-bold kt-font-dark">Pending</span>

								@endif
					</td>
					<td>
						<a onclick="return window.open('{{ url(sprintf('%s/%s/%d',$order->gig->menu->slug,$order->gig->submenu->slug,$order->gig_id)) }}','_blank')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="view">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Bound" points="0 0 24 0 24 24 0 24"/>
        <path d="M10.5857864,12 L5.46446609,6.87867966 C5.0739418,6.48815536 5.0739418,5.85499039 5.46446609,5.46446609 C5.85499039,5.0739418 6.48815536,5.0739418 6.87867966,5.46446609 L12,10.5857864 L18.1923882,4.39339828 C18.5829124,4.00287399 19.2160774,4.00287399 19.6066017,4.39339828 C19.997126,4.78392257 19.997126,5.41708755 19.6066017,5.80761184 L13.4142136,12 L19.6066017,18.1923882 C19.997126,18.5829124 19.997126,19.2160774 19.6066017,19.6066017 C19.2160774,19.997126 18.5829124,19.997126 18.1923882,19.6066017 L12,13.4142136 L6.87867966,18.5355339 C6.48815536,18.9260582 5.85499039,18.9260582 5.46446609,18.5355339 C5.0739418,18.1450096 5.0739418,17.5118446 5.46446609,17.1213203 L10.5857864,12 Z" id="Combined-Shape" fill="#000000" opacity="0.3" transform="translate(12.535534, 12.000000) rotate(-360.000000) translate(-12.535534, -12.000000) "/>
        <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg>


											 



											 </a>

					</td>
					
			

				</tr>
			@endforeach
		@endempty

	

	</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-5" >
									<div class="dataTables_info" id="kt_table_1_info" role="status" aria-live="polite">Showing 
										{{($orders->currentpage()-1)*$orders->perpage()+1}} to {{$orders->currentpage()*$orders->perpage()}}
    of  {{$orders->total()}} entries 
									</div>
								</div>
								<div class="col-sm-12 col-md-7 dataTables_pager" >
									<div class="dataTables_length" id="kt_table_1_length">
										<label>
											<select name="kt_table_1_length" aria-controls="kt_table_1" class="custom-select custom-select-sm form-control form-control-sm" id="pagination_size_order"> 
												
												<option value="10" {{ Session::get('pagination_orders')==10?'selected':'' }}>10</option>
												<option value="25" {{ Session::get('pagination_orders')==25?'selected':'' }}>25</option>
												<option value="50" {{ Session::get('pagination_orders')==50?'selected':'' }}>50</option>
												<option value="100" {{ Session::get('pagination_orders')==100?'selected':'' }}>100</option>
											</select>
										</label>
									</div>
									<div class="dataTables_paginate paging_simple_numbers" id="kt_table_1_paginate">
									{{ $orders->render() }}
										
									</div>
						</div></div></div>

									<!--end: Datatable -->
								</div>
							</div>
						</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript">
			$("#status_action").change(function(e){
				e.preventDefault();
				$.get('', {search_status: this.value}, function(data, textStatus, xhr) {
					window.location.reload();
				});
			});
			$("#pagination_size_order").change(function(e) {
				e.preventDefault();
					
				$.post('', {pagination: this.value,_token:'{{ csrf_token() }}'}, function(data, textStatus, xhr) {
						window.location.reload();
				});
			});
	</script>
	<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('.reportrange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    },cb);

    cb(start, end);

});
		$("#search_date").click(function(e){
			e.preventDefault();

			$.get('', {order_search_date: $('.reportrange').val()}, function(data, textStatus, xhr) {
				window.location.reload();
			});
		});

	$("#refresh").click(function(e){
		e.preventDefault();
		$.get('',{refresh:true},function(data) {
			window.location.reload();
		});
	});
	
		
</script>
@endpush