@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Settings&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i>Settings&nbsp;</a></li>
</ol>
</nav>

<!-- Main content -->
<div class="container">
    <div class="card card-body">
      <div><h6>Theme Settings and Options</h6></div>
     <form method="POST" action="{{ route('update_theme') }}">
      {{ csrf_field() }}
       <div class="form-group">
         <label for="theme">Select Theme:</label>
         <select class="form-control" name="theme" id="theme">
           <option value="js-colour">LMS Colour</option>
           <option value="js-blue-dark">LMS Blue Dark</option>
           <option value="js-blue-light">LMS Blue Light</option>
           <option value="js-orange-dark">LMS Orange Dark</option>
           <option value="js-orange-light">LMS Orange Light</option>
           <option value="js-green-dark">LMS Green Dark</option>
           <option value="js-green-light">LMS Green Light</option>
           <option value="js-dark">LMS Dark</option>
           <option value="js-light">LMS Light</option>
           
         </select>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
      </div>
     </form>              
    </div>

    <div class="card card-body">
      <div><h6>Default Display Language(Locale)</h6></div>
     <form method="POST" action="{{ route('update_locale') }}">
      {{ csrf_field() }}
       <div class="form-group">
         <label for="theme">Language:</label>
         <select class="form-control"  name="locale" id="locale">
           <option value="si">Sinhala</option>
           <option value="ta">Tamil</option>
           <option value="en">English</option>
         </select>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
      </div>
     </form>              
    </div>

    <div class="card card-body">
      <div><h6>Default DataBase Language</h6></div>
     <form method="POST" action="{{ route('update_db_locale') }}">
      {{ csrf_field() }}
       <div class="form-group">
         <label for="theme">Language:</label>
         <select class="form-control" name="db_locale" id="db_locale">
          <option value="0">Locale</option>
          <option value="si">Sinhala</option>
          <option value="ta">Tamil</option>
          <option value="en">English</option>
         </select>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
      </div>
     </form>              
    </div>

</div>

@endsection
@section('script')
<script>

$(document).ready(function()
{
  $('#db_locale').val("{{$db_locale->value}}");
  $('#locale').val("{{$_locale->value}}");
  $('#theme').val("{{$theme->value}}");

});
</script>

@endsection
