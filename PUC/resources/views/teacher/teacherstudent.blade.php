@extends('mainlayout')
@section('title')
Teacher | Student
@endsection
@section('titleforpage')
Student
@endsection
@section('rightcontent')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="msg"></div>
<div class="container">
    <h3 id="subject"></h3>
    <ul class="nav nav-tabs">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Subject<span class="caret"></span></a>
            <ul class="dropdown-menu" id="subjectslist">
            </ul>
        </li>
        <li class="active"><a data-toggle="tab" href="#regular">Regular</a></li>
        <li><a data-toggle="tab" href="#recourse" onclick="getstudentrecourse()">Recourse</a></li>
        <li><a data-toggle="tab" href="#retake" onclick="getstudentsretake()">Retake</a></li>
    </ul>

    <div class="tab-content">
            <div id="regular" class="tab-pane fade in active" style="background: #fff">
                    <div class="table-responsive" style="overflow-y:auto; max-height: 73%">
                        <table id="regulartabtable" class="table table-bordred table-striped">
                            <thead>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Advisor</th>
                                    <th>Delete</th>
                            </thead>
                            <tbody id="regulartabtbody">  
                            </tbody>
                        </table>
                    </div>
            </div>

            <div id="recourse" class="tab-pane fade" style="background: #fff">
                <div class="table-responsive" style="overflow-y:auto; max-height: 73%">
                    <table id="recoursetabtable" class="table table-bordred table-striped">
                        <thead>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Advisor</th>
                            <th>Delete</th>
                        </thead>
                        <tbody id="recoursetabtbody">  
                        </tbody>
                    </table>
                </div>
        </div>

        <div id="retake" class="tab-pane fade" style="background: #fff">
            <div class="table-responsive" style="overflow-y:auto; max-height: 73%">
                <table id="retaketabtable" class="table table-bordred table-striped">
                    <thead>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Advisor</th>
                            <th>Delete</th>
                    </thead>
                    <tbody id="retaketabtbody">  
                    </tbody>
                </table>
            </div>
    </div>
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

$('document').ready(function()
{
   $.ajax(
       {
           url:'getsubjects',
           method:'get',
           success:function(data)
           {
               if(data['error'] === false)
               {
                   if(data['nodata'] === false)
                   {
                        var datas = data['data'];
                        var list = '';
                        for(var i=0;i<datas.length;i++)
                        {
                            list = list+"<li onclick='getstudentsregular("+datas[i].sec_id+","+datas[i].sub_id+")'><a>"+datas[i].subname+' - ('+datas[i].secname+")</a></li>"; 
                        }
                        document.getElementById('subjectslist').innerHTML = list;
                        document.getElementById('regulartabtable').style.display = ' ';
                        getstudentsregular(datas[0].sec_id,datas[0].sub_id);
                   } 
                   else
                   {
                    var errors = "<div class='alert alert-danger'><strong></strong>You have not selected as teacher for any subject.</div>";
                    document.getElementById('regulartabtable').style.display = 'none';
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('msg').style.display='block';
                    var hide = setTimeout(hidemsg,4000);
                   }  
                 
                   
               }
               else
               {
                var errors = "<div class='alert alert-danger'><strong></strong>Session is not active. Contact Admin.</div>";
                document.getElementById('msg').innerHTML= errors;
                document.getElementById('regulartabtable').style.display = 'none';
                document.getElementById('msg').style.display='block';
                var hide = setTimeout(hidemsg,4000);
               }
           },
           error:function(e)
           {
               console.log(e);
           }
       }
   );
});
var section_id_global;
var subject_id_global;
function getstudentsregular(section_id,subject_id)
{
    section_id_global = section_id;
    subject_id_global = subject_id;
    $.ajax(
        {
            url:'getstudentsregular',
            method:'get',
            data:{section:section_id,subject:subject_id},
            success:function(data)
            {
               if(data['user'] === true)
               {
                   document.getElementById('subject').innerHTML=data['subject']+' - ('+data['section']+')';
                   if(data['nodata'] === false)
                   {
                       var datas = data['student'];
                       var tablerow = '';
                        var advisor = data['advisor'];
                       for(var i=0;i<datas.length;i++)
                       {
                           tablerow = tablerow+ "<tr><td>"+datas[i].name+"</td><td>"+datas[i].student_id+"</td><td>"+advisor[i]+"</td><td><button type='button' class='btn btn-danger' onclick='deletesubject("+datas[i].id+",0)'>Delete</button></td></tr>";
                       }
                       document.getElementById('regulartabtbody').innerHTML = tablerow;
                       document.getElementById('regulartabtable').style.display = '';
                   }
                   else
                   {
                    var errors = "<div class='alert alert-danger'><strong></strong>0 Student enrolled for this subject.</div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('regulartabtable').style.display = 'none';
                    document.getElementById('msg').style.display='block';
                    var hide = setTimeout(hidemsg,4000);
                   }
               }
               else
               {
                   console.log("WELL PLAYED :-)");
               }
            },
            error:function(e)
            {
                console.log(e);
            },
        }
    );
}

function getstudentsretake()
{
    var section_id = section_id_global;
    var subject_id = subject_id_global;
    $.ajax(
        {
            url:'getstudentsretake',
            method:'get',
            data:{section:section_id,subject:subject_id},
            success:function(data)
            {
               if(data['user'] === true)
               {
                   document.getElementById('subject').innerHTML=data['subject']+' - ('+data['section']+')';
                   if(data['nodata'] === false)
                   {
                       var datas = data['student'];
                       var tablerow = '';
                        var advisor = data['advisor'];
                       for(var i=0;i<datas.length;i++)
                       {
                           tablerow = tablerow+ "<tr><td>"+datas[i].name+"</td><td>"+datas[i].student_id+"</td><td>"+advisor[i]+"</td><td><button type='button' class='btn btn-danger' onclick='deletesubject("+datas[i].id+",1)'>Delete</button></td></tr>";
                       }
                       document.getElementById('retaketabtbody').innerHTML = tablerow;
                       document.getElementById('retaketabtable').style.display = '';
                   }
                   else
                   {
                    var errors = "<div class='alert alert-danger'><strong></strong>0 Student took 'retake'.</div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('retaketabtable').style.display = 'none';
                    document.getElementById('msg').style.display='block';
                    var hide = setTimeout(hidemsg,4000);
                   }
               }
               else
               {
                   console.log("WELL PLAYED :-)");
               }
            },
            error:function(e)
            {
                console.log(e);
            },
        }
    );
}

function getstudentrecourse()
{
    var section_id = section_id_global;
    var subject_id = subject_id_global;
    $.ajax(
        {
            url:'getstudentsrecourse',
            method:'get',
            data:{section:section_id,subject:subject_id},
            success:function(data)
            {
               if(data['user'] === true)
               {
                   document.getElementById('subject').innerHTML=data['subject']+' - ('+data['section']+')';
                   if(data['nodata'] === false)
                   {
                       var datas = data['student'];
                       var tablerow = '';
                        var advisor = data['advisor'];
                       for(var i=0;i<datas.length;i++)
                       {
                           tablerow = tablerow+ "<tr><td>"+datas[i].name+"</td><td>"+datas[i].student_id+"</td><td>"+advisor[i]+"</td><td><button type='button' class='btn btn-danger' onclick='deletesubject("+datas[i].id+",2)'>Delete</button></td></tr>";
                       }
                       document.getElementById('recoursetabtbody').innerHTML = tablerow;
                       document.getElementById('recoursetabtable').style.display = '';
                   }
                   else
                   {
                    var errors = "<div class='alert alert-danger'><strong></strong>0 Student took 'Recourse'.</div>";
                    document.getElementById('msg').innerHTML= errors;
                    document.getElementById('recoursetabtable').style.display = 'none';
                    document.getElementById('msg').style.display='block';
                    var hide = setTimeout(hidemsg,4000);
                   }
               }
               else
               {
                   console.log("WELL PLAYED :-)");
               }
            },
            error:function(e)
            {
                console.log(e);
            },
        }
    );
}

function deletesubject(session_id,type)
{
    $.ajaxSetup(
            {
              headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
              }
           );

    $.ajax({
        url:'deletesubject',
        method:'post',
        data:{session_id:session_id,type:type,section_id:section_id_global,subject_id:subject_id_global},
        success:function(data)
        {
            if(data['user'] === true)
            {
                if(data['delete'] === true)
                {
                    if(type === 0)
                    {
                        getstudentsregular(section_id_global,subject_id_global);
                    }
                    else if(type === 1)
                    {
                        getstudentsretake();
                    }
                    else
                    {
                        getstudentrecourse();
                    }
                }
            }
            else
            {
                console.log('WELL PLAYED');
            }
        },
        error:function(e)
        {
            console.log(e);
        },
    });
}
</script>