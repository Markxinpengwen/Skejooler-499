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
                    <?php
                    $uid = Auth::user()->uid;
                    if(Auth::user()->type == "student"){
                        $array = DB::select('select firstName from students where sid = ? ',[$uid]);
                        $array = json_decode(json_encode($array), true);
                        $name = $array[0]['firstName'];
                    }
                    elseif(Auth::user()->type == "center"){
                        $array = DB::select('select center_name from centers where cid = ? ', [$uid]);
                        $array = json_decode(json_encode($array), true);
                        $name = $array[0]['center_name'];
                    }
                    ?>
                    <p>{{ $name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">FUNCTIONS</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{url('/center/profile') }}"></i> <span>Profile</span></a></li>
            <li><a href="{{url('/center/schedule') }}"></i> <span>Schedule</span></a></li>

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
