<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title" id="myModalLabel">SELL AN ITEM</h4>
</div>
<div class="modal-body">

	<div class="well">
		<p>
		<strong>{{$item->title}}</strong> <br>
		{{$item->in_stock}} units in stock.<br>
		Per unit price {{$item->sell_price}} tk.
		</p>
	</div>

	{{Form::open(array("url" => route("sell.addToBag", array($item->id)), "method" => "post"))}}
		{{Bootstrap::text('quantity','Quantity',Input::get('quantity'), $errors, array("required"))}}
		<button type="submit" class="btn btn-success">
			<i class="fa fa-paper-plane"></i> Send to Bag
		</button>
	{{Form::close()}}
</div>
