@extends('layouts.app')
@section('content')

@php
$lang = session()->get('db_locale');
$name="name".$lang;
@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Users&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i> User Account&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> Search User</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            <a href="{{ route('users.create') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
        </div>
    </div>
    
</div>



<div class="container">
    <div class="card card-body">


<table class="table table-hover" id="tbl_user">
<thead>
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>UserName</th>
   <th>Email</th>
   <th>Roles</th>
   <th>Action</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->staff->$name }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-outline-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-outline-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
 </tbody>
</table>


                
</div>
</div>



@endsection

@section('script')
<script>
   $(document).ready(function() {
     
    $('#tbl_user').DataTable();
});
</script>
<!-- jQuery-Datatable -->
<!-- <script src="{{ asset('plugins/datatables-jquery/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script> -->

@endsection


