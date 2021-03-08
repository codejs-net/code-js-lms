@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

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
                        <button type="button" class="btn btn-sm btn-outline-success" id="resource_unckeck"><i class="fa fa-minus"></i></button>
                </div> 
                <div class="input-group mt-2 ">
                    <div class="input-group-prepend">
                        <span class="input-group-addon"id="basic-addon2"><i class="fa fa-list fa-lg mt-2"></i></span>
                    </div>
                        <select class="form-control" id="survey_suggestion" name="survey_suggestion"aria-describedby="basic-addon2">
                            <option value="1" selected disabled hidden>-Choose Suggetion-</option>
                                @foreach($sdata as $sitem)
                                    <option value="{{ $sitem->id }}">{{ $sitem->Suggetion }}</option>
                                @endforeach
                        </select>
                </div> 
               </div>
            </div>

            <!-- -------------------------------------------------------------------------- -->
            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="col">           
                        <div class="card elevation-2 js-survey-box1" style="height:7rem;">
                            <div class="text-center mt-3">
                                <h1>1025</h1>
                                <p>Survey Count</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card elevation-2 js-survey-box2" style="height:7rem;">
                            <div class="text-center mt-3">
                                <h1>1563</h1>
                                <p>Total Count</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------- -->
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="" style="height:7rem;">
                        <div class="row p-3 text-center">
                            <h4 class="text-black"> <label id="resource_capturename" class="text-center">Test Book</label></h4>
                        </div>
                    </div>
                </div>
            </div>
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
