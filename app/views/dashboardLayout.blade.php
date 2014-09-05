<!DOCTYPE html>
<html lang="">
	<head>
		
		<meta charset="UTF-8">
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS -->
		{{Bootstrap::css('local', ['type' => 'text/css'])}}
		<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/js/TableTools-2.0.0/TableTools-2.0.0/media/css/TableTools.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/dataTables.bootstrap.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/app.css">
		{{Bootstrap::js('local', ['type' => 'text/javascript'])}}
		<script type="text/javascript" src="/assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/assets/js/dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="/assets/js/TableTools-2.0.0/TableTools-2.0.0/media/js/TableTools.min.js"></script>
		@yield('header')
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@include('shorts.top-nav')
				</div>
			</div>
			
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-2 sidebar">
					
						@include('shorts.sidebar-nav')
				
				</div>

				<div class="body col-md-10">
					@yield('body')
				</div>
			</div>
		</div>
		


		

		@yield('script')

		<script type="text/javascript">
			$(function(){
				if($('div.body').outerHeight() > $('div.sidebar').outerHeight())
					$('div.sidebar').outerHeight($('div.body').outerHeight());


				$('body').on('hidden.bs.modal', '.modal', function () {
				  $(this).removeData('bs.modal');
				});
			});

			function PrintElem(elem)
				    {
				        Popup($(elem).html());
				    }

				    function Popup(data) 
				    {
				        var mywindow = window.open('', 'my div', 'height=400,width=600');
				        mywindow.document.write('<html><head><title>my div</title>');
				        mywindow.document.write('<link type="text/css" media="all" rel="stylesheet" href="http://manager.dev/assets/css/bootstrap.min.css">');
				        mywindow.document.write('</head><body >');
				        mywindow.document.write(data);
				        mywindow.document.write('</body></html>');

				        mywindow.print();
				        mywindow.close();

				        return true;
				    }
		</script>
	</body>
</html>