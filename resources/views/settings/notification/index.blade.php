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
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i>Notification Settings&nbsp;</a></li>
</ol>
</nav>

<!-- Main content -->
<div class="container">
    <div class="card card-body">
      <div><h6>SMS Alert Options</h6></div>
     <form method="POST" action="{{ route('update_sms_option') }}">
      {{ csrf_field() }}
       <div class="form-group">
        <div class="form-check">
          <label class="ml-3 pl-1">
            <input type="checkbox" name="sms_issue" value="1" class="form-check-input"id="sms_issue" >Send SMS Alert on Issue Resource
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="sms_return" value="1" class="form-check-input"id="sms_return" >Send SMS Alert on Return Resource
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="sms_member_add" value="1" class="form-check-input"id="sms_member_add" >Send SMS Alert on Member Create
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="sms_user_add" value="1" class="form-check-input"id="sms_user_add" >Send SMS Alert on User create
          </label><br>
         
        </div>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
      </div>
     </form>              
    </div>

    <div class="card card-body">
      <div><h6>Email Options</h6></div>
     <form method="POST" action="{{ route('update_email_option') }}">
      {{ csrf_field() }}
       <div class="form-group">
        <div class="form-check">
          <label class="ml-3 pl-1">
            <input type="checkbox" name="email_issue" value="1" class="form-check-input"id="email_issue" >Send Email on Issue Resource
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="email_return" value="1" class="form-check-input"id="email_return" >Send Email on Return Resource
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="email_member_add" value="1" class="form-check-input"id="email_member_add" >Send Email on Member Create
          </label><br>
          <label class="ml-3 pl-1">
            <input type="checkbox" name="email_user_add" value="1" class="form-check-input"id="email_user_add" >Send Email on User create
          </label><br>
         
        </div>
       </div>
       <div class="box-footer clearfix pull-right">   
        <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
      </div>
     </form>              
    </div>

    <div class="card card-body">
      <div><h6>Backup Email</h6></div>
     <form method="POST" action="{{ route('update_email_backup') }}">
      {{ csrf_field() }}
       <div class="form-group">
        <div class="form-check">
          <label class="ml-3 pl-1">
            <input type="checkbox" name="email_backup" value="1" class="form-check-input"id="email_backup" >Email Backup
          </label><br>
         
         
        </div>
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
  @if($sms_issue->value==1)
  $("#sms_issue").prop( "checked", true );
  @endif
  @if($sms_return->value==1)
  $("#sms_return").prop( "checked", true );
  @endif
  @if($sms_member->value==1)
  $("#sms_member_add").prop( "checked", true );
  @endif
  @if($sms_user->value==1)
  $("#sms_user_add").prop( "checked", true );
  @endif

  @if($email_issue->value==1)
  $("#email_issue").prop( "checked", true );
  @endif
  @if($email_return->value==1)
  $("#email_return").prop( "checked", true );
  @endif
  @if($email_member->value==1)
  $("#email_member_add").prop( "checked", true );
  @endif
  @if($email_user->value==1)
  $("#email_user_add").prop( "checked", true );
  @endif

  @if($email_backup->value==1)
  $("#email_backup").prop( "checked", true );
  @endif
                            

});
</script>

@endsection
