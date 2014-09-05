@extends('dashboardLayout')

@section('header')
	<title>Sell</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-cube"></i> Sell</h2>
		<div class="btn-group pull-right">
		{{Form::open(array("url" => route("sell.emptyBag")))}}
		@if($bag < 1)
			<a href="{{route('sell.showBag')}}" class="btn disabled"><span class="badge">{{$bag}}</span> Open Bag</a>
			<button type="submit" class="btn btn-danger disabled"><i class="fa fa-trash-o"></i> Empty Bag</button>
		@else
			
			<a href="{{route('sell.showBag')}}" class="btn btn-primary"><span class="badge">{{$bag}}</span> Open Bag</a>
			<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Empty Bag</button>
		@endif
		</div>
		{{Form::close()}}
	</div>
	<div class="clearfix"></div>

	<div class="listWrapper">
		

		{{Form::open(array("method" => "get"))}}
			
			<div class="input-group search">
				{{Form::text("search", $searchKey, array("class" => "form-control search"))}}
		      
		      <span class="input-group-btn">
		        <button class="btn btn-info" type="submit">
		        	<i class="fa fa-search"></i> Search
		        </button>
		      </span>
		    </div>				
			
		{{Form::close()}}

		<div class="clearfix" style = "margin-bottom:10px"></div>

		@if(empty($inventories))
			Nothing Found
		@else

		<table class="table table-bordered">
			<tr>
				<th>Medicine</th>
				<th>In Stock</th>
				<th>Buy Price</th>
				<th>Sell Price</th>
				<th>Expire Date</th>
				<th>Action</th>
			</tr>
			@foreach($inventories as $inventory)
				<tr>
					<td>{{$inventory->title}}</td>
					<td>{{$inventory->in_stock}}</td>
					<td>{{$inventory->buy_price}}</td>
					<td>{{$inventory->sell_price}}</td>
					<td>{{date("d F, Y",strtotime($inventory->expire_date))}}</td>
					<td style="width:100px">
						<a href="{{route('sell.toBag', array($inventory->id))}}" class="btn btn-success btn-xs" data-toggle="modal" data-target=".bag-modal"><i class="fa fa-paper-plane"></i> Send to bag</a>
					</td>
				</tr>
			@endforeach
		</table>

		{{$inventories->links()}}
		
		
		<div class="modal bag-modal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-sm">

		    <div class="modal-content">
		      ...
		    </div>
		  </div>
		</div>

		@endif




	</div>
	
@stop


@section('script')
	
	<script type="text/javascript">
    // Waiting for the DOM ready...
    $(function(){


    	var med = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  limit: 10,
	  prefetch: {
	    // url points to a json file that contains an array of country names, see
	    // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
	    url: 'http://manager.dev/feeds/medicine_name.json',
	    // the json file contains an array of strings, but the Bloodhound
	    // suggestion engine expects JavaScript objects so this converts all of
	    // those strings
	    filter: function(list) {
	    	console.log(list);
	      return $.map(list, function(meduc) { return { name: meduc }; });
	    }
	  }
	});
	 
	// kicks off the loading/processing of `local` and `prefetch`
	med.clearPrefetchCache();
	med.initialize();
	 
	// passing in `null` for the `options` arguments will result in the default
	// options being used
	$('.search').typeahead(null, {
	  displayKey: 'name',
	  highlight: true,
	  // `ttAdapter` wraps the suggestion engine in an adapter that
	  // is compatible with the typeahead jQuery plugin
	  source: med.ttAdapter()
	});


    });

      

  </script>

@stop