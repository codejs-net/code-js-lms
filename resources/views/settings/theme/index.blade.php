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
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Settings&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i>Settings&nbsp;</a></li>
</ol>
</nav>

<!-- Main content -->
<div class="container">
    <div class="card card-body">

     <form method="POST" action="{{ route('update_theme') }}">
      {{ csrf_field() }}
       <div class="form-group">
         <label for="theme">Select Theme</label>
         <select class="form-control" name="theme" id="theme">
           <option value="js-default">LMS Defalut</option>
           <option value="js-blue">LMS Blue</option>
           <option value="js-dark">LMS Dark</option>
           <option value="js-light">LMS Light</option>
           <option value="js-orange">LMS Orange</option>
           <option value="js-green">LMS Green</option>
         </select>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-success btn-sm" id="save_member"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Save")}}</button>
      </div>
     </form>
                     
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
