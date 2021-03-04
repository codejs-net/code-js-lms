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
                <!-- --------------------------- section 1------------------------------------- -->
            <section class="col-lg-12 connectedSortable">
 
                <div class="box box-info">
                        <div class="box-header ">
                           <div class="pull-left header"> <h4> <i class="fa fa-book"> Survey</i></h4></div>
                           <div class="pull-right header"> <h4> <a href="" data-toggle="modal" data-target="#start_new_survey" ><i class="fa fa-plus"></i>&nbsp;New</a></h4></div>
                        </div>

                            <div class="box-body">
                                
                                <form onSubmit="return false;" class="form-inline">
                                    <div class="form-row">
                                        <div class="form-group col-md-5 text-left">
                                            <div class="row form-inline">
                                                <label for="">Book ID &nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;
                                                 <input type="text" class="form-control" id="book_capture" placeholder="Book ID">&nbsp;
                                                 
                                                <button type="button" class="btn btn-primary" id="book_check"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-warning mt-1" id="book_uncheck"><i class="fa fa-minus"></i></button>
                                                
                                                <!-- <button type="button" class="btn btn-success" id=""><i class="fa fa-search"></i></button>  -->

                                            </div>
                                            <br>

                                            <div class="row">
                                                <label for="">Suggestion: </label>&nbsp;
                                                <!-- <input type="text" class="form-control" id="book_suggestion" placeholder="suggestion">&nbsp; -->
                                                <select class="form-control" id="book_suggestion" name="book_suggestion">
                                                    <!-- <option value="1" selected disabled hidden>-Choose Suggetion-</option> -->
                                                        @foreach($sdata as $sitem)
                                                            <option value="{{ $sitem->id }}">{{ $sitem->Suggetion }}</option>
                                                        @endforeach
                                                </select>
                                                
                                                
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="small-box  col-lg-12 text-center " style="height:9rem;">
                                                <div class="row">
                                                    <!-- <div class="icon">
                                                        <i class="ion ion-pie-graph"></i>
                                                    </div> -->
                                                    <!-- <h4> <label>Book details</label></h4> -->
                                                    <h4 class="text-black"> <label id="book_capturename"></label></h4>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="small-box bg-aqua col-lg-12 text-center " style="height:9rem;">
                                                <div class="row">
                                                    <!-- <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                    <h4  class=" text-black"> <label>Total &nbsp;&nbsp; -</label></h4>
                                                        
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <h3 id="total_count" class="">9652</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <h4  class=" text-black"> <label>Survey -</label></h4>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <span type="hidden" id="survey_count" class=""><h3>424</h3></span>
                                                        <h3 id="survey_countb"></h3>
                                                    </div>
                                                    
                                                </div> 
                                            </div>

                                        </div>
                                        <div class="form-group col-md-1 text-center" >
                                        <div class="row">
                                                <a href="/export_surveytemp" class="btn btn-primary" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;All &nbsp;&nbsp;</i></a><br><br>
                                                <a href="/export_surveytemp1" class="btn btn-warning" id=""><i class="fa fa-line-chart">&nbsp;UnCheck</i></a>
                                                
                                            </div>    
                                           
                                        </div>
                                    </div>
                                        
                                </form>
                            </div> 


                        <div class="box box-info">
                            <div class="box-header">
                                               
                                <table class="table table-responsive " id="survey_datatable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Book ID</th>
                                            <th scope="col">Accession No</th>
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
                
                            <div class="pull-right">
                                
                            <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#finalize_survey" ><i class="fa fa-save">&nbsp;<strong>Finalize</strong></i></a>
                                <!-- <button class="btn btn-primary btn-lg" id="finalize"><i class="fa fa-save">&nbsp;<strong>Finalize</strong></i></button> -->
                                <!-- <a href="" class="btn btn-success "><i class="fa fa-search">&nbsp;View</i></a>
                                <a href="" class="btn btn-danger "><i class="fa fa-refresh">&nbsp;Clear</i></a> -->
                            </div>

                        </div>               
                    </div>
                </div>

            </section>
  
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
