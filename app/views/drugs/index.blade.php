@extends('dashboardLayout')

@section('header')
	<title>Store</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-hdd-o"></i> Store</h2>
		<a href="{{route("store.create")}}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> New Item</a>
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
		<br>

		@if(empty($inventories))
			Nothing Found
		@else

		<table class="table table-bordered">
			<tr>
				<th>Medicine</th>
				<th>In Stock</th>
				<th>Logs</th>
				<th>Action</th>
			</tr>
			@foreach($inventories as $inventory)
				<tr>
					<td>{{$inventory->title}}</td>
					<td>{{$inventory->in_stock}}</td>
					<td>{{$inventory->times}}</td>
					<td style="width:100px">
						<a href="{{route('store.details', array($inventory->title))}}" class="btn btn-info btn-xs"><i class="fa fa-search-plus"></i> View Details</a>
					</td>
				</tr>
			@endforeach
		</table>

		{{$inventories->links()}}
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