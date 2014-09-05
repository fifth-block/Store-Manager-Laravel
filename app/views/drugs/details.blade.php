@extends('dashboardLayout')

@section('header')
	<title>Store</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-hdd-o"></i> Logs <small>{{$title}}</small></h2>
		<a href="{{route("store.create")}}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> New Item</a>
	</div>
	<div class="clearfix"></div>
	<div class="listWrapper">
		@if(empty($inventories))
			Nothing Found
		@else

		<table class="table table-bordered">
			<tr>
				<th>Medicine</th>
				<th>Company</th>
				<th>In Stock</th>
				<th>Expire Date</th>
				<th>Modified On</th>
				<th>Action</th>
			</tr>
			@foreach($inventories as $inventory)
			{{Form::open(array("url" => route("store.delete", array($inventory->id)), "method" => "delete"))}}
				<tr>
					<td>{{$inventory->title}}</td>
					<td>{{$inventory->company->name}}</td>
					<td>{{$inventory->in_stock}}</td>
					<td>{{$inventory->expire_date}}</td>
					<td>{{$inventory->updated_at}}</td>
					<td style="width:140px">

						<a href="{{route('store.edit', array($inventory->id))}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Open</a>
						
						<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i> Delete</button>
						
					</td>
				</tr>
				{{Form::close()}}
			@endforeach
		</table>

		@endif
	</div>
@stop