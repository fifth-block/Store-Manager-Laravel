<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<a class="navbar-brand" href="#"><i class="fa fa-cubes "></i></a>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<p class="grettings">Hello {{Auth::user()->username}} <i class="fa fa-smile-o"></i></p>
		</li>
		<li class="dropdown" >
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="{{route('dashboard.settings')}}">
						<i class="fa fa-key"></i> Settings
					</a>
				</li>
				<li>
					<a href="{{route('user.logout')}}">
						<i class="fa fa-sign-out"></i> Logout
					</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
</nav>