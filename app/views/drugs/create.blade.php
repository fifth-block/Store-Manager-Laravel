@extends('dashboardLayout')

@section('header')
	<title>Add New Items</title>
@stop

@section('body')
	<div class="section-header">
		<h2><i class="fa fa-plus-circle"></i> Add New Items</h2>
	</div>

	{{Form::open(array('route' => 'store.store', 'method'=>'post'))}}
		<div class="row">
			<div class="col-md-7 col-md-offset-5">
				{{Bootstrap::submit('Save', array('class'=> 'btn btn-success pull-right'))}}
			</div>
		</div>
		<div class="col-md-6">
			{{Bootstrap::text('company','Company',Input::get('company'), $errors)}}
			{{Bootstrap::text('medicine_name','Medicine Name', Input::get('medicine_name'), $errors)}}
			{{Bootstrap::date('expire_date','Expire Date', Input::get('expire_date'), $errors,array(), array('format' => 'YYYY-MM-DD'))}}
			{{Bootstrap::text('buy_price','Buy Price (per unit)', Input::get('buy_price'), $errors)}}
			{{Bootstrap::text('sell_price','Sell Price (per unit)', Input::get('sell_price'), $errors)}}
		</div>
		<div class="col-md-6">

			
			
			{{Bootstrap::text('stock_size','Stock Size', Input::get('stock_size'), $errors)}}
			{{Bootstrap::textarea('note_about_stock', 'Note About Stock', Input::get('note_about_stock'), $errors)}}

		</div>
	{{Form::close()}}
@stop

@section('script')
	<script type="text/javascript">
    // Waiting for the DOM ready...
    $(function(){


    	var countries = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  limit: 10,
	  prefetch: {
	    // url points to a json file that contains an array of country names, see
	    // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
	    url: 'http://manager.dev/feeds/companies.json',
	    // the json file contains an array of strings, but the Bloodhound
	    // suggestion engine expects JavaScript objects so this converts all of
	    // those strings
	    filter: function(list) {
	    	console.log(list);
	      return $.map(list, function(country) { return { name: country }; });
	    }
	  }
	});
	 
	// kicks off the loading/processing of `local` and `prefetch`
	countries.clearPrefetchCache();
	countries.initialize();
	 
	// passing in `null` for the `options` arguments will result in the default
	// options being used
	$('#company').typeahead(null, {
	 
	  displayKey: 'name',
	  highlight: true,
	  // `ttAdapter` wraps the suggestion engine in an adapter that
	  // is compatible with the typeahead jQuery plugin
	  source: countries.ttAdapter()
	});


    });

      

  </script>



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
	$('#medicine_name').typeahead(null, {
	  displayKey: 'name',
	  highlight: true,
	  // `ttAdapter` wraps the suggestion engine in an adapter that
	  // is compatible with the typeahead jQuery plugin
	  source: med.ttAdapter()
	});


    });

      

  </script>
@stop