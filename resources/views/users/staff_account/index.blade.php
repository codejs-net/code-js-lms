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
            <h5> <i class="fa fa-search ml-4 pl-2"> Staff User Account</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right p-2">
            @can('user-create')
            <a href="{{ route('create_staff_users') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
            @endcan
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
    @can('role-list')
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->$name }}</td>
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
                <a class="btn btn-outline-info btn-sm" href="{{ route('show_staff_users',$user->id) }}">Show</a>
                <a class="btn btn-outline-primary btn-sm" href="{{ route('edit_staff_users',$user->id) }}">Edit</a>
                @can('user-delete')
                <a class="btn btn-sm btn-outline-danger " data-toggle="modal" data-target="#data_delete" data-dataid="{{ $user->id }}" data-dataname="{{ $user->$name }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
                @endcan
                </td>
            </tr> 
        @endforeach
    @endcan  

    @cannot('role-list')
        @foreach ($data as $key => $user)
            @if($user->can('role-list'))
            @else
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->$name }}</td>
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
                    <a class="btn btn-outline-info btn-sm" href="{{ route('show_staff_users',$user->id) }}">Show</a>
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('edit_staff_users',$user->id) }}">Edit</a>
                    @can('user-delete')
                    <a class="btn btn-sm btn-outline-danger " data-toggle="modal" data-target="#data_delete" data-dataid="{{ $user->id }}" data-dataname="{{ $user->$name }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
                    @endcan
                    </td>
                </tr>              
            @endif
        @endforeach
    @endcannot
 </tbody>
</table>


                
</div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="data_delete" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-indigo">
              <div class="text-center">
                  <h5 class="modal-title" id="modaltitle">Delete User</h5>
              </div>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
                  
          </div>
          
          <form method="POST" action="{{ route('delete_users')}}">
              {{ csrf_field() }}
              <div class="modal-body">
                  
                  <input type="hidden" id="id_delete" name="id_delete">
                  <div class="row form-group">
                      <div class="col-md-6">
                          <h5><label type="text"  id="name_delete"></label></h5>
                      </div>
                      <div class="col-md-8">
                          <h6 id="modallabel">Are you sure Remove User ? </h6>
                      </div>
                  </div> 
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> &nbsp; Delete</button>
              </div>
          </form>
         
      </div>
  </div>
</div>
<!-- end Delete model -->

@endsection

@section('script')
<script>
   $(document).ready(function() {
     
    $('#tbl_user').DataTable();

    $('#data_delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('dataid') 
    var name = button.data('dataname')
    document.getElementById("id_delete").value= id; 
    document.getElementById("name_delete").innerHTML = name;
    })
});
</script>

@endsection


