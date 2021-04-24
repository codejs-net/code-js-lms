@extends('layouts.app')
@section('content')
@php
$lang = session()->get('locale');
$name="name_".$lang;
$address1="address1_".$lang;
$address2="address2_".$lang;

@endphp
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Users&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i>My Account&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-user ml-1 pl-2"> My Account</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            {{-- <a href="{{ route('home') }}" class="btn btn-info btn-sm" name="home" id="home" ><i class="fa fa-arrow-left"></i>&nbsp; back</a> --}}
        </div>
    </div>
    
</div>



<div class="container">
<div class="card card-body">

<form method="POST" action="{{ route('update_my_account')}}"  id="user_form" class="needs-validation"  novalidate>
{{ csrf_field() }}
<input type="hidden" name="user_id" class="user_id">
<div class="form-row border border-secondary bg-light mb-3">
    <div class="col-md-2 col-12 m-auto pl-2 py-1 text-left">
        <img src="" class="img-resource1 elevation-3" id="avater_user">
    </div>
    <div class="col-md-10 col-12">
        <div class="row">
            <div class="form-group col-md-12">
                <table style="width: 60%">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Role </td>
                            <td style="width: 10%">:</td>
                            <td style="width: 50%"><span class="badge badge-info" id="detail_role"></span></td>
                            <td style="width: 20%"></td>
                        </tr>
                        <tr>
                            <td>Name </td>
                            <td>:</td>
                            <td><span id="detail_name"></span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Address </td>
                            <td>:</td>
                            <td><span id="detail_address"></span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>NIC </td>
                            <td>:</td>
                            <td><span id="detail_nic"></span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>:</td>
                            <td><span id="detail_mobile"></span></td>
                            <td><span id="detail_edit"><a href="">Edit Profile</a></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div class="row">

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
        <button type="submit" class="btn btn-success btn-sm mr-2" id="save_staff"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;{{ __("Update")}}</button>
        {{-- <button type="button" class="btn btn-secondary btn-sm ml-2" id="cler"><i class="fa fa-times"></i>&nbsp;{{ __("Reset")}}</button> --}}
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
                <span for="category">Change Password</span>
                <div class="bg-light p-2 mb-2">
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="preset" value="default"required>
                        <label class="form-check-label">Change to Default Password</label>
                    </div>
                    <div class="form-check form-check-inline" >
                        <input type="radio" class="form-check-input" name="preset" value="mannual"required>
                        <label class="form-check-label">Change to New Password</label>
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
    $('#username').val("{{$user->username}}");
    $('#email').val("{{$user->email}}");
    $('#detail_role').html("{{$userrole}}");
    $('#detail_name').html("{{$userdata->$name}}");
    $('#detail_address').html("{{$userdata->$address1}},{{$userdata->$address2}}");
    $('#detail_nic').html("{{$userdata->nic}}");
    $('#detail_mobile').html("{{$userdata->mobile}}");

    @if($user->user_type=="staff")
    $("#avater_user").attr('src','/images/staffs/{{$userdata->image}}');
    @elseif($user->user_type=="member")
    $("#avater_user").attr('src','/images/members/{{$userdata->image}}');
    @endif
   
    $('#reset_password').prop("disabled",true);


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