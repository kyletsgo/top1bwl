<div class="leftpanel">
	<div class="logopanel" style="cursor:pointer;">
		<h1> <?php echo env('APP_NAME')?> </h1>
	</div>
	<!-- logopanel -->
	<div class="leftpanelinner">
		<!-- This is only visible to small devices -->
		<div class="visible-xs hidden-sm hidden-md hidden-lg">
			<div class="media userlogged nomargin">
				<div class="media-body">
					<h4>{{ $userName }}</h4>
					<span>Login</span>
				</div>
			</div>
		</div>
        <h5 class="sidebartitle">功能選單</h5>
		<ul id="navLeftMenu" class="nav nav-pills nav-stacked nav-bracket">
			<!-- 選單區段 -->
			<li class='nav-link' id="Dashboard"><a href='{{ asset('backend/') }}' class="dashboard"><i class='fas fa-tachometer-alt'></i><span>DashBoard</span></a></li>
            @foreach ($leftMenu as $menu)
				<li class='nav-parent'><a href='' class='parent-name'><i class='{{ $menu['icon'] }}'></i><span>{{ $menu['name'] }}</span></a>
					<ul class='children'>
						@foreach ($menu['functions'] as $function)
							<li id='{{ str_replace("/", "_", $function['link']) }}' data-level='two' class='{{ strpos(url()->full(), $function['link']) > 0 ? 'active' : '' }}'>
								<a href='{{ asset($function['link']) }}'>
									<i class='fa fa-caret-right'></i>
									<span>{{ $function['name'] }}</span>
								</a>
							</li>
						@endforeach
					</ul>
				</li>
            @endforeach
		</ul>
	</div>
	<!-- leftpanelinner -->
</div>
