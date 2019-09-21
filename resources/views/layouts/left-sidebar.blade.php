<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false"><i class="mdi mdi-speedometer"></i><span class="hide-menu">Dashboard</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-flask"></i><span class="hide-menu">Form </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="{{ route('code.index') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Create Code</span></a></li>
						<li class="sidebar-item"><a href="{{ route('list-data.index') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> All Data</span></a></li>
						<!-- <li class="sidebar-item"><a href=" URL::route('sample-submission.form') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Lab </span></a></li> -->
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-poll"></i><span class="hide-menu">Report </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> report#1</span></a></li>
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> report#2</span></a></li>
					</ul>
				</li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
