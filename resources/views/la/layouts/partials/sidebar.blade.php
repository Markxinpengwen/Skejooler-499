<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::fallback(asset('la-assets/img/user2-160x160.jpg'))->get(Auth::user()->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Admin</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">FUNCTIONS</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{url('/admin') }}"></i> <span>Users</span></a></li>
            <li><a href="{{url('la/students') }}"></i> <span>Students</span></a></li>
            <li><a href="{{url('la/centers') }}"></i> <span>Centers</span></a></li>
            <li><a href="{{url('la/requests') }}"></i> <span>Requests</span></a></li>


            <?php
            $menuItems = Dwij\Laraadmin\Models\Menu::where("parent", 0)->orderBy('hierarchy', 'asc')->get();
            ?>
            @foreach ($menuItems as $menu)
                @if($menu->type == "module")
                    <?php
                    $temp_module_obj = Module::get($menu->name);
                    ?>
                    @la_access($temp_module_obj->id)
						@if(isset($module->id) && $module->name == $menu->name)
                        	<?php echo LAHelper::print_menu($menu ,true); ?>
						@else
							<?php echo LAHelper::print_menu($menu); ?>
						@endif
                    @endla_access
                @else
                    <?php echo LAHelper::print_menu($menu); ?>
                @endif
            @endforeach
            <!-- LAMenus -->
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
