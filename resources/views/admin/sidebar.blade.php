<!-- Sidebar Left -->
<div class="sidebar left-side" id="sidebar-left">

	<!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
	<div class="nicescroll">
		<div class="wrapper" style="margin-bottom:90px">
			<ul class="nav nav-sidebar" id="sidebar-menu">

				@if (auth()->user()->usertype == 'Admin')
				<li class="{{classActivePath('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}"><i
							class="fa fa-dashboard"></i>Dashboard</a></li>

				<li class="{{classActivePath('staffs')}}"><a href="{{route('staffs.index')}}"><i
							class="fa fa-cart-plus"></i>Order
						List</a></li>

				<li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}"><i
							class="fa fa-users"></i>Users</a></li>

				<li class="{{classActivePath('widgets')}}"><a href="{{ URL::to('admin/widgets') }}"><i
							class="fa fa-plus"></i>Widgets</a></li>

				<li class="{{classActivePath('settings')}}"><a href="{{ URL::to('admin/settings') }}"><i
							class="md md-settings"></i>Settings</a></li>

				<li class="{{classActivePath('packages')}}"><a href="{{route('packages.index')}}"><i
							class="fa fa-bell-o"></i>Packages</a></li>

				<li class="{{classActivePath('subscriptions')}}"><a href="{{route('subscription.index')}}"><i
							class="fa fa-bell-o"></i>Subscriptions</a></li>

				<li class="{{classActivePath('categories')}}"><a href="{{route('category.index') }}"><i
							class="fa fa-folder"></i>Categories</a></li>

				<li class="{{classActivePath('menus')}}"><a href="{{route('menus.index') }}"><i
							class="fa fa-folder"></i>Menu</a></li>

				<li class="{{classActivePath('delivery_staff')}}"><a href="{{route('user.staff') }}"><i
							class="fa fa-folder"></i>Delivery Staff</a></li>
				@else
				<li class="{{classActivePath('staffs')}}"><a href="{{route('staffs.index')}}"><i
							class="fa fa-cart-plus"></i>Order List</a></li>
				@endif
			</ul>

		</div>
	</div>
</div>
<!-- // Sidebar -->

<!-- Sidebar Right -->
<div class="sidebar right-side" id="sidebar-right">
	<!-- Wrapper Reqired by Nicescroll -->
	<div class="nicescroll">
		<div class="wrapper">
			<div class="block-primary">
				<div class="media">
					<div class="media-left media-middle">
						<a href="#">
							@if(isset(Auth::user()->image_icon))
							<img src="/storage/user-image/{{ Auth::user()->image_icon }}" alt="person" width="60"
								class="img-circle border-white">
							@else
							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person"
								class="img-circle border-white" width="60" />
							@endif
						</a>
					</div>
					<div class="media-body media-middle">
						<a href="{{ URL::to('admin/profile') }}" class="h4">{{ Auth::user()->first_name }} {{
							Auth::user()->last_name }}</a>
						<a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i
								class="md md-exit-to-app"></i></a>
					</div>
				</div>
			</div>
			<ul class="nav nav-sidebar" id="sidebar-menu">
				<li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i> Account</a></li>

				@if(Auth::user()->usertype=='Admin')

				<li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i> Settings</a></li>

				@endif

				<li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i> Logout</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- // Sidebar -->