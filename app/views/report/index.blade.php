@extends('dashboardLayout')

@section('header')
	<title>Report</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-bar-chart-o"></i> Report<small>Date<small></h2>
		
		<div class="btn-group pull-right">
			<a href="{{route("report.index")}}" class="btn btn-primary">Date</a>
			<a href="{{route("report.range")}}" class="btn btn-primary">Range</a>
			<a href="{{route("report.monthly")}}" class="btn btn-primary">Monthly</a>
			<a href="{{route("report.yearly")}}" class="btn btn-primary">Yearly</a>
		</div>
		<div class="clearfix"></div>
		<hr>
		
		
		<div class="col-md-3">
		{{Form::open(array("method" => "get"))}}
			{{Bootstrap::date("date", "Select a date")}}
			<button type="submit" class="btn btn-success">Generate Report</button>
		{{Form::close()}}
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="listWrapper">
		
		<h2>{{date("D, d M, Y", strtotime($currentDate))}}</h2>
		

		<div class="clearfix" style = "margin-bottom:10px"></div>


		<ul class="nav nav-tabs" role="tablist" id="reportTab">
		  <li class="active"><a href="#sold" role="tab" data-toggle="tab">Product Sold</a></li>
		  <li><a href="#bought" role="tab" data-toggle="tab">Product Bought</a></li>
		</ul>


		<div class="tab-content">
		  <div class="tab-pane active" id="sold">

		  	<br>
		  	@if(empty($productSold))
		  	<div class="alert alert-info">
		  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  		<strong>Oopss!</strong> No Item Sold in {{$currentDate}}
		  	</div>
		  	@else


		  		<table id="productSold" class="table table-striped table-bordered" cellspacing="0" width="100%">

		  			<thead>
		  				<tr>
		  					<th>Product Name</th>
		  					<th>Note</th>
		  					<th>Buy Price</th>
		  					<th>Sell Price</th>
		  					<th>Current Stock</th>
		  					<th>Quantity Sold</th>
		  					<th>Total</th>
		  				</tr>

		  			</thead>

		  			<tfoot>
		  				<tr>
		  					<th colspan="6">Total</th>
		  					<th>{{$productSoldTotal}} tk</th>
		  				</tr>

		  			</tfoot>

		  			<tbody>
		  				@foreach ($productSold as $product)

		  					<tr>
		  						<td>{{$product["title"]}}</td>
		  						<td>{{$product["note"]}}</td>
		  						<td>{{$product["buy_price"]}}</td>
		  						<td>{{$product["sell_price"]}}</td>
		  						<td>{{$product["stock"]}}</td>
		  						<td>{{$product["quantity"]}}</td>
		  						<td>{{$product["total"]}} tk</td>
		  					</tr>

		  				@endforeach

		  			</tbody>

		  		</table>

		  	@endif
		  </div>
		  <div class="tab-pane" id="bought">
		  	<br>
		  	@if($productAdded->isEmpty())
		  	<div class="alert alert-info">
		  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  		<strong>Oopss!</strong> No Item Bought in {{$currentDate}}
		  	</div>
		  	@else



		  		<table id="productAdded" class="table table-striped table-bordered" cellspacing="0" width="100%">

		  			<thead>
		  				<tr>
		  					<th>Product Name</th>
		  					<th>Note</th>
		  					<th>Buy Price</th>
		  					<th>Sell Price</th>
		  					<th>Stock</th>
		  					<th>Total</th>
		  				</tr>

		  			</thead>

		  			<tfoot>
		  				<tr>
		  					<th colspan="5">Total</th>
		  					
		  					<th>{{$productAddedTotal}} tk</th>
		  				</tr>
		  			</tfoot>

		  			<tbody>
		  				@foreach ($productAdded as $product)

		  					<tr>
		  						<td>{{$product->title}}</td>
		  						<td>{{$product->note}}</td>
		  						<td>{{$product->buy_price}}</td>
		  						<td>{{$product->sell_price}}</td>
		  						<td>{{$product->in_stock}}</td>
		  						<td>{{$product->in_stock * $product->buy_price}} tk</td>
		  					</tr>

		  				@endforeach

		  			</tbody>

		  		</table>


		  	@endif


		  </div>
		</div>


	</div>
	
@stop


@section('script')
	

	<script type="text/javascript">

	$('#reportTab a').click(function (e) {
	  		e.preventDefault()
	  		$(this).tab('show')
		});

	$(document).ready(function() {
    	

    	$('#productSold').dataTable({
    	
    		"dom": 'T<"clear">lfrtip',
	        "tableTools": {
	            "sSwfPath": "/assets/js/TableTools-2.0.0/TableTools-2.0.0/media/swf/copy_csv_xls_pdf.swf"
	        }
    	});

    	$('#productAdded').dataTable({
    	
    		"dom": 'T<"clear">lfrtip',
	        "tableTools": {
	            "sSwfPath": "/assets/js/TableTools-2.0.0/TableTools-2.0.0/media/swf/copy_csv_xls_pdf.swf"
	        }
    	});
	});

	</script>
@stop