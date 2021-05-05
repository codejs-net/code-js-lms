@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$center="name".$lang;
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
        <div class="col-md-2 col-sm-6 text-right">
            <h5>
            @can('survey-create')
                <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#start_new_survey" ><i class="fa fa-plus" ></i>&nbsp;Create New</a>
            @endcan
            </h5>  
        </div>
    </div>   
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
        <div class="form-row">
            <div class="table-responsive"style="overflow-x: auto;">                        
            <table class="table table-hover" id="sdatatable">
                <thead class="js-tbl-header">
                    <tr>
                    <th scope="col">Survey ID</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Total Count</th>
                    <th scope="col">Survey  Count</th>
                    <th scope="col">Lending Count</th>
                    <th scope="col">finalize</th>
                    <th scope="col">Finalized Date</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Sdata as $data)
                    <tr>
                   
                        <td>{{$data->id}}</td>
                        <td>{{$data->start_date}}</td>
                        <td>{{$data->$description}}</td>
                        <td>{{$data->total_resources}}</td>
                        <td>{{$data->survey_resources}}</td>
                        <td>{{$data->lending_resources}}</td>
                        <td>{{$data->finalize ==0 ?'No':'Yes'}}</td>
                        <td>{{$data->finalize_date}}</td>
                        <td>
                        @if($data->finalize ==0)
                        <a href="{{ route('survey.edit',Crypt::encrypt($data->id)) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-pencil" ></i>&nbsp; Edit</a>&nbsp; 
                        @else
                        <a href="{{ route('survey_history',Crypt::encrypt($data->id)) }}" class="btn btn-outline-success btn-sm"><i class="fa fa-eye" ></i>&nbsp; History</a>&nbsp; 
                        @endif
                        <a class="btn btn-outline-warning btn-sm " data-toggle="modal" data-target="#survey_delete" data-servyid="{{$data->id}}" data-surveydescript="{{$data->start_date}}:{{$data->$description}}"><i class="fa fa-trash" ></i>&nbsp; Delete</a>&nbsp;
                        

                        </td>
                    </tr>
                @endforeach
               
                </tbody>
            </table>
            </div>
        </div>
                     
    </div>
</div>
@include('survey.new_survey_modal')
@include('survey.delete_survey_modal')
@endsection
@section('script')
<script>

$(document).ready(function()
{
    $('#survey_delete').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('servyid') 
       var d_name = button.data('surveydescript')
       $('#id_delete').val(d_id);
       $('#name_delete').html(d_name);
   });

});
$("#create_newsurvey").submit( function() {
    var catchecked = $('input:checkbox[name="category[]"]:checked').length;
    var centchecked = $('input:checkbox[name="center[]"]:checked').length;
    if(catchecked == 0 || centchecked==0)
        {
            if (catchecked == 0) 
            {toastr.warning('Please select at least one Category')}
            if (centchecked==0)
            {toastr.warning('Please select at least one Center')}
            return false;
        }
   
});
</script>

@endsection
