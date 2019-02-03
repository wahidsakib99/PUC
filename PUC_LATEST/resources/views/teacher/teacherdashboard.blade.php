@extends('mainlayout')
@section('title')
Teacher | Dashboard
@endsection
@section('rightcontent')
<link rel="stylesheet" href="/css/teacherdashboard.css">
<div class="container">
    <h2>Welcome <span>Teacher</span></h2>
    <div class="row-item">
        <h2 class="text-muted text-center">Overview</h2>
        <hr>
        <div class="container flex-item">
            <div id="first" class="container text-white shadow p-3 mb-5">
                <h5>Advisor Of</h5>
                <h6><strong>0</strong> Section</h6>
            </div>
            <div id="second" class="container text-white shadow p-3 mb-5">
                <h5>Listed For </h5>
                <h6><strong>4</strong> Subjects</h6>
            </div>
            <div id="third" class="container text-white shadow p-3 mb-5">
                <h5>Session</h5>
                <h6>2019 January</h6>
            </div>
        </div>
    </div>
    <br>
    <h2 class="text-muted float-left text-blue">Teaching</h2>
    <button class="btn btn-dark float-right"><u>Show All</u></button>
    <br>
    <hr>
    <ul class="list-group">
        <li class="list-group-item">C1A</li>
        <li class="list-group-item">C1A</li>
    </ul>
    <br>
    <div>
        <h2 class="text-muted float-left">Advisng</h2>
        <button class="btn btn-dark float-right"><u>Show All</u></button>
    </div>
    <br>
    <hr>
    <ul class="list-group">
        <li class="list-group-item">C1A</li>
        <li class="list-group-item">C1A</li>
    </ul>
</div>
<footer style="height: 80px;"></footer>
@endsection