@extends('mainlayout')
@section('title')
Student | Profile
@endsection
@section('titleforpage')
@endsection
@section('rightcontent')
<style>
    .panel-body {
    padding: 15px;
}
*, *:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
div {
    display: block;
}
.profile-widget {
    text-align: center;
}
body {
    background: white;
    font-family: 'Lato', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 14px !important;
}
body {
    background: white;
    font-family: Lato;
    font-size: 14px;
    line-height: 1.428571429;
}
html {
    font-size: 62.5%;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
html {
    font-family: sans-serif;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
.panel-body:before, .panel-body:after {
    content: " ";
    display: table;
}
.panel-body:before, .panel-body:after {
    content: " ";
    display: table;
}
*, *:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.panel-body:after {
    clear: both;
}
.panel-body:before, .panel-body:after {
    content: " ";
    display: table;
}
.panel-body:after {
    clear: both;
}
.panel-body:before, .panel-body:after {
    content: " ";
    display: table;
}
*, *:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <!-- bootstrap theme -->
    <!--external css-->
    <!-- font icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <!-- Custom styles -->
    <link href="/css/profile.css" rel="stylesheet">
    <link href="https://bootstrapmade.com/demo/themes/NiceAdmin/css/style-responsive.css" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <script src="js/lte-ie7.js"></script>
      <![endif]-->

    <!-- =======================================================
        Theme Name: NiceAdmin
        Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
      ======================================================= -->
</head>
@if (!$error)
@foreach ( $data as $d )
<div class="container" style="overflow-y: auto;">
    <div class="panel-body">
        <div class="col-lg-2 col-sm-2">
            <h4 name="name">{{$d->name}}</h4>
            <div class="follow-ava">
                <img src="https://bootstrapmade.com/demo/themes/NiceAdmin/img/profile-widget-avatar.jpg" alt="">
            </div>
            <h6 id="role">Student</h6>
        </div>
        <div class="col-lg-4 col-sm-4 follow-info">
            <p>Hello I’m <span>{{$d->name}}</span><span id="about">I Am From CHATTAGRAM</span></p>
            <p>{{$d->user_id}}</p>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
        <li><a data-toggle="tab" href="#eprofile">Edit Profile</a></li>
    </ul>

    <div class="tab-content">
        <div id="profile" class="tab-pane fade in active">
            <div class="panel-body bio-graph-info" style="background: #eeeeee">
                <h1>Bio Graph</h1>
                <div class="row">
                    <div class="bio-row">
                        <p><span> Name </span>: {{$d->name}}</p>
                    </div>
                    {{-- <div class="bio-row">
                        <p><span>Last Name </span>: Smith</p>
                    </div> --}}
                    <div class="bio-row">
                        <p><span>Birthday</span>: <span>{{$d->bdate}}</span></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Email </span>:<span>{{$d->email}}</span></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Mobile </span>: <span>{{$d->phoneno}}</span></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Gender </span>: <span>@if ($d->gender == "M") MALE @else FEMALE @endif</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="eprofile" class="tab-pane fade in" style="background: #eeeeee">
            <div id="edit-profile" class="tab-pane active">
                <section class="panel">
                    <div class="panel-body bio-graph-info" style="overflow-y: auto;max-height: 60%;">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form" method="POST" action="saveprofile/{{$d->id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="name" placeholder={{$d->name}} value={{old('name')}}>
                                    @if ($errors->has('name'))<p style="color:red">Fill Up Name Correctly</p> @endif
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-lg-2 control-label">About Me</label>
                                <div class="col-lg-10">
                                    <textarea name="" name="" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label class="col-lg-2 control-label">Country</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="c-name" placeholder=" ">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Birthday</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="bdate" placeholder={{$d->bdate}}
                                        value={{old('bdate')}}>
                                    @if ($errors->has('bdate'))<p style="color:red">Not a valid Birthday</p> @endif
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-lg-2 control-label">Occupation</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="occupation" placeholder=" ">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control" name="email" placeholder={{$d->email}}
                                        value={{old('email')}}>
                                    @if ($errors->has('email'))<p style="color:red">Not a valid email</p> @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mobile</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="mobile" placeholder={{$d->phoneno}}
                                        value={{old('mobile')}}>
                                    @if ($errors->has('mobile'))<p style="color:red">'Phone No.' required</p> @endif
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-lg-2 control-label">Website URL</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="url" placeholder="http://www.demowebsite.com ">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Gender</label>
                                <div class="col-lg-6">
                                    <select name="gender">
                                        <option value="M">MALE</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    {{-- <button type="button" class="btn btn-danger">Cancel</button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endforeach
@else

@endif
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

</script>
