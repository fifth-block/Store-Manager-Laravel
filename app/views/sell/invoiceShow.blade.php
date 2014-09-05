@extends('dashboardLayout')

@section('header')
	<title>Invoices</title>
@stop

@section('body')
	
	<div class="section-header">
		<h2><i class="fa fa-university"></i> Invoices</h2>		
	</div>
	{{Form::open(array("url" => route("invoice.changeStat", array($invoice_id))))}}
	<button type="button" class="btn btn-info" onclick="PrintElem('.printable')"><i class="fa fa-print"></i> Print </button>

	<button type="submit" class="btn btn-success"> <i class="fa fa-check-square-o"></i> Change Status </button>
	{{Form::close()}}
	<div class="clearfix"></div>

	<div class="listWrapper">

		<div class="clearfix" style = "margin-bottom:10px"></div>

		@if(empty($invoice))
			Nothing Found
		@else

		<div class="printable">
		
		<div class="header onlyPrint">
			<p>BANGLADESH PHARMACY</p>
		</div>

		<div class="well">

			<p>Name: {{$invoice[0]->client->name}}</p>
			<p>Date: {{$invoiceStatus->created_at}}</p>
			@if($invoiceStatus->status == 0)
			<div class="badge alert-danger">Status: Not Paid</div>
			@else
			<div class="badge alert-success">Status: Paid</div>
			@endif
		</div>
		
		<table class="table table-bordered">
			<tr>
				<th>Medicine</th>
				<th>Quantity</th>
				<th>Sell Price</th>
				<th></th>
				<th>Subtotal</th>
			</tr>
				@foreach($invoice as $item)
					<tr>
						<td><strong>{{$item->inventories[0]->title}}</strong></td>
						<td>{{$item->quantity}}</td>
						<td>{{$item->inventories[0]->sell_price}} tk</td>
						<td>({{$item->inventories[0]->sell_price}} × {{$item->quantity}})</td>
						<td>{{$item->inventories[0]->sell_price * $item->quantity}} tk.</td>
						
					</tr>
				@endforeach
			<tr>
				<th colspan="4" align="right">Total</th>
				
				<th>{{$total}} tk.</th>
			</tr>
			</table>
			</div>
		
		
	

		@endif

	</div>
	
@stop