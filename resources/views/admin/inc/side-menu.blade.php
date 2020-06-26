<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse" aria-expanded="false" style="height: 0px;">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <?php $route_name = \Request::route()->getName(); ?>

            <li class="nav-item <?php echo ($route_name == 'admin.home' ) ? "start active open" : ""?>">
                <a href="{{ route('admin.home') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <?php echo ($route_name == 'admin.home' ) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">User Management</h3>
            </li>
            <?php  $user_routes_names = array('admin.list','admin.users.add');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('admin.list') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Users</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Student Management</h3>
            </li>
            <?php  $user_routes_names = array('admin.students.list','admin.students.add', 'admin.students.add.bulk');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('admin.students.list') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Student</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <?php  $user_routes_names = array('teachers.list.get','teachers.add.get', 'teachers.edit.get');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('teachers.list.get') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Teachers</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <?php  $user_routes_names = array('subjects.list.get','subjects.add.get', 'subjects.edit.get');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('subjects.list.get') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Subjects</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <?php  $user_routes_names = array('virtual.classes.list.get','virtual.classes.add.get', 'virtual.classes.edit.get', 'virtual.classes.session.get', 'virtual.classes.payment.get');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('virtual.classes.list.get') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Virtual Classes</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
            <?php  $user_routes_names = array('banner.get');?>
            <li class="nav-item <?php echo (in_array($route_name, $user_routes_names)) ? "start active open" : ""?>">
                <a href="{{ route('banner.get') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Banners</span>
                    <?php echo (in_array($route_name, $user_routes_names)) ? "<span class='selected'></span>" : ""?>
                </a>
            </li>
        </ul>
    </div>
</div>