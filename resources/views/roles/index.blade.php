@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Role&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Search Role&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Search Role</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
        @can('role-create')
            <a class="btn btn-default btn-sm bg-primary" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i>&nbsp; New</a>
        @endcan
        </div>
    </div>
    
</div>

<div class="container">
<div class="card card-body">
    <div class="form-row">   
        <div class="table-responsive">  
        <table class="table table-hover">
        <thead class="bg-gradient-light">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-outline-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>


{!! $roles->render() !!}
                
</div>
</div>




@endsection