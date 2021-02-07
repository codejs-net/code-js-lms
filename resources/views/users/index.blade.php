@extends('layouts.app')


@section('content')
<div class="content-header">
<div class="container">
    <div class="row bg-gradient-light">
        <div class="col-sm-12 col-md-12">
        <div class="pull-right text-center">
            <h4>Users Management</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
           
        </div>
    </div>
</div>
</div>

<div class="container bg-white">
<div class="card-body">



<table class="table table-hover" id="tbl_user">
<thead>
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
<script src="{{ asset('plugins/datatables-jquery/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>

@endsection


