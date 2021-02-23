@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Survey&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-check-circle-o" aria-hidden="true"></i> Survey&nbsp;</a></li>
</ol>
</nav>
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-10 col-sm-6 text-center"> 
            <h5> <i class="fa fa-check-circle-o">Survey</i></h5>
        </div>  
        <div class="col-md-2 col-sm-6 text-right">
            <h5>
            <a href="{{ route('create_resource') }}" class="btn btn-primary btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
            </h5>  
        </div>
    </div>   
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
        <div class="form-row">
                                   
            <table class="table " id="sdatatable">
                <thead class="card-name-1">
                    <tr>
                    <th scope="col">Survey ID</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Total Count</th>
                    <th scope="col">Removed Count</th>
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
                        <td>{{$data->total_resources}}</td>
                        <td>{{$data->removed_resources}}</td>
                        <td>{{$data->survey_resources}}</td>
                        <td>{{$data->lending_resources}}</td>
                        <td>{{$data->finalize}}</td>
                        <td>{{$data->finalize_date}}</td>
                        <td>

                        <a href="{{ route('survey.edit',$data->id) }}" class="btn btn-success btn-sm"><i class="fa fa-search" ></i></a>&nbsp; 

                        <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#Modal_delete_servey" data-servyid="{{$data->id}}" data-surveydte="{{$data->start_date}}"><i class="fa fa-trash" ></i></a>&nbsp;
                        

                        </td>
                    </tr>
                @endforeach
               
                </tbody>
            </table>

            </div>
                     
    </div>
</div>

@endsection
@section('script')
<script>

$(document).ready(function()
{
  

});
</script>

@endsection
