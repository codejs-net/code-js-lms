@extends('layouts.app')
@section('style')
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endsection
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Reports&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Reports&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Resource Report</i></h5>
        </div>  
       
    </div>
    
</div>

<div class="container-fluid">
<div class="card">

   <div class="row pl-2">
    <div class="col-md-2 p-2">
       <div class="elevation-2 card1 ">
            <h5>This is option 1</h5>
            <p class="small">Card description with lots of great facts and interesting details.</p>
            <a href="" class="btn btn-warning btn-sm mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
            <a href="" class="btn btn-success btn-sm mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
            <div class="go-corner" href="#">
            <div class="go-arrow"></div>
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

