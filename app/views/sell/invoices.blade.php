@extends('dashboardLayout')

@section('header')
	<title>Invoices</title>
@stop

@section('body')
	
	<div class="section-header">
		<h2><i class="fa fa-university"></i> Invoices</h2>		
	</div>

	<div class="clearfix"></div>

	<div class="listWrapper">
		
		{{Form::open(array("method" => "get"), array())}}
			
			<div class="input-group">
				{{Form::text("search", Input::old("search"), array("class" => "form-control"))}}
		      
		      <span class="input-group-btn">
		        <button class="btn btn-info" type="submit">
		        	<i class="fa fa-search"></i> Search
		        </button>
		      </span>
		    </div>				
			
		{{Form::close()}}

		<div class="clearfix" style = "margin-bottom:10px"></div>

		@if(empty($invoice))
			Nothing Found
		@else

		<table class="table table-bordered">
			<tr>
				<th>Invoice ID</th>
				<th>Client Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			@foreach($invoice as $inv)
				<tr>
					<td>{{$inv->invoice_id}}</td>
					<td>{{$inv->name}}</td>
					@if($inv->status == 0)
						<td>Not Paid</td>
					@else
						<td>Paid</td>
					@endif
					<td style="width:150px">
						{{Form::open(array("method" => "delete", "url" => route("invoice.destroy", array($inv->invoice_id))))}}
						<a href="{{route('invoice.show', array($inv->invoice_id))}}" class="btn btn-success btn-xs"><i class="fa fa-search-plus"></i> View</a>
						<button type="submit" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".bag-modal"><i class="fa fa-ban"></i> Delete</button>
						{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</table>

		{{$invoice->links()}}
		
		
	

		@endif

	</div>
	
@stop