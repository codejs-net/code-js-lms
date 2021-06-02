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
    <li class="breadcrumb-item ml-4"><a href="{{ route('home') }}" class="js-text"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('survey.index') }}" class="js-text"><i class="fa fa-folder-open"></i> Survey&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a class="js-text"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Survey History&nbsp;</a></li>
</ol>
</nav>
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-10 col-sm-6 text-center"> 
            <h5> <i class="fa fa-check-circle-o">Survey History</i></h5>
        </div>  
    </div>   
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">

        <div class="row">
           

            <!-- -------------------------------------------------------------------------- -->
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box-6" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h5 id="survey_description">{{$sdata->$description}}</h5>
                                <p>Survey</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box-7" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_start">{{$sdata->start_date}}</h4>
                                <p>Start</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box-3" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_finalized">{{$sdata->finalize_date}}</h4>
                                <p>Finalized</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card elevation-2 js-survey-box-4" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_total">{{$sdata->total_resources}}</h4>
                                <p>Total Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box-5" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_checked">{{$sdata->survey_resources}}</h4>
                                <p>Checked Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card elevation-2 js-survey-box-6" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_nonchecked">{{$sdata->non_survey_resources}}</h4>
                                <p>Non Checked Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box-7" style="height:7rem;">
                            <div class="text-center js-survey-box-text mt-3">
                                <h4 id="survey_lend">{{$sdata->lending_resources}}</h4>
                                <p>Lend Count</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------- -->
            
        </div>
        <hr>
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
        <div class="col-md-12 col-sm-12 col-12 text-left">
            <label class="ml-2" for="report" >Survey Reports:  </label><br>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;All Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;Checked Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;Checked Resources with Suggetion</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;UnChecked Resources</i></a>
            <a href="" class="btn btn-outline-success btn-sm ml-2 mb-2" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;lend Resources</i></a>
        </div>
                
    </div>
   </div>
    <hr>
</div>
@endsection
@section('script')
<script>

$(document).ready(function()
{
    load_datatable();
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
        ordering: true,
        searching: true,
    
        ajax:{
        dataType : 'json',
        url: "{{ route('survey_history',Crypt::encrypt($sdata->id)) }}",
        },
        columns:[
            {data: "id",name: "id"},
            {data: "accessionNo",name: "AccessionNo",orderable: true},
            {data: "standard_number",name: "standard_number",orderable: true},
            {data: "title<?php echo $lang; ?>",name: "title"},
            {data: "cretor_name<?php echo $lang; ?>",name: "author"},
            {data: "price",name: "price"},
            {data: "survey_",name: "survey_",orderable: false},
            {data: "suggestion<?php echo $lang; ?>",name: "Suggetion",orderable: true},  
        ],
        "createdRow": function( row, data, dataIndex ) {
        if ( data['survey'] == 0 ) {        
            $('td', row).addClass('text-danger');
            }
        }
    });
}

 // ----------------------------------------------------------------------------

 

</script>

@endsection
