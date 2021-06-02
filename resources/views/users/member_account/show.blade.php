@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Users&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i>Show User&nbsp;</li>
</ol>
</nav>

<div class="container">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-plus ml-1 pl-2"> Show User</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            <a href="{{ route('staff_users') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plu"></i>&nbsp; back</a>
        </div>
    </div>
    
</div>

<div class="container">
<div class="card card-body">

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
                
</div>
</div>




@endsection