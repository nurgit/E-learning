<div class="sidebar-menu">

		<div class="sidebar-menu-inner">

			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
                    <a href="{{route('admin.dashboard')}}">
						<img src="{{ asset('backend/assets/images/pos_logo.png') }}" width="100"  alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>


				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>


			<ul id="main-menu" class="main-menu">
				<!-- add class "multiple-expanded" to allow multiple submenus to open -->
				<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
				<li class="{{ 'home' == request()->path() ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
						<i class="entypo-home"></i>
						<span class="title">Inicio</span>
					</a>

				</li>
                <li class="{{ 'admin.courses' == request()->path() ? 'active' : ''}}">
                    <a href="{{route('admin.courses')}}">
                        <i class="entypo-book"></i>
                        <span class="title">Courses </span>
                    </a>

                </li>
                <li class="{{ 'pos' == request()->path() ? 'active' : ''}}">
                    <a href="{{route('admin.student')}}">
                        <i class="entypo-users"></i>
                        <span class="title">Student</span>
                    </a>

                </li>
                <li class="{{ 'inventory' == request()->path() ? 'active' : ''}}">
                    <a href="{{route('admin.instructor')}}">
                        <i class="entypo-users"></i>
                        <span class="title">Instructor </span>
                    </a>

                </li>
                <li class="{{ 'sales_history' == request()->path() ? 'active' : ''}}">
                    <a href="{{route('admin.tutorial')}}">
                        <i class="entypo-play"></i>
                        <span class="title">Tutorial</span>
                    </a>

                </li>


			</ul>

		</div>

	</div>
