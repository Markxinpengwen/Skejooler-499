		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li>
				@else
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="{{ Gravatar::fallback(asset('la-assets/img/user2-160x160.jpg'))->get(Auth::user()->email) }}" class="user-image" alt="User Image"/>
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<?php
							$uid = Auth::user()->uid;
							if(Auth::user()->type == "student"){
								$array = DB::select('select firstName from students where sid = ? ',[$uid]);
								$array = json_decode(json_encode($array), true);
								$name = $array[0]['firstName'];
							}
							elseif(Auth::user()->type == "center"){
								$array = DB::select('select name from centers where cid = ? ', [$uid]);
								$array = json_decode(json_encode($array), true);
								$name = $array[0]['name'];
							}
							?>
							<span class="hidden-xs">{{ $name }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="{{ Gravatar::fallback(asset('la-assets/img/user2-160x160.jpg'))->get(Auth::user()->email) }}" class="img-circle" alt="User Image" />
								<p>
									{{ $name }}
									<?php
									$datec = Auth::user()['created_at'];
									?>
									<small>Member since <?php echo date("M. Y", strtotime($datec)); ?></small>
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				@endif
				@if(LAConfigs::getByKey('show_rightsidebar'))
				<!-- Control Sidebar Toggle Button -->
				<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-comments-o"></i> <span class="label label-warning"></span></a>

				</li>
				@endif
			</ul>
		</div>