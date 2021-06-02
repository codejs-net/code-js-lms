@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$member="name".$lang;
@endphp
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Users&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i>Edit User&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-plus ml-1 pl-2"> Edit User</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            <a href="{{ route('member_users') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plu"></i>&nbsp; back</a>
        </div>
    </div>
    
</div>



<div class="container">
<div class="card card-body">

<form method="POST" action="{{ route('update_member_users')}}"  id="user_form" class="needs-validation"  novalidate>
{{ csrf_field() }}
<input type="hidden" name="user_id" class="user_id">
<div class="row">
<div class="form-group col-md-5">
            <label for="member">Member : </label>
            <select class="form-control" name="member" id="member" value="{{old('member')}}"required>
            <option value="" disabled selected>Select Member </option>
            @foreach($memberdata as $item)
                <option value="{{ $item->id }}">{{ $item->$member }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">{{ __("Please Select the member")}}</div>
            <span class="text-danger">{{ $errors->first('member') }}</span>
        </div>
    <div class="form-group col-md-1 text-left">
        <label for="categry">&nbsp;</label><br>
        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal">
        <i class="fa fa-plus"></i></button>
    </div>
    <div class="form-group col-md-5">
        <label for="role">Role : </label>
        <select class="form-control"name="roles" id="roles" value="{{old('role')}}"required>
        <option value="" disabled selected>Select Role </option>
        @can('role-list')
            @foreach($roles as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        @else
            @foreach($roles as $item)
                @if($item->name!="Admin")
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach 
        @endcan

        </select>
        <div class="invalid-feedback">{{ __("Please Select Use Role")}}</div>
        <span class="text-danger">{{ $errors->first('role') }}</span>
    </div>
    <div class="form-group col-md-1 text-left">
        <label for="categry">&nbsp;</label><br>
        
        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal">
        <i class="fa fa-plus"></i></button>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">UserName : </label>
            <input type="text" name="username" id="username" class="form-control" placeholder="UserName" required>
            <span class="text-danger">{{ $errors->first('username') }}</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">Email : </label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
    </div>
   
    
   
</div>

    <div class="box-footer clearfix pull-right">    
        <button type="submit" class="btn btn-success btn-sm ml-2" id="save_staff"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Update")}}</button>
        
        <button type="button" class="btn btn-secondary btn-sm ml-2" id="cler">&nbsp;Reset<i class="fa fa-times"></i></button>
    </div>
   
</form>
</div>
</div>




<div class="container">
<div class="card card-body">

<form method="POST" action="{{ route('pw_reset')}}"  id="pw_reset_form" class="needs-validation mt-3"  novalidate>
{{ csrf_field() }}
<input type="hidden" name="user_id" class="user_id">
<div class="row">
<div class="col-md-12 col-sm-12 text-left">
        <div class="form-group js-select-box">
            <div class="ml-2 mr-2">
                <span for="category">Password Reset</span>
                <div class="bg-light p-2 mb-2">
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="preset" value="default"required>
                        <label class="form-check-label">Reset to Default Password</label>
                    </div>
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="preset" value="mannual"required>
                        <label class="form-check-label">Reset to Mannual Password</label>
                    </div> 
                </div>
                <div class="row" style="display:none;" id="mannual_pw">
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="staff">Password : </label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <label for="staff">Confirm Password : </label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>

                </div>
                <span class="text-danger">{{ $errors->first('password') }}</span>
                <div class="pull-right pt-3 mt-3">
                    <button type="submit" class="btn btn-outline-danger btn-sm " id="reset_password"><i class="fa fa-reset" aria-hidden="true"></i> {{ __("Reset Password")}}</button>
                </div>
                
            </div>
        </div>
    </div>
</div>

</form>
                
</div>
</div>

@endsection

@section('script')
<script>


$(document).ready(function()
{
    $('.user_id').val("{{$user->id}}");
    $('#member').val("{{$user->detail_id}}");
    $('#username').val("{{$user->username}}");
    $('#email').val("{{$user->email}}");
    $('#roles').val("{{$userRole}}");

    $('#reset_password').prop("disabled",true);
    
    $('#member').select2({
        theme: 'bootstrap4',
    });


});
$('input[type=radio][name=preset]').change(function() {
    $('#reset_password').prop("disabled",false);
    if (this.value == 'default') {
       $('#mannual_pw').slideUp(500);
       $("#password").prop('required',false);
       $("#confirm-password").prop('required',false);
    }
    else if (this.value == 'mannual') {
        $('#mannual_pw').slideDown(500);
        $("#password").prop('required',true);
       $("#confirm-password").prop('required',true);
    }
});

</script>

@endsection