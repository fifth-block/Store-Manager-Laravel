@extends('dashboardLayout')

@section('header')
	<title>Sell</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-cube"></i> SELLING Bag</h2>

		
		<div class="btn-group pull-right">
		{{Form::open(array("url" => route("sell.emptyBag")))}}
		@if($bag < 1)
			<a href="{{route('sell.showBag')}}" class="btn disabled"><span class="badge">{{$bag}}</span> Open Bag</a>
			<button type="submit" class="btn btn-danger disabled"><i class="fa fa-trash-o"></i> Empty Bag</button>
		@else
			
			<a href="{{route('sell.showBag')}}" class="btn btn-primary disabled"><span class="badge">{{$bag}}</span> Open Bag</a>
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Empty Bag</button>
		@endif
		{{Form::close()}}
		</div>
		
		{{Form::open(array("url" => route("invoice.create"), 'class' => 'form-inline'))}}
		<div class="input-group pull-left" style="margin-right:5px">
		
		@if($items->isEmpty())
			<div class="form-group">
				<div class="input-group">
      <div class="input-group-addon">Client Name</div>
			{{Form::text('client_name', Input::old('client_name'), array('class' => 'form-control disabled'))}}
				</div>
			</div>
			<div class="form-group">
			<button type="submit" class="btn btn-success disabled">Create Invoice</button>
			</div>
		@else
			<div class="form-group">
				<div class="input-group">
      <div class="input-group-addon">Client Name</div>
			{{Form::text('client_name', Input::old('client_name'), array('class'=>'form-control'))}}
				</div>
			</div>
			<div class="form-group">
			<button type="submit" class="btn btn-success">Create Invoice</button>
			</div>
		@endif
		{{Form::close()}}
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="listWrapper">
		

		@if($items->isEmpty())
				
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Nothing Found!</strong> Add items in bag..
			</div>

			
		@else

			<table class="table table-bordered">
			<tr>
				<th>Medicine</th>
				<th>Quantity</th>
				<th>Sell Price</th>
				<th>Subtotal</th>
				<th>Action</th>
			</tr>
				@foreach($items as $item)
					<tr>
						<td><strong>{{$item->inventory->title}}</strong></td>
						<td>{{$item->quantity}}</td>
						<td>{{$item->inventory->sell_price}}</td>
						<td>{{$item->inventory->sell_price * $item->quantity}}</td>
						<td style="width:100px">
							<a href="{{route('sell.toBag', array($item->id))}}" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".bag-modal"><i class="fa fa-trash-o"></i> Remove</a>
						</td>
					</tr>
				@endforeach
			<tr>
				<th colspan="3" align="right">Total</th>
				<th>{{$total}}</th>
				<th></th>
			</tr>
			</table>

		@endif




	</div>
	
@stop