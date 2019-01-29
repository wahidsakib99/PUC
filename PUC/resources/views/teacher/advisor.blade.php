@extends('mainlayout')
@section('title')
Teacher | Advisor
@endsection
@section('titleforpage')
Advising
@endsection
@section('rightcontent')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="msg" style="display: none"></div> <!-- DIV FOR SHOWING ERROR MESSAGES -->
<div class="container">
    <h3 id="sectionname"></h3>
    <ul class="nav nav-tabs">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Semester<span class="caret"></span></a>
            <ul class="dropdown-menu" id="sectionslist">
            </ul>
        </li>
        <li class="active"><a data-toggle="tab" href="#pending">Pending</a></li>
        <li><a data-toggle="tab" href="#approved" onclick="showapproved()">Approved</a></li>
    </ul>

    <div class="tab-content">
        <div id="pending" class="tab-pane fade in active" style="background: white;">
            <table class="table table-striped" id="pendingtable" style="max-height: 73%;overflow-y: auto;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Section</th>
                        <th>Type</th>
                        <th>Accept</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="pendingtbody">

                </tbody>
            </table>
        </div>

        <div id="approved" class="tab-pane fade in" style="background: white">
            <table class="table table-striped" id="approvedtable" style="max-height: 73%;overflow-y: auto">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="approvedtbody">

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    function hidemsg() {
        var n = document.getElementById('msg');
        n.style.display = 'none';
    }

    function retakeorrecourse(type) {
        if (type === 0)
            return 'Regular';
        else if (type === 1)
            return 'Retake';
        else
            return 'Recourse';
    }

    $('document').ready(function () {

        var sectionlist = document.getElementById('sectionslist');
        $.ajax({
            url: 'getsectionlist',
            method: 'get',
            success: function (data) {
                var sections = data['data'];
                var tablerow = ' ';
                if (data['hassection'] === true) {
                    for (var i = 0; i < sections.length; i++) {
                        tablerow = tablerow + "<li onclick='showstudentlistforadvisor(" + sections[
                            i].id + ")'><a>" + sections[i].name + "</a></li>"
                    }
                    sectionlist.innerHTML = tablerow;
                    showstudentlistforadvisor(sections[0].id);
                } else {
                    var errors =
                        "<div class='alert alert-danger'><strong></strong>&nbsp;Something Went Wrong.</div>";
                    document.getElementById('msg').innerHTML = errors;
                    document.getElementById('msg').style.display = 'block';
                    var hide = setTimeout(hidemsg, 4000);
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    });
    var sec_id;

    function showstudentlistforadvisor(id) {
        sec_id = id;
        $.ajax({
            url: 'showstudentlistforadvisor/' + id,
            method: 'get',
            success: function (data) {
                if (data['hasdata'] === true) {
                    var datas = data['data'];
                    var tablerow = ' ';
                    if (datas[0].length > 0) {
                        for (var i = 0; i < datas.length; i++) {
                            for (var j = 0; j < datas[i].length; j++) {
                                var temp_data_holder = datas[i];
                                tablerow = tablerow + "<tr><td>" + temp_data_holder[j].uname + "</td><td>" +
                                    temp_data_holder[j].student_id + "</td><td>" + temp_data_holder[j].subname +
                                    "</td><td>" + temp_data_holder[j].secname + "</td><td>" +
                                    retakeorrecourse(temp_data_holder[j].type) +
                                    "</td><td><button type='button' class='btn btn-success' onclick='acceptpending(" +
                                    temp_data_holder[j].id +
                                    ")'>Accept</button></td><td><button type='button' class='btn btn-danger' onclick='deletepending(" +
                                    temp_data_holder[j].id + ")'>Decline</button></td></tr>";
                            }

                        }
                        document.getElementById('pendingtbody').innerHTML = tablerow;
                        document.getElementById('pendingtable').style.display = '';
                    } else {
                        var errors =
                            "<div class='alert alert-danger'><strong></strong>&nbsp;Nothing Pending. </div>";
                        document.getElementById('msg').innerHTML = errors;
                        document.getElementById('msg').style.display = 'block';
                        document.getElementById('pendingtable').style.display = 'none';
                        var hide = setTimeout(hidemsg, 4000);
                    }
                } else {
                    var errors =
                        "<div class='alert alert-danger'><strong></strong>&nbsp;0 student enrolled for this section yet. </div>";
                    document.getElementById('msg').innerHTML = errors;
                    document.getElementById('msg').style.display = 'block';
                    document.getElementById('pendingtable').style.display = 'none';
                    var hide = setTimeout(hidemsg, 4000);
                }
                document.getElementById('sectionname').innerHTML = "Section: " + data['section_name'];
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function showapproved() {

        $.ajax({
            url: 'showapprovedadvisor/' + sec_id,
            method: 'get',
            success: function (data) {
                var datas = data['data'];
                var tablerow = ' ';
                if (data['hasdata'] === true) {
                    if (datas[0].length > 0) {
                        for (var i = 0; i < datas.length; i++) {
                            for (var j = 0; j < datas[i].length; j++) {
                                var temp_data_holder = datas[i];
                                tablerow = tablerow + "<tr><td>" + temp_data_holder[j].uname + "</td><td>" +
                                    temp_data_holder[j].student_id + "</td><td>" + temp_data_holder[j].subname +
                                    "</td><td>" + temp_data_holder[j].secname + "</td><td>" +
                                    retakeorrecourse(temp_data_holder[j].type) +
                                    "</td><td><button type='button' class='btn btn-danger' onclick='makepending(" +
                                    temp_data_holder[j].id + ")'>Make Pending</button></td></tr>";
                            }

                        }
                        document.getElementById('approvedtbody').innerHTML = tablerow;
                        document.getElementById('approvedtable').style.display = '';
                    } else {
                        var errors =
                            "<div class='alert alert-danger'><strong></strong>&nbsp;Nothing Approved. </div>";
                        document.getElementById('msg').innerHTML = errors;
                        document.getElementById('msg').style.display = 'block';
                        document.getElementById('approvedtable').style.display = 'none';
                        var hide = setTimeout(hidemsg, 4000);
                    }
                } else {
                    var errors =
                        "<div class='alert alert-danger'><strong></strong>&nbsp;Nothing Approved.</div>";
                    document.getElementById('msg').innerHTML = errors;
                    document.getElementById('msg').style.display = 'block';
                    document.getElementById('approvedtable').style.display = 'none';
                    var hide = setTimeout(hidemsg, 4000);
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function acceptpending(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'acceptpending/' + id,
            method: 'post',
            success: function (data) {
                if (data['update'] === true) {
                    showstudentlistforadvisor(sec_id);
                    var errors = "<div class='alert alert-success'><strong>Success !!</strong>&nbsp;</div>";
                    document.getElementById('msg').innerHTML = errors;
                    document.getElementById('msg').style.display = 'block';
                    document.getElementById('approvedtable').style.display = 'none';
                    var hide = setTimeout(hidemsg, 3000);
                } else {
                    console.log("WELL PLAYED :-)");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function deletepending(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'deletepending/' + id,
            method: 'post',
            success: function (data) {
                if (data['delete'] === true) {
                    showstudentlistforadvisor(sec_id);
                    var errors = "<div class='alert alert-success'><strong>Success !!</strong>&nbsp;</div>";
                    document.getElementById('msg').innerHTML = errors;
                    document.getElementById('msg').style.display = 'block';
                    document.getElementById('approvedtable').style.display = 'none';
                    var hide = setTimeout(hidemsg, 3000);
                } else {
                    console.log("WELL PLAYED :-)");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

    function makepending(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'makepending/' + id,
            method: 'post',
            success: function (data) {
                if (data['pending'] === true) {
                    showapproved();
                    showstudentlistforadvisor(sec_id);
                    // showapproved();
                } else {
                    console.log("WELL PLAYED :-)");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    }

</script>
