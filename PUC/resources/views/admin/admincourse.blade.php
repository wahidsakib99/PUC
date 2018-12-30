@extends('mainlayout')
@section('title')
Admin | Course
@endsection
@section('titleforpage')
Course
@endsection
@section('rightcontent')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
        .drop {
            width: 230px;
            text-align: center;
            margin-top: 4px;
            height: 30px;
            background: white;
    
        }
    
        thead tr:nth-child(1) th {
            background: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }
    
</style>


<div id="msg" style="display: none"></div> <!-- DIV FOR SHOWING ERROR MESSAGES -->

<div class="container">
    <h3 id="semesterno"></h3><!-- FOR SHOWING SEMESTER -->
    <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#myModal">Add Course</button>

    <ul class="nav nav-tabs">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Semester<span class="caret"></span></a>
                <ul class="dropdown-menu" id="semesters">
                </ul>
            </li>
    </ul>


    <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-y:auto ; height: 73%;">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th><input type="checkbox" id="checkall" /></th>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Credit</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </thead>
                        <tbody id="coursetbody">

                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Course</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="drop" name="semester" id="value_of_semester">
                        </select>
                        <br />
                        <br />
                        <label for="usr">Add course name:</label>
                        <input type="text" class="form-control" id="name" name="subject_name" required>
                        <label for="usr">Course code :</label>
                        <input type="text" class="form-control" id="code" name="subject_code" required>
                        <label for="usr">Credit :</label>
                        <input type="text" class="form-control" id="credit" name="credit" required>
                        <div id="errormessages" style="display: none"></div> <!-- SHOW THIS MESSAGE IF USER DIDNT SELECT ANY SEMESTER -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="add_subject_button" onclick="savesubject()">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " type="text" id="subject_name"  name="subject_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="text"  id="subject_code" name="subject_code">
                    </div>
                    <div class="form-group">
                        <input class="form-control " type="text" id="subject_credit" name="subject_credit">
                    </div>
                    <div class="form-group">
                            <input class="form-control " type="hidden" id="id" name="id">
                        </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" style="width: 100%;" onclick="updatesubject()"><span class="glyphicon glyphicon-ok-sign" onclick="updatesubject()"></span>Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Headingdelete">Delete this entry</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete <strong id="subjectname"></strong></div>
                        <input type="hidden" id="delelteid" >
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" onclick="deletesubject()"><span class="glyphicon glyphicon-ok-sign" ></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>
                </div>
                <!-- Delete modal ends -->
                <!-- /.modal-content -->
            </div>
        </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    function hidemsg()
    {
        var n = document.getElementById('msg');
        n.style.display = 'none';
    }
    function sup(name)
    {
        var sup;
        if(name === '1')
        {
            sup = name+"<sup>st</sup>";
        }
        else if(name === '2')
        {
         sup = name+"<sup>nd</sup>";
        }
        if(name === '3')
        {
         sup = name+"<sup>rd</sup>";
        }
        return sup;
    }
    $('document').ready(function(){
        $.ajax({
            url:'/showsemesters',
            type:'get',
            success:function(data)
            {
                var dropdownsemester = document.getElementById('value_of_semester');
                var option = '';
               if(data['nodata'] === false)
               {
                   var semesters_var = data['data'];
                   for(var i=0;i<semesters_var.length;i++)
                   {
                    
                       list = list+"<li onclick='showsubjects("+semesters_var[i].id+")'><a>"+sup(semesters_var[i].name)+"</a></li>";
                       option=option+"<option value="+semesters_var[i].id+">"+sup(semesters_var[i].name)+" Semester</option>";
                   }
                   semester_ul.innerHTML = list;
                   dropdownsemester.innerHTML = option; //SET VALUE SEMESTER DROP DOWN
               }
               else
               {
                var errors = "<div class='alert alert-danger'><strong>Failed!</strong>&nbsp;No Semester Exist. </div>";
                document.getElementById('msg').innerHTML= errors;
                document.getElementById('msg').style.display='block';
                var hide = setTimeout(hidemsg,4000);
               }
            },
            error:function(e)
            {
                console.log(e);
            },
        });
    });


    function showsubjects(id)
    {
        $.ajax(
            {
                url:'showsubjects/'+id,
                method:'get',
                success:function(data)
                {
                    var coursetbody = document.getElementById('coursetbody');
                    if(data['nodata'] === false)
                    {
                       
                        var tabledata = '';
                        var modaldropdown = '';
                        var subjects = data['data'];
                        
                        for(var i =0 ;i<subjects.length;i++)
                        {
                            tabledata =tabledata+ "<tr><td><input type='checkbox' value="+subjects[i].id+"></td><td>"+subjects[i].name+"</td><td>"+subjects[i].code+"</td><td>"+subjects[i].credit+"</td><td><button type='button' class='btn btn-warning' onclick='updatemodal("+subjects[i].id+")'>Update</button></td><td><button type='button' class='btn btn-danger' onclick='deletemodal("+subjects[i].id+")'>Delete</button></td></tr>"
                        }
                        
                        coursetbody.innerHTML=tabledata;
                    }
                    else
                    {
                        coursetbody.innerHTML='';
                        var errors = "<div class='alert alert-danger'><strong>Failed!</strong>&nbsp;No Subject Exist For this Semester. </div>";
                        document.getElementById('msg').innerHTML= errors;
                        document.getElementById('msg').style.display='block';
                        var hide = setTimeout(hidemsg,4000);
                    }
                    document.getElementById('semesterno').innerHTML = "Semester: "+sup(data['semester_name']);
                },
                error:function(e)
                {
                    console.log(e);
                },
            }
        )
    }

    function updatemodal(id)
    {
        $.ajax(
            {
                url:'updatesubject/'+id,
                method:'get',
                success:function(data)
                {
                   var heading = document.getElementById('Heading');
                   var subject_name = document.getElementById('subject_name');
                   var subject_code = document.getElementById('subject_code');
                   var subject_credit = document.getElementById('subject_credit');
                   var id = document.getElementById('id');

                   heading.innerHTML=""+ data[0].name;
                   subject_name.value= data[0].name;
                   subject_code.value = data[0].code;
                   subject_credit.value = data[0].credit;
                   id.value = data[0].id;
                   $('#update').modal('show');
                },
                error:function(e)
                {
                    console.log(e);
                },
            }
        )
    }

    function deletemodal(id)
    {
        $.ajax(
            {
                url:'showdeletesubject/'+id,
                method:'get',
                success:function(data)
                {
                   document.getElementById('subjectname').innerHTML=data;
                   document.getElementById('delelteid').value = id;
                   $('#delete').modal('show');
                },
                error:function(e)
                {
                    console.log(e);
                },
            }
        )
    }
    function updatesubject()
    {
        $.ajaxSetup(
            {
              headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
              }
           );
        $.ajax({
            url:'saveupdatesubject/'+document.getElementById('id').value,
            method:'post',
            data:{subject_name:document.getElementById('subject_name').value,subject_code:document.getElementById('subject_code').value,subject_credit:document.getElementById('subject_credit').value},
            success:function(data)
            {
                
                if(data['update'] === true)
                {
                    $('#update').modal('toggle');
                    var errors = "<div class='alert alert-success'><strong>Success!</strong>&nbsp;Successfully updated. </div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('msg').style.display='block';
                    var semester = data['semester']
                    showsubjects(semester);
                    var hide = setTimeout(hidemsg,4000);
                }
            },
            error:function(e)
            {
                console.log(e);
            }
        });
    }
    function deletesubject()
    {
        $.ajaxSetup(
            {
              headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
              }
           );
        $.ajax(
            {
                url:'deletesubject/'+document.getElementById('delelteid').value,
                method:'post',
                success:function(data)
                {
                    
                    if(data['delete'] === true)
                    {
                    $('#delete').modal('toggle'); 
                    
                    var errors = "<div class='alert alert-success'><strong>Success!</strong>&nbsp;Successfully deleted. </div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('msg').style.display='block';
                    showsubjects(data['semester']);
                    var hide = setTimeout(hidemsg,4000);
                    }
                    else
                    console.log('error');
                },
                error:function(e)
                {

                },

            }
        )
    }

    function savesubject()
    {
        $.ajaxSetup(
            {
              headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
              }
           );
        $.ajax(
            {
                url:'savesubject',
                method:'post',
                data:{name:document.getElementById('name').value,code:document.getElementById('code').value,credit:document.getElementById('credit').value,semester:document.getElementById('value_of_semester').value},
                success:function(data)
                {
                    if(data['insert'] === true)
                    {
                    $('#myModal').modal('toggle'); 
                    var errors = "<div class='alert alert-success'><strong>Success!</strong>&nbsp;Successfully Inserted. </div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('msg').style.display='block';
                    showsubjects(document.getElementById('value_of_semester').value);
                    var hide = setTimeout(hidemsg,4000);
                    }
                    else{
                        $('#myModal').modal('toggle'); 
                        var errors = "<div class='alert alert-danger'><strong>Failed!</strong>&nbsp;Failed to insert.Data already Exist. </div>";
                        document.getElementById('msg').innerHTML= errors;
                        document.getElementById('msg').style.display='block';
                        showsubjects(document.getElementById('value_of_semester').value);
                        var hide = setTimeout(hidemsg,4000);

                    }
                },
                error:function(e)
                {
                    console.log(e);
                },
            }
        )
    }
</script>