<ul class="nav nav-sidebar">

	@if(Session::get("current") == "dashboard")
		<li class="active">
	@else
		<li>
	@endif
		<a href="{{route('dashboard.index')}}" id="dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
	</li>
	<li class="divider"></li>
	
	@if(Session::get("current") == "store")
		<li class="active">
	@else
		<li>
	@endif
		<a href="{{route('store.index')}}" id="store"><i class="fa fa-hdd-o"></i> Store</a>
	</li>
	<li class="divider"></li>

	@if(Session::get("current") == "sell")
		<li class="active">
	@else
		<li>
	@endif	
		<a href="{{route('sell.index')}}" id="sell"><i class="fa fa-cube"></i> Sell</a>
	</li>
	<li class="divider"></li>

	@if(Session::get("current") == "invoice")
		<li class="active">
	@else
		<li>
	@endif	
		<a href="{{route('invoice.index')}}" id="sell"><i class="fa fa-university"></i> Invoice</a>
	</li>
	<li class="divider"></li>



	@if(Session::get("current") == "report")
		<li class="active">
	@else
		<li>
	@endif	
		<a href="{{route('report.index')}}" id="report"><i class="fa fa-bar-chart-o"></i> Report</a>
	</li>
	<li class="divider"></li>

</ul>