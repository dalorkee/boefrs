<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				@role('admin|hospital|lab')
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false"><i class="mdi mdi-speedometer"></i><span class="hide-menu">แดชบอร์ด</span></a></li>
				@endrole
				@role('admin|hospital')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-hospital"></i><span class="hide-menu">โรงพยาบาล </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('code.index') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> สร้างรหัสใหม่</span></a></li>
						<li class="sidebar-item"><a href="{{ route('list') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> รายการข้อมูล</span></a></li>
					</ul>
				</li>
				@endrole
				@role('admin|lab')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-flask"></i><span class="hide-menu">ห้องปฏิบัติการ </span></a>
					<ul aria-expanded="false" class="collapse first-level">
						<li class="sidebar-item"><a href="{{ route('lab') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> รายการข้อมูล</span></a></li>
					</ul>
				</li>
				@endrole
				@role('admin|hospital|lab')
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-poll"></i><span class="hide-menu">รายงาน </span></a>
					<ul aria-expanded="false" class="collapse  first-level">
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> report#1</span></a></li>
						<li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> report#2</span></a></li>
					</ul>
				</li>
				@endrole
				@role('admin')
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('spread') }}" aria-expanded="false"><i class="mdi mdi-google-maps"></i><span class="hide-menu">แผนที่การกระจายของเชื้อ</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a></li>
				@endrole
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
