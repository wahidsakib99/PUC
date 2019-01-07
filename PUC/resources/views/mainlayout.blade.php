<html>

<head>
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Wahid Sakib">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="description" content="Varsity management system | PUAIS">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>
    <link rel="stylesheet" type="text/css" href="/css/mainLayout.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>

<body>
    <!-- WHOLE BODY -->
    <div class="wbody">
        <section class="topbar">
            <!-- TOPBAR STARTS HERE -->

            <ul class="navigate">
                <li class="notifications"><i class="far fa-bell" id="bell"></i><span class="notificationBubble">9</span>
                    <ul class="topul">
                        <li>
                            <span class="icon"></span>
                            <span class="text">Someone Liked your post</span>
                        </li>
                        <li>
                            <span class="icon"></span>
                            <span class="text">Someone Liked you post</span>
                        </li>
                        <li>
                            <span class="icon"></span>
                            <span class="text">Someone Liked you post</span>
                        </li>
                        <li>
                            <span class="icon"></span>
                            <span class="text">Someone Liked you post</span>
                        </li>
                        <li>
                            <span class="icon"></span>
                            <span class="text">Someone Liked you post</span>
                        </li>
                    </ul>
                </li>
                <li style="margin-left: 4px;"><i class="fas fa-user"></i>
                </li>
                <li onclick="window.location.href='/logout'"><i class="fa fa-power-off" id="poweroff"></i></li>
            </ul>


        </section>

        <!-- TOPBAR ENDS HERE -->
        <section class="sidebarAndContent">

            <!-- SIDEBAR CONTENTS STARTS HERE -->
            <div class="Leftcontainer">
                <!-- Sider bar er top information -->

                <center>
                    <h2>PUAIS</h2>
                </center>
                <div class="topinfo">
                    <!--     <div class="far fa-user" style="margin-left: 45%; color: aliceblue;"></div>
                    <br>
                    <p class="user">Admin</p>
                -->
                    <h3 style="color: aliceblue;">PUAIS</h3>
                </div>
                <!-- options with logo -->
                <div class="optionsSide">
                    <ul class="sideul">
                        <li onclick="location.href='{{ url('/dash') }}'" class="{{ Request::is('dash') ? 'active' : '' }}">

                            <i class="fab fa-dashcube"></i><span class="text">Dashboard</span>



                        </li>
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='#'" class="{{ Request::is('student') ? 'active' : '' }}">
                            <i class="fas fa-user"></i><span class="text">Student</span>

                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{route('course.index')}}'" class="{{ Request::is('course') ? 'active' : '' }}">
                            <i class="fab fa-discourse"></i> <span class="text">Course</span>
                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='#'" class="{{ Request::is('semester/*') || Request::is('semester') ? 'active' : '' }}">
                            <i class="fas fa-university"></i> <span class="text">Semester</span>
                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminteacher') }}'" class="{{ Request::is('adminteacher') || Request::is('adminteacher_dean') || Request::is('adminteacher_professors') || Request::is('adminteacher_lecturers')  ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher"></i><span class="text">Teacher</span>
                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ route('session.index') }}'" class="{{ Request::is('session') ? 'active' : '' }}">
                            <i class="fas fa-adjust"></i><span class="text">Session</span>
                        </li>
                        @endif
                         @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminsubject') }}'" class="{{ Request::is('adminsubject_overview') || Request::is('adminsubject_edit') ? 'active' : '' }}">
                            <i class="fas fa-adjust"></i><span class="text">Subject</span>
                        </li>
                        @endif
                        @if(Session::get('admin') == 1 || Session::get('student') == 1)
                        <li onclick="location.href='{{ url('adminroutine') }}'" class="{{ Request::is('adminroutine') ? 'active' : '' }}">
                            <i class="fas fa-object-group"></i><span class="text">Routine</span>

                        </li>
                        @endif
                        @if(Session::get('student') == 1 || Session::get('admin') == 1)
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminresult') }}'" class="{{ Request::is('adminresult')|| Request::is('stu_semester_overview')|| Request::is('stu_result_view') ? 'active' : '' }}">
                            <i class="fas fa-clipboard"></i><span class="text">Result</span>

                        </li>
                        @endif
                        @if(Session::get('student') == 1)
                        <li onclick="location.href='{{ url('stu_semester_overview') }}'" class="{{ Request::is('adminresult')|| Request::is('stu_semester_overview')|| Request::is('stu_result_view') ? 'active' : '' }}">
                            <i class="fas fa-clipboard"></i><span class="text">Result</span>

                        </li>
                        @endif
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminlibrary') }}'" class="{{ Request::is('adminlibrary') || Request::is('adminlibrary_add') ? 'active' : '' }}">
                            <i class="fas fa-book"></i><span class="text">Library</span>

                        </li>
                        @endif
                        @if(Session::get('student') == 1)
                        <li onclick="location.href='{{ url('admincoursefee') }}'" class="{{ Request::is('admincoursefee') ? 'active' : '' }}">
                            <i class="fas fa-dollar-sign"></i><span class="text">Course Fee</span>

                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminsection') }}'" class="{{ Request::is('adminsection') || Request::is('adminsection_edit') || Request::is('adminsection_advisor') ? 'active' : '' }}">

                            <i class="fas fa-list"></i><span class="text">Section</span>


                        </li>
                        @endif
                        @if(Session::get('admin') == 1 || Session::get('teacher') == 1 )
                        <li onclick="location.href='{{ url('adminmail') }}'" class="{{ Request::is('adminmail') ? 'active' : '' }}">

                            <i class="fas fa-mail-bulk"></i> <span class="text">Mail/SMS</span>


                        </li>
                        @endif
                        @if(Session::get('admin') == 1 || Session::get('student') == 1)
                        <li onclick="location.href='{{ url('adminnotice') }}'" class="{{ Request::is('adminnotice') ? 'active' : '' }}">

                            <i class="fas fa-bell"></i><span class="text">Notice</span>


                        </li>
                        @endif
                        @if(Session::get('admin') == 1)
                        <li onclick="location.href='{{ url('adminsetting') }}'" class="{{ Request::is('adminsetting') ? 'active' : '' }}">

                            <i class="	fas fa-cogs"></i><span class="text">Setting</span>


                        </li>
                        @endif
                        @if(Session::get('student') == 1)
                        <li onclick="location.href='{{ url('stuenroll') }}'" class="{{ Request::is('stuenroll') || Request::is('stu_pending') || Request::is('stu_approved') || Request::is('stu_declined') ? 'active' : '' }}">

                            <i class="fas fa-plus"></i><span class="text">Enrollment</span>

                        </li>
                        @endif
                        @if(Session::get('student') == 1)
                        <li onclick="location.href='{{ url('stuadvisor') }}'" class="{{ Request::is('stuadvisor') ? 'active' : '' }}">

                            <i class="fab fa-tripadvisor"></i><span class="text">Advisor</span>


                        </li>
                        @endif
                        @if(Session::get('teacher') == 1)
                        <li onclick="location.href='{{ url('teacherrequestsubject') }}'" class="{{ Request::is('teacherrequestsubject') ? 'active' : '' }}">

                            <i class="fas fa-book-open"></i><span class="text">Request Subject</span>


                        </li>
                        @endif
                        @if(Session::get('teacher') == 1)
                        <li onclick="location.href='{{ url('teacher_pending') }}'" class="{{ Request::is('teacher_pending') ? 'active' : '' }}">

                            <i class="fas fa-pen-alt"></i><span class="text">Pending Request</span>


                        </li>
                        @endif
                        @if(Session::get('student') == 1)
                        <li onclick="location.href='{{ url('stupayment') }}'" class="{{ Request::is('stupayment') ? 'active' : '' }}">

                            <i class="fas fa-credit-card"></i><span class="text">Payment</span>


                        </li>
                        @endif
                        @if(Session::get('advisor') == 1)
                        <li onclick="location.href='{{ url('advising') }}'" class="{{ Request::is('advising') ? 'active' : '' }}">

                            <i class="fas fa-user"></i><span class="text">Advising</span>


                        </li>
                        @endif


                    </ul>
                </div>
            </div>
            <!-- SIDEBAR CONTENTS ENDS HERE -->
            <div class="Rightcontainer">
                <!-- Right Side content starts here -->
                <div class="spacer"></div>
                <div>
                    <p style="font-family: Actor;font-size: 35px;margin: 0; text-align: center">@yield('titleforpage')</p>
                    @yield('rightcontent')
                </div>

                <!-- Right Side content ends here -->
            </div>
        </section>

    </div>

</body>

</html>