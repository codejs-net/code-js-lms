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
            <div class="col-md-4 col-sm-12 text-left mt-1">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-addon"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                    </div>
                        <input type="text" class="form-control" id="resource_details" onfocus="this.value=''" placeholder="AccessionNo / ISBN / ISSN / ISMN" aria-describedby="basic-addon3">&nbsp;&nbsp;
                        <button type="button" class="btn btn-sm btn-outline-primary" id="resource_check"><i class="fas fa-cart-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-success" id="resource_unckeck"><i class="fa fa-minus"></i></button>
                </div> 
                <div class="input-group mt-4">
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

            <!-- -------------------------------------------------------------------------- -->
            <div class="col-md-3 col-sm-12 text-left mt-1">
                <div class="col">           
                    <div class="small-box js-box-bg-4 elevation-5">
                        <div class="inner js-box-text">
                            <h2>10265</h2>

                            <p>Survey Count</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        
                    </div>
                </div>
                <div class="col">
                    <div class="small-box js-box-bg-5 elevation-5">
                        <div class="inner js-box-text">
                            <h2>1563</h2>

                            <p>Total Count</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------- -->
            <div class="col-md-5 col-sm-12 text-left mt-1">
            <div class="small-box  col-lg-12 text-center " style="height:8rem;">
                    <div class="row">
                        <!-- <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div> -->
                        <!-- <h4> <label>Book details</label></h4> -->
                        <h4 class="text-black"> <label id="resource_capturename">Test Book</label></h4>
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
