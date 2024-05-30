<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid" style="color: rgb(0, 136, 255)">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper"  class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->
			
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
					<span class="menu-title">Dashboards</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Blog Post</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->


			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
					<span class="menu-title">Statistics</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->

				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">

						<a class="menu-link {{ request()->routeIs('line-graph.show') ? 'active' : '' }}" href="{{ route('line-graph.show') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Post Created</span>
						</a>

						<a class="menu-link {{ request()->routeIs('TableGraph.show') ? 'active' : '' }}" href="{{ route('TableGraph.show') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">User Creation</span>	
						</a>
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->

		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->