<div class="sidebar-menu">

		<div class="sidebar-menu-inner">

			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
                    <a href="{{url('teacher/dashboard')}}">
						<img src="{{ asset('backend/assets/images/logo.svg') }}" width="100"  alt="" />
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
                    <a href="{{url('teacher/dashboard')}}">
						<i class="entypo-home"></i>
						<span class="title">Home</span>
					</a>

				</li>
                <li class="{{ 'clients' == request()->path() ? 'active' : ''}}">
                    <a href="{{url('teacher/course')}}">
                        <i class="entypo-book"></i>
                        <span class="title">Courses </span>
                    </a>

                </li>
                <li class="{{ 'pos' == request()->path() ? 'active' : ''}}">
                    <a href="{{url('teacher/student')}}">
                        <i class="entypo-users"></i>
                        <span class="title">Student</span>
                    </a>

                </li>
				<li  class="has-sub">
                    <a href="">
                        <i class="entypo-book"></i>
                        <span class="title">Assignment </span>
                    </a>
                    <ul>
						<li class="{{ 'sales_report' == request()->path() ? 'active' : ''}}">
							<a href="{{url('teacher/assignment')}}">
                                <i class="entypo-credit-card"></i>
								<span class="title">Upload Assignment</span>
							</a>
						</li>
						<li class="{{ 'cleared_sales_report' == request()->path() ? 'active' : ''}}">
							<a href="{{url('teacher/checkAssignment')}}">
                                <i class="entypo-check"></i>
							<span class="title">Check Assignment</span>
                        </a>
                        </li>
                    </ul>
                </li>

                         

                    <li class="{{ 'inventory' == request()->path() ? 'active' : ''}}">
                        <a href="{{url('teacher/quz')}}">
                            <i class="entypo-book"></i>
                            <span class="title">QUZ </span>
                        </a>

                    </li>
          

                {{-- <li class="{{ 'inventory' == request()->path() ? 'active' : ''}}">
                    <a href="{{url('teacher/test')}}">
                        <i class="entypo-book"></i>
                        <span class="title">Test </span>
                    </a>

                </li> --}}


                <li class="{{ 'sales_history' == request()->path() ? 'active' : ''}}">
                    <a href="{{url('teacher/lectureNote')}}">
                        <i class="entypo-play"></i>
                        <span class="title">Lecture Note</span>
                    </a>

                </li>


			</ul>

		</div>

	</div>
