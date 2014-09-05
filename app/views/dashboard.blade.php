@extends('dashboardLayout')

@section('header')
	<title>Dashboard</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-tachometer"></i> Dashboard</h2>
	</div>

	<div class="listwrapper">

		<div class="statistics card today">
			<h4>SELL TODAY</h4>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL ITEM SOLD
					<h1> {{$totalProduct}}</h1>
					
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL UNIT SOLD
					<h1>{{$totalUnit}}</h1>
					
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL SOLD
					<h1>{{$totalSold}} tk</h1>
					
					</div>
				</div>
			</div>


		</div>



		<div class="statistics card today">
			<h4>INVENTORY TODAY</h4>
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL PRODUCTS
					<h1> {{$totalItems}}</h1>
					
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL UNITS
					<h1>{{$totalStock}}</h1>
					
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						TOTAL VALUE OF INVENTORY
					<h1>{{$totalInvest}} tk</h1>
					
					</div>
				</div>
			</div>


		</div>

	</div>
	
@stop