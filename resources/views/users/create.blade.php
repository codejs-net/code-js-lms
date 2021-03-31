@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$staff="name".$lang;
@endphp
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Users&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i>Add User&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-plus ml-1 pl-2"> Add User</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            <a href="{{ route('users.index') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plu"></i>&nbsp; back</a>
        </div>
    </div>
    
</div>


<div class="container">
<div class="card card-body">



<form method="post" action="{{ route('users.store')}}"  id="user_form" class="needs-validation"  novalidate>
{{ csrf_field() }}

<div class="row">
        <div class="form-group col-md-5">
            <label for="staff">Staff : </label>
            <select class="form-control"name="staff" value="{{old('staff_id')}}"required>
            <option value="" disabled selected>Select Staff's </option>
            @foreach($staffdata as $item)
                <option value="{{ $item->id }}">{{ $item->$staff }}</option>
            @endforeach
    
            </select>
            <div class="invalid-feedback">{{ __("Please Select the Staff")}}</div>
            <span class="text-danger">{{ $errors->first('staff') }}</span>
        </div>
        <div class="form-group col-md-1 text-left">
            <label for="categry">&nbsp;</label><br>
            
            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Member Category" onclick="add_by_modal('/save_member_cat')" >
            <i class="fa fa-plus"></i></button><label for="">&nbsp;</label>
        </div>
        <div class="form-group col-md-5">
            <label for="role">Role : </label>
            <select class="form-control"name="roles" value="{{old('role')}}"required>
            <option value="" disabled selected>Select Role </option>
            @foreach($roles as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
    
            </select>
            <div class="invalid-feedback">{{ __("Please Select Use Role")}}</div>
            <span class="text-danger">{{ $errors->first('role') }}</span>
        </div>
        <div class="form-group col-md-1 text-left">
            <label for="categry">&nbsp;</label><br>
            
            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Member Category" onclick="add_by_modal('/save_member_cat')" >
            <i class="fa fa-plus"></i></button><label for="">&nbsp;</label>
        </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">UserName : </label>
            <input type="text" name="username" id="username" class="form-control" placeholder="UserName" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">Email : </label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="staff">Password : </label>
            <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">Confirm Password : </label>
            <input type="text" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
        </div>
    </div>
    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
           <label for="staff">Role : </label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div> -->
   
</div>
<hr>
    <div class="box-footer clearfix pull-right">    
        <button type="submit" class="btn btn-success btn-sm ml-2" id="save_staff"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Save")}}</button>
        <button type="button" class="btn btn-secondary btn-sm ml-2" id="cler">&nbsp;Reset<i class="fa fa-times"></i></button>
    </div>
</form>
                
</div>
</div>


@endsection