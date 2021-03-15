@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$suggetion="suggestion".$lang;
$description="description".$lang;

@endphp

<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="{{ route('home') }}" class="js-text"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('survey.index') }}" class="js-text"><i class="fa fa-book"></i> Survey&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a class="js-text"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Survey&nbsp;</a></li>
</ol>
</nav>
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-10 col-sm-6 text-center"> 
            <h5> <i class="fa fa-check-circle-o">Survey</i></h5>
        </div>  
    </div>   
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">

        <div class="row">
            <div class="col-md-4 col-sm-12">
               <div class="card p-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-addon"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                    </div>
                        <input type="text" class="form-control" id="resource_details" onfocus="this.value=''" placeholder="AccessionNo / ISBN / ISSN / ISMN" aria-describedby="basic-addon3">&nbsp;&nbsp;
                        <button type="button" class="btn btn-sm btn-outline-primary" id="resource_check"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-success" id="resource_uncheck"><i class="fa fa-minus"></i></button>
                </div> 
                <div class="input-group mt-2 ">
                    <div class="input-group-prepend">
                        <span class="input-group-addon"id="basic-addon2"><i class="fa fa-list fa-lg mt-2"></i></span>
                    </div>
                        <select class="form-control" id="survey_suggestion" name="survey_suggestion"aria-describedby="basic-addon2">
                            <option value="" selected disabled hidden>-Choose Suggetion-</option>
                                @foreach($sugdata as $sitem)
                                    <option value="{{ $sitem->id }}">{{ $sitem->$suggetion }}</option>
                                @endforeach
                        </select>
                </div> 
               </div>
            </div>

            <!-- -------------------------------------------------------------------------- -->
            <div class="col-md-3 col-sm-12">
                <div class="row">
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box1" style="height:7rem;">
                            <div class="text-center mt-3">
                                <h1 id="survey_count">{{$scount}}</h1>
                                <p>Survey Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card elevation-2 js-survey-box2" style="height:7rem;">
                            <div class="text-center mt-3">
                                <h1>{{$rcount}}</h1>
                                <p>Total Count</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------- -->
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="" style="height:7rem;">
                        <div class="row table-responsive ml-3 text-left">
                            <table>
                                <tr>
                                    <td>Title</td>
                                    <td>&nbsp;<i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</td>
                                    <td><h5><span id="resource_title" class="text-center text-indigo"></span></h5></td>
                                </tr>
                                <tr>
                                    <td>Creator</td>
                                    <td>&nbsp;<i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</td>
                                    <td><span id="resource_creator" class="text-center"></span></td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>&nbsp;<i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;</td>
                                    <td><span id="resource_category" class="text-center"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive"style="overflow-x: auto;">   
            <input type="hidden" name="surveyid" id="surveyid" value="{{$sdata->id}}">            
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="survey_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">Resource ID</th>
                            <th scope="col">Accession No</th>
                            <th scope="col">ISBN/ISSN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Price</th>
                            <th scope="col">Survey</th>
                            <th scope="col">suggestion</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
            </table>
        </div>
    </div> 
   <div class="card p-3">
   <div class="row">
        <div class="col-md-10 col-sm-8 col-8 text-left">
            <label class="ml-2" for="report" >Survey Reports:  </label><br>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;All Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;Checked Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;Checked Resources with Suggetion</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;UnChecked Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;lend Resources</i></a>
        </div>
        <div class="col-md-2 col-sm-4 col-4">
           <div class="pull-right">
           <label class="ml-2" for="report" >Survey Oppretion:  </label><br>
            <a href="" class="btn btn-outline-secondary btn-sm mr-2 mb-2" id=""><i class="fa fa-arrow-left">&nbsp;&nbsp;Back</i></a>
            <a href="" class="btn btn-primary btn-sm mr-2 mb-2" data-toggle="modal" data-target="#finalize_survey" ><i class="fa fa-save">&nbsp;<strong>Finalize Survey</strong></i></a>
           </div>
        </div>            
    </div>
   </div>
    <hr>
</div>
@include('survey.survey_finalize_modal')
@endsection
@section('script')
<script>

$(document).ready(function()
{
    load_datatable();
    $('#resource_details').focus();

    var input = document.getElementById("resource_details");
        input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("resource_check").click();
        $('#resource_details').val('');
        $("#survey_suggestion").val($("#survey_suggestion option:first").val());
        document.getElementById("resource_details").focus();
        }
    });

});

function load_datatable()
{
    $('#survey_datatable').DataTable({
        columnDefs: [
        {"targets": [0],
        "visible": false,
        "searchable": false},
        ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,
    
        ajax:{
        dataType : 'json',
        url: "{{ route('survey.edit',Crypt::encrypt($sdata->id)) }}",
        },
        columns:[
            {data: "id",name: "id"},
            {data: "accessionNo",name: "AccessionNo",orderable: true},
            {data: "standard_number",name: "standard_number",orderable: true},
            {data: "title<?php echo $lang; ?>",name: "title"},
            {data: "name<?php echo $lang; ?>",name: "author"},
            {data: "price",name: "price"},
            {data: "survey",name: "survey",orderable: false},
            {data: "suggestion<?php echo $lang; ?>",name: "Suggetion"},  
        ]
    });
}

 // ----------------------------------------------------------------------------

 $('#resource_check').on("click",function(){
    var resourceinput = $("#resource_details").val();
    var suggetion = $("#survey_suggestion").val();
    var surveyid = $("#surveyid").val();
    $('#resource_title').html("");
    $('#resource_creator').html("");
    $('#resource_category').html("");
    if(resourceinput!="")
    {
         // -------------------------------------------------------
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            dataType : 'json',
            url: "{{route('check_survey')}}",
            data:{
                    resourceinput: resourceinput,
                    suggetion:suggetion,
                    surveyid:surveyid
                },
            success: function(data){
            if(data.massage=="success")
                {
                    toastr.success(data.title+' - Resource Checked Successfuly');
                    $('#survey_count').html(data.scount);
                    $('#resource_title').html(data.title);
                    $('#resource_creator').html(data.creator);
                    $('#resource_category').html(data.category+"-"+data.type);
                }
                else if(data.massage=="check")
                {
                    toastr.info(data.title+' - Resource Alredy Checked, Details Updated Successfuly');
                    $('#survey_count').html(data.scount);
                    $('#resource_title').html(data.title);
                    $('#resource_creator').html(data.creator);
                    $('#resource_category').html(data.category+"-"+data.type);
                
                }
                else if(data.massage=="lend")
                {
                    toastr.warning(data.title+' - Resource lend, Plese Return first');
                }
                else
                {toastr.error('Resource Not Found!');}

                $('#resource_details').val('');
                $("#survey_suggestion").val($("#survey_suggestion option:first").val());
                document.getElementById("resource_details").focus();
                $('#survey_datatable').DataTable().ajax.reload()
        
            },
            error: function(data){
            toastr.error('Something Went Wrong!')
            }
        });
    }
    else
    {
        toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')
    }
  

});
// ------------------------------------------------------------------------

$('#resource_uncheck').on("click",function(){
    var resourceinput = $("#resource_details").val();
    var surveyid = $("#surveyid").val();
    $('#resource_title').html("");
    $('#resource_creator').html("");
    $('#resource_category').html("");
    
    if(resourceinput!="")
    {
        // -------------------------------------------------------
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            dataType : 'json',
            url: "{{route('uncheck_survey')}}",
            data:{
                    resourceinput: resourceinput,
                    surveyid:surveyid
                },
            success: function(data){
            if(data.massage=="success")
                {
                    toastr.success(data.title+' - Resource UnChecked');
                    $('#survey_count').html(data.scount);
                    $('#resource_title').html(data.title);
                    $('#resource_creator').html(data.creator);
                    $('#resource_category').html(data.category+"-"+data.type);
                }
                else if(data.massage=="check")
                {
                    toastr.info(data.title+' - Resource Not Checked');
                }
                else
                {toastr.error('Resource Not Found!');}

                $('#resource_details').val('');
                $("#survey_suggestion").val($("#survey_suggestion option:first").val());
                document.getElementById("resource_details").focus();
                $('#survey_datatable').DataTable().ajax.reload()
        
            },
            error: function(data){
            toastr.error('Something Went Wrong!')
            }
        });
    }
    else
    {
        toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')
    }
   

});
// ------------------------------------------------------------------------

// -------------------------finalize Survey----------------------------------
$("#finalize").click(function () {
    var bar = $('.bar');
    var percent = $('.percent');

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $.ajax({
           type: "POST",
           dataType : 'json',
           url: "{{ route('finalize_survey') }}", 
           data: $('#finalize_survey_form').serialize(),

           beforeSend: function(){
            $("#loader").show();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
           },

           success:function(data){
               if(data.massage=="success"){
                toastr.success('Survey Finalized Successfully');
                document.location = "{{ route('view_survey',0) }}";
               }
               if(data.massage=="error"){
                toastr.error('Survey Finalized faild');
               }  
           },
           error:function(data){
            //    toastr.error('Survey Finalized faild Plese try again')
           },
           complete:function(data){
               var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
                $("#loader").hide();
           }
       })
       
});
//--------------------------end finalize-----------------------------

</script>

@endsection
