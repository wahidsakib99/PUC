<html>

<head>
    <title>
       @yield('title')
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="/css/mainlayout.css">
    <!-- FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Cinzel Decorative' rel='stylesheet'>
    <!-- ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
        crossorigin="anonymous">
</head>

<body>
    <div id="topbar" class="sticky-top">
        <!-- TOPBAR -->
        <div id="title">
            <h4 class="float-left" style="font-family: Cinzel Decorative;padding-left: 25px;padding-top: 4px;"><strong>Premier
                    University</strong></h4>
            <div class="float-right">
                <div class="container" style="display: flex">
                    <i class="fas fa-user logos"></i>
                    <i class="fas fa-power-off logos"></i>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div id="flex-items">
        <!-- FLEX ITEMS -->
        <div id="sidebar">
            <!-- SIDEBARS -->
            <!-- NAME OR PROFILE -->
            <h4 class="text-center text-white" id="sidebar-title"></h4>
            <hr style="background: white">
            <!-- LIST OF LINK -->
            <ul class="list-group">
                <li class="list-group-item all-links "><span class="icons"><i class="fab fa-dashcube"></i></span><span>Dashboard</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-user"></i></span><span>Student</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fab fa-discourse"></i></span><span>Course</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-university"></i></span><span>Semester</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-chalkboard-teacher"></i></span><span>Teacher</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-adjust"></i></span><span>Session</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-clipboard"></i></span><span>Result</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-mail-bulk"></i></span><span>Mail/
                        SMS</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-bell"></i></span><span>Notice</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-cogs"></i></span><span>Setting</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-plus"></i></span><span>Enrollment</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fab fa-tripadvisor"></i></span><span>Advisor</span></li>
                <li class="list-group-item all-links "><span class="icons"><i class="fas fa-credit-card"></i></span><span>Payment</span></li>
            </ul>
        </div>
        <div id="contents">
            <!-- CONTENTS -->
            <!-- THIS PART WILL BE YIELDED FOR CONTENTS -->
            <div class="container">
                @yield('rightcontent')
            </div>
        </div>
    </div>
</body>

</html>
